<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\DetailSale;
use App\Models\Sale;
use App\Models\Medicine;
use Illuminate\View\View;


class DetailSaleController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $saleId = $request->input('sale_id');
        $is_success = $request->input('is_success');
        $medicineIds = $request->input('medicine_id');
        $quantities = $request->input('quantity');
        $prices = $request->input('price');
        $discounts = $request->input('discount');
        $subtotals = $request->input('subtotal');

        // Var to make sure database is correct
        $totalPrice = 0;
        $totalDiscount = 0;

        // Check stock
        $allStockOk = true;
        $stockMessage = [];
        for ($i = 0; $i < count($medicineIds); $i++) {
            $medicine_id = $medicineIds[$i];
            $quantity = $quantities[$i];

            $meds = Medicine::find($medicine_id);
            if($meds->quantity < $quantities[$i]){
                $allStockOk = false;
                $stockMessage[] = 'Stok '.$meds->name.' tidak mencukupi! (sisa stok: '.$meds->quantity.')';
            }
        }

        if(!$allStockOk){
            $sale = Sale::find($saleId);
            $sale->is_success = 0;
            $sale->change = 0;
            $sale->cash = 0;
            $sale->save();
            return response()->json(['message' => $stockMessage,'status' => 'nostock']);
        }

        // Simpan setiap detail penjualan
        for ($i = 0; $i < count($medicineIds); $i++) {
            $detailSale = new DetailSale();
            $detailSale->sale_id = $saleId;
            $detailSale->medicine_id = $medicineIds[$i];
            $detailSale->quantity = $quantities[$i];

            $meds = Medicine::find($medicineIds[$i]);

            $detailSale->price = $meds->price;
            $detailSale->discount = $meds->discount;
            $detailSale->subtotal = $quantities[$i] * ($meds->price*(1  - $meds->discount));

            $medsPrice = $meds->price;
            $medsDiscount = $medsPrice * $meds->discount;
            $totalPrice += $quantities[$i] * ($medsPrice - $medsDiscount);
            $totalDiscount += $quantities[$i] * $medsDiscount;

            $detailSale->save();
        }

        // Update total price, discount, cash, change
        $isWeird = false;
        $weirdMessage = [];
        if($is_success){
            $sale = Sale::find($saleId);

            if($sale->total != $totalPrice){
                $weirdMessage[] = 'Total harga sudah dikoreksi! (dari: Rp'.($sale->total).', menjadi: Rp'.$totalPrice.')';
                $sale->total = $totalPrice;
                $isWeird = true;
            }

            if($sale->discount != $totalDiscount){
                $weirdMessage[] = 'Total diskon sudah dikoreksi!\n (dari: Rp'.($sale->discount).', menjadi: Rp'.$totalDiscount.')';
                $sale->discount = $totalDiscount;
                $isWeird = true;
            }

            if($sale->change != ($sale->cash-$totalPrice)){
                $weirdMessage[] = 'Total kembalian sudah dikoreksi!\n (dari: Rp'.($sale->change).', menjadi: Rp'.($sale->cash-$totalPrice).')';
                $sale->change = $sale->cash-$totalPrice;
                $isWeird = true;
            }

            if($sale->cash < $totalPrice) {
                $sale->is_success = 0;
                $sale->change = 0;
                $sale->cash = 0;
                $sale->save();
                return response()->json(['message' => 'Transaksi Batal!\nUang tidak cukup!\nSeharusnya bayar '.($totalPrice) , 'status' => 'notenough']);
            }
            $sale->save();
        }

        // Decrease medicine if it's 100% sure
        if ($is_success) {
            for($i = 0; $i < count($medicineIds); $i++){
                $meds = Medicine::find($medicineIds[$i]);
                $meds->decrement('quantity', $quantities[$i]);
            }
        }

        return response()->json(
            [
                'status' => $isWeird? 'weird':'success',
                'weirdMessage' => $weirdMessage,
                'message' => 'Transaction details added successfully!'. ($is_success? ' (PAID) ':' (CANCELLED) ')
            ]
        );
    }

    public function show(Sale $sale, Request $request): View
    {
        $search = $request->input('search');

        $query = DetailSale::where('sale_id', $sale->id)
            ->select('detailsales.*', 'medicines.name as medicine_name')
            ->join('medicines', 'detailsales.medicine_id', '=', 'medicines.id');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('detailsales.id', 'like', "%$search%")
                    ->orWhere('detailsales.quantity', 'like', "%$search%")
                    ->orWhere('detailsales.price', 'like', "%$search%")
                    ->orWhere('detailsales.discount', 'like', "%$search%")
                    ->orWhere('detailsales.subtotal', 'like', "%$search%")
                    ->orWhere('medicines.name', 'like', "%$search%");
            });
        }

        $detailSales = $query->paginate(8);

        return view('sales.show', compact('detailSales', 'sale'));
    }
}

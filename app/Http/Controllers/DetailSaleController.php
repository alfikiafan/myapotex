<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailSale;
use App\Models\Sale;
use App\Models\Medicine;


class DetailSaleController extends Controller
{
    public function store(Request $request)
    {
        $saleId = $request->input('sale_id');
        $is_success = $request->input('is_success');
        $medicineIds = $request->input('medicine_id');
        $quantities = $request->input('quantity');
        $prices = $request->input('price');
        $discounts = $request->input('discount');
        $subtotals = $request->input('subtotal');

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
            return response()->json(['message' => $stockMessage,'status' => 'error']);
        }

        // Simpan setiap detail penjualan
        for ($i = 0; $i < count($medicineIds); $i++) {
            $detailSale = new DetailSale();
            $detailSale->sale_id = $saleId;
            $detailSale->medicine_id = $medicineIds[$i];
            $detailSale->quantity = $quantities[$i];
            $detailSale->price = $prices[$i];
            $detailSale->discount = $discounts[$i];
            $detailSale->subtotal = $subtotals[$i];

            $detailSale->save();
            if ($is_success) {
                $meds = Medicine::find($detailSale->medicine_id);
                $meds->decrement('quantity', $quantities[$i]);
            }
        }
        return response()->json(['message' => 'Transaction details added successfully!'. ($is_success? ' (PAID) ':' (CANCELLED) ')]);
    }

    public function show(Sale $sale, Request $request)
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailSale;
use App\Models\Sale;


class DetailSaleController extends Controller
{
    public function store(Request $request)
    {
        $saleId = $request->input('sale_id');
        $medicineIds = $request->input('medicine_id');
        $quantities = $request->input('quantity');
        $prices = $request->input('price');
        $discounts = $request->input('discount');
        $subtotals = $request->input('subtotal');
    
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
        }
    
        // Kirim respon sukses
        return response()->json(['message' => 'Transaction details added successfully!']);
    }

    public function update(Request $request, $id)
    {
        // Validasi inputan form detail sale
        $request->validate([
            'sale_id' => 'required',
            'medicine_id' => 'required',
            'quantity' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'subtotal' => 'required|numeric|min:0',
        ]);

        // Cari detail sale berdasarkan ID
        $detailSale = DetailSale::findOrFail($id);

        // Update detail sale
        $detailSale->sale_id = $request->input('sale_id');
        $detailSale->medicine_id = $request->input('medicine_id');
        $detailSale->quantity = $request->input('quantity');
        $detailSale->price = $request->input('price');
        $detailSale->discount = $request->input('discount');
        $detailSale->subtotal = $request->input('subtotal');
        $detailSale->save();

        return redirect()->route('sales.index')->with('success', 'Detail sale updated successfully.');
    }

    public function destroy($id)
    {
        // Cari detail sale berdasarkan ID
        $detailSale = DetailSale::findOrFail($id);

        // Hapus detail sale
        $detailSale->delete();

        return redirect()->route('sales.index')->with('success', 'Detail sale deleted successfully.');
    }
}

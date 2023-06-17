<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Medicine;
use App\Models\DetailSale;
use Illuminate\View\View;


class SaleController extends Controller
{
    public function index() :View|RedirectResponse
    {
        if(auth()->user()->can('admin')){
            $search = request()?->input('search');

            if ($search) {
                $sales = Sale::with('cashier')
                    ->where('id', 'like', "%$search%")
                    ->orWhere('cashier_id', 'like', "%$search%")
                    ->orWhere('created_at', 'like', "%$search%")
                    ->orWhere('total', 'like', "%$search%")
                    ->orWhereHas('cashier', function ($query) use ($search) {
                        $query->where('name', 'like', "%$search%")
                            ->orWhere('email', 'like', "%$search%");
                    })->paginate(10);
            } else {
                $sales = Sale::paginate(10);
            }
            return view('sales.index', compact('sales'));
        } else if(auth()->user()->can('cashier')){
            $sales = Sale::with('detailSales', 'detailSales.medicine')->get();
            $medicines = Medicine::all();
            $lastId = Sale::max('id');
            $newId;
            if ($lastId > 0) {
                $lastIdNumber = intval(substr($lastId, 1));
                $newIdNumber = $lastIdNumber + 1;
                $newId = 'S' . str_pad($newIdNumber, 4, '0', STR_PAD_LEFT);
            } else {
                $newId = 'S0001';
            }
            return view('sales.index', compact('sales', 'medicines', 'newId'));
        } else{
            return redirect('/');
        }
    }

    public function store(Request $request)
    {
        // Buat penjualan baru
        $sale = new Sale();
        $sale->cashier_id = auth()->user()->id;
        $sale->discount = $request->input('discount');
        $sale->total = $request->input('total');
        $sale->cash = $request->input('cash');
        $sale->change = $request->input('change');
        $sale->is_success = $request->input('is_success');
        $sale->save();

        // Kirim respon dengan ID penjualan yang berhasil dibuat
        return response()->json(['sale_id' => $sale->id,'is_success' => $sale->is_success]);
    }

    public function update(Request $request, $id)
    {
        // Validasi inputan form sale
        $request->validate([
            'medicine_id' => 'required',
            'quantity' => 'required|numeric|min:1',
        ]);

        // Cari sale berdasarkan ID
        $sale = Sale::findOrFail($id);

        // Hapus semua detail sale terkait sebelum melakukan update
        $sale->detailSales()->delete();

        // Looping untuk menyimpan detail sales yang diperbarui
        foreach ($request->input('medicine_id') as $index => $medicineId) {
            $quantity = $request->input('quantity')[$index];

            $sale->detailSales()->create([
                'medicine_id' => $medicineId,
                'quantity' => $quantity,
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $sale = Sale::findOrFail($id);
        $medicines = Medicine::all();
        return view('sales.edit', compact('sale', 'medicines'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');

        $medicines = Medicine::where('name', 'like', '%' . $query . '%')
            ->orWhere('brand', 'like', '%' . $query . '%')
            ->orWhere('category', 'like', '%' . $query . '%')
            ->get();

        $results = [];

        foreach ($medicines as $medicine) {
            $results[] = [
                'id' => $medicine->id,
                'value' => $medicine->name . ' - ' . $medicine->brand . ' - ' . $medicine->category,
                'discount' => $medicine->discount,
                'price' => $medicine->price,
            ];
        }

        return response()->json($results);
    }

    public function destroy($id)
    {
        // Cari sale berdasarkan ID
        $sale = Sale::findOrFail($id);

        // Hapus semua detail sale terkait
        $sale->detailSales()->delete();

        // Hapus sale
        $sale->delete();

        return redirect()->route('sales.index')->with('success', 'Sale deleted successfully.');
    }
}

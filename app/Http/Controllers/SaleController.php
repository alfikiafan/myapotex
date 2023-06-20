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
            $search = request()->input('search');
            $saleId = request()->input('saleId');
            $totalPrice = request()->input('totalPrice');
            $date = request()->input('date');
            $status = request()->input('status');

            $sales = Sale::query();

            if ($search) {
                 $sales = Sale::with('cashier')
                    ->where('id', 'like', "%$search%")
                    ->orWhere('cashier_id', 'like', "%$search%")
                    ->orWhere('created_at', 'like', "%$search%")
                    ->orWhere('total', 'like', "%$search%")
                    ->orWhereHas('cashier', function ($query) use ($search) {
                        $query->where('name', 'like', "%$search%")
                            ->orWhere('email', 'like', "%$search%");
                    });
            }
            if($status){
                $sales = $sales->orderBy('is_success', $status);
            }

            if($saleId){
                $sales = $sales->orderBy('id', $saleId);
            }

            if($totalPrice){
                $sales = $sales->orderBy('total', $totalPrice);
            }

            if($date){
                $sales = $sales->orderBy('created_at', $date);
            }

            $sales = $sales->paginate(8);

            return view('sales.index', compact('sales'));
        } else if(auth()->user()->can('cashier')){
            $sales = Sale::with('detailSales', 'detailSales.medicine')->get();
            $medicines = Medicine::all();
            $lastId = Sale::max('id');
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
        $sale = new Sale();
        $sale->cashier_id = auth()->user()->id;
        $sale->discount = $request->input('discount');
        $sale->total = $request->input('total');
        $sale->cash = $request->input('cash');
        $sale->change = $request->input('change');
        $sale->is_success = $request->input('is_success');
        $sale->save();

        return response()->json(['sale_id' => $sale->id,'is_success' => $sale->is_success]);
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
}

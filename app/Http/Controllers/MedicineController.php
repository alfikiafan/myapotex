<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        if ($search) {
            $medicines = Medicine::where('id', 'like', "%$search%")
                ->orWhere('name', 'like', "%$search%")
                ->orWhere('brand', 'like', "%$search%")
                ->orWhere('category', 'like', "%$search%")
                ->orWhere('quantity', 'like', "%$search%")
                ->orWhere('discount', 'like', "%$search%")
                ->orWhere('price', 'like', "%$search%")
                ->paginate(8);
        } else {
            $medicines = Medicine::paginate(8);
        }
    
        return view('medicines.index', compact('medicines'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'category' => 'required',
            'quantity' => 'required|integer',
            'discount' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        $validatedData['discount'] = $validatedData['discount'] / 100;

        Medicine::create($validatedData);

        return redirect()->route('medicines.index')->with('success', 'Obat berhasil ditambahkan');
    }

    public function create()
    {
        return view('medicines.create');
    }

    public function edit(Medicine $medicine)
    {
        return view('medicines.edit', compact('medicine'));
    }

    public function update(Request $request, Medicine $medicine)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'category' => 'required',
            'quantity' => 'required|integer',
            'discount' => 'required|numeric',
            'price' => 'required|numeric',
        ]);
    
        $validatedData['discount'] = $validatedData['discount'] / 100;
    
        $medicine->update($validatedData);

        return redirect()->route('medicines.index')->with('success', 'Medicine updated successfully');
    }

    public function destroy(Medicine $medicine)
    {
        $medicine->delete();

        return redirect()->route('medicines.index')->with('success', 'Medicine has been deleted.');
    }
}


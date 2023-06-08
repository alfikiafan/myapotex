<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index()
    {
        $medicines = Medicine::all();
        $medicines = Medicine::paginate(4);
        return view('medicines', ['medicines' => $medicines]);
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
        $medicine->update($request->all());

        return redirect()->route('medicines.index')->with('success', 'Medicine updated successfully');
    }

    public function destroy(Medicine $medicine)
    {
        $medicine->delete();

        return redirect()->route('medicines.index')->with('success', 'Medicine has been deleted.');
    }
}


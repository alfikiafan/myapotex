<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MedicineController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $sortQty = $request->input('qty')===''?null:$request->input('qty');
        $sortDisc = $request->input('disc')===''?null:$request->input('disc');
        $sortPrice = $request->input('price')===''?null:$request->input('price');

        $medicines = Medicine::query();

        if ($search) {
            $medicines = Medicine::where('id', 'like', "%$search%")
                ->orWhere('name', 'like', "%$search%")
                ->orWhere('brand', 'like', "%$search%")
                ->orWhere('category', 'like', "%$search%")
                ->orWhere('quantity', 'like', "%$search%")
                ->orWhere('discount', 'like', "%$search%")
                ->orWhere('price', 'like', "%$search%");
        }

        if($sortQty){
            $medicines = $medicines->orderBy('quantity', $sortQty);
        }

        if($sortDisc){
            $medicines = $medicines->orderBy('discount', $sortDisc);
        }

        if($sortPrice){
            $medicines = $medicines->orderBy('price', $sortPrice);
        }

        $medicines = $medicines->paginate(80);

        return view('medicines.index', compact('medicines'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'category' => 'required',
            'quantity' => 'required|integer|min:0',
            'discount' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        $validatedData['discount'] = $validatedData['discount'] / 100;

        $success = Medicine::create($validatedData);

        if ($success) {
            return redirect()->route('medicines.index')->with('success', 'Medicine add successfully.');
        } else {
            return redirect()->route('medicines.create')->withErrors('Medicine failed to add.');
        }
    }

    public function create(): View
    {
        return view('medicines.create');
    }

    public function edit(Medicine $medicine): View
    {
        return view('medicines.edit', compact('medicine'));
    }

    public function update(Request $request, Medicine $medicine): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'category' => 'required',
            'quantity' => 'required|integer|min:0',
            'discount' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        $validatedData['discount'] = $validatedData['discount'] / 100;

        $success = $medicine->update($validatedData);

        if ($success) {
            return redirect()->route('medicines.index')->with('success', 'Medicine updated successfully.');
        } else {
            return redirect()->route('medicines.edit')->withErrors('Medicine failed to add.');
        }
    }

    public function destroy(Medicine $medicine) :RedirectResponse
    {
        $medicine->delete();

        return redirect()->route('medicines.index')->with('success', 'Medicine has been deleted.');
    }
}

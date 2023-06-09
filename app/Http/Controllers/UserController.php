<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        if ($search) {
            $users = User::where('id', 'like', "%$search%")
                ->orWhere('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->orWhere('role', 'like', "%$search%")
                ->orWhere('joining_date', 'like', "%$search%")
                ->paginate(4);
        } else {
            $users = User::paginate(4);
        }
    
        return view('accounts.index', compact('users'));
    }

    public function create()
    {
        return view('accounts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'role' => 'required',
            'joining_date' => 'required|date',
        ]);

        User::create($request->all());

        return redirect()->route('accounts.index')->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        return view('accounts.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'required',
            'role' => 'required',
        ]);

        $user->update($request->all());

        return redirect()->route('accounts.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('accounts.index')->with('success', 'User deleted successfully');
    }
}

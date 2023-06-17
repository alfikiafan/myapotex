<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function create(): View
    {
        return view('sessions.create');
    }

    /**
     * @throws ValidationException
     */
    public function store(): RedirectResponse
    {
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (!auth()->attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Email salah. Ulangi lagi.',
                'password' => 'Passwordmu salah. Ulangi lagi.'
            ]);
        }


        session()->regenerate(); // session fixation
        return redirect('/')->with('success', 'Welcome Back!');
    }

    public function destroy(): RedirectResponse
    {
        auth()->logout();
        return redirect('/')->with('success', 'Goodbye!');
    }
}

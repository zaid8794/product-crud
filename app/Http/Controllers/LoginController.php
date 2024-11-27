<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function index()
    {
        return view('login');
    }

    function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required | email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('account.dashboard');
        } else {
            return redirect()->route('account.login')->with('error', 'Email or password is incorrect');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('account.login');
    }
}

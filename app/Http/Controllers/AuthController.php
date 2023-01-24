<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //login page
    public function loginPage()
    {
        return view('login');
    }
    public function registerPage()
    {
        return view('register');
    }
    public function dashboard()
    {
        if (Auth::user()->role == 'admin') {
            return redirect()->route('list#Page');

        } else {
            return redirect()->route('user#Home');

        }
    }

}
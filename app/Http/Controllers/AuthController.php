<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function index()
    {
        return view('auth.login');
    }

    function loginProcess(Request $request)
    {
        $input = $request->only(['username', 'login']);
        $password = $input['login']['password'];
        unset($input['login']);
        $input += array('password' => $password);
        if (Auth::attempt($input)) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->back()->with('errLogin', 'true');
        }
    }

    function logout() {
        Auth::logout();
        return redirect()->route('admin.login_page');
    }

    function dashboard()
    {
        return view('admin.dashboard');
    }
}

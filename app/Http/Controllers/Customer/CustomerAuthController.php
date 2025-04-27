<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerSignUpRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerAuthController extends Controller
{
    function login()
    {
        return view('customer.login');
    }

    function loginProcess(Request $request) {
        $input = $request->only(['email','login']);
        $password = $input['login']['password'];
        unset($input['login']);
        $input += array('password' => $password);
        if (Auth::guard('customer')->attempt($input)) {
            return redirect()->route('customer.index');
        }else{
            return redirect()->back()->with('errLogin','true');
        }
    }

    function signUp()
    {
        return view('customer.register');
    }
    function signUpProcess(CustomerSignUpRequest $customer_sign_up_request)
    {
        $input = $customer_sign_up_request->validated();
        $password = $input['login']['password'];
        unset($input['login']);
        $input += array('password' => $password);
        Customer::create($input);
        return redirect()->route('customer.login')->with('successRegister','true');
    }

    function logout() {
        Auth::guard('customer')->logout();
        return redirect()->route('customer.login');
    }
}

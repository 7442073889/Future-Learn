<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('welcome');

    }

    public function authenticate(Request $request) {
        $validator = Validator::make($request->all(),[
        'email' => 'required|email',
        'password' => 'required',
      ]);

    if ($validator->passes()) {

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // Check if the logged-in user is actually an admin
            $user = Auth::guard('admin')->user();
            
            if ($user->role !== 'admin') { 
                Auth::guard('admin')->logout(); // Logout immediately
                return redirect()->route('account.welcome')->with('error', 'You are not authorized to access this page.');
            }

         return redirect()->route('admindashboard');
       }else{
        return redirect()->route('account.welcome')->with('error','Either email or password is incorrect.');
       }

    }else{
       return redirect()->route('account.welcome')
       ->withInput()
       ->withErrors($validator);
    }

   }

   public function logout() {
    Auth::guard('admin')->logout();
    return redirect()->route('account.welcome');
   }
}

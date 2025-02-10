<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash; 


class LoginController extends Controller
{
    //this method will show login page for user 

    public function index() {
        return view('welcome');
    }

    public function authenticate(Request $request) {
         $validator = Validator::make($request->all(),[
         'email' => 'required|email',
         'password' => 'required',
       ]);

     if ($validator->passes()) {

        if(Auth::attempt(['email' => $request->email,'password' => $request->password])) {
          return redirect()->route('account.dashboard');
        }else{
         return redirect()->route('account.welcome')->with('error','Either email or password is incorrect.');
        }

     }else{
        return redirect()->route('account.welcome')
        ->withInput()
        ->withErrors($validator);
     }

    }

    public function register() {

      return view('welcome');
    }
  
   public function processRegister(Request $request){

    $validator = Validator::make($request->all(),[
      'name' => 'required|string|max:255',
      'email' => 'required|email|unique:users,email',
      'password' => 'required|confirmed',
    ]);

  if ($validator->passes()) {

      $user = new User();
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = Hash::make($request->password);
      $user->role = 'user';
      $user->save();

      return redirect()->route('account.welcome')->with('success','you have registed successfully.');
  }else{
     return redirect()->route('account.welcome')
     ->withInput()
     ->withErrors($validator);
  }

   }

   public function logout()
   {
       Auth::guard('web')->logout();
       return redirect()->route('account.welcome')->with('success', 'You have been logged out successfully.');
   }
}

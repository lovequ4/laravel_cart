<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth/register');
    }


    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ])->validate();
  
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);
  
        return redirect()->route('login');
    }


    public function login()
    {
        return view('auth/login');
    }
  

    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required'
        ])->validate();

        

        if (Auth::attempt($request->only('name', 'password'))) {
            $user = auth()->user();
        
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('products.index');
            }
            
            $request->session()->regenerate();
            
        }else {
            return redirect()->back()->withInput()->withErrors(['loginError' => 'Login failed']);
        }
    }
  

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
  
        $request->session()->invalidate();
  
        return redirect('/');
    }
 
   
}

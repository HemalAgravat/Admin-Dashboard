<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $value = $request->only('email', 'password');
    
        if (Auth::attempt($value
        )) {
            // Authentication passed...
            return redirect('/boot'); // Redirect to dashboard after successful login
        }
    
        $errors = [];
    
        // Check if the email is incorrect
        if (!User::where('email', $value
        ['email'])->exists() ) {
            $errors['email'] = 'Invalid email';
        } else {
            $errors['password'] = 'Invalid password';
        }
    
        return redirect()->back()->withErrors($errors);
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
  
}

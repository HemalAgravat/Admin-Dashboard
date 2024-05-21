<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Summary of showLoginForm
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Summary of login
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login(Request $request)
    {
        $value = $request->only('email', 'password');

        if (
            Auth::attempt(
                $value
            )
        ) {
            // Authentication passed...
            return redirect('/'); // Redirect to dashboard after successful login
        }

        $errors = [];

        // Check if the email is incorrect
        if (
            !User::where('email', $value
            ['email'])->exists()
        ) {
            $errors['email'] = 'Invalid email';
        } else {
            $errors['password'] = 'Invalid password';
        }

        return redirect()->back()->withErrors($errors);
    }

    /**
     * Summary of logout
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

}

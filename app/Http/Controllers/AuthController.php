<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login;
use App\Http\Requests\Register;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function register(Register $register)
    {
        Auth::loginUsingId(User::create($register->only(['email','name','password','role']))->id);
        return redirect()->route('profile');
    }

    public function login(Login $login)
    {
        if (!$id=User::where('email',$login->email)->where('password',$login->password)->first())return back()->with('user','Данные для входа не корректны');
        Auth::loginUsingId($id->id);
        return redirect()->route('profile');
    }

    public function logout()
    {
        Auth::logout();
        \session()->invalidate();
        \session()->regenerateToken();
        return redirect()->route('home');
    }
}

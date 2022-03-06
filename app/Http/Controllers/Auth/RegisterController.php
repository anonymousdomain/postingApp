<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class RegisterController extends Controller
{

    public function __construct(){

        $this->middleware(['guest']);
    }
    public function index()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        //validate 
        $attributes = $this->validate($request, [
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ]);
        //store
        $attributes['password'] = bcrypt($attributes['password']); //hash the password
        User::create($attributes);
        //sign user in 
        auth()->attempt($request->only('email','password'));
        //redirect
        return redirect()->route('dashboard');
    }
}

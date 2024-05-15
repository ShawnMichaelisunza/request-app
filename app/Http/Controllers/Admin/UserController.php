<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Register as MailRegister;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //register
    public function create(){

        return view('admin.adminRegister');
    }

    public function store(){

        $validated = request()->validate([
            'name' => ['required', 'min:8', 'max:50'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed']
        ]);

        $validated['password'] = Hash::make($validated['password']);

        if(request()->has('email')){
            Mail::to($validated['email'])->send(new MailRegister);
        }

        User::create($validated);

        return redirect()->route('login')->with('success', 'Registered Account Successfully! ');
    }

    // logout

    public function logout(){
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    }
}

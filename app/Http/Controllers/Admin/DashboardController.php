<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Login as MailLogin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    public function index()
    {

        return view('admin.dashboard');
    }

    // login

    public function create()
    {
        return view('admin.adminLogin');
    }

    public function store()
    {
        $validated = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (auth()->attempt($validated)) {
            request()->session()->regenerate();

            if (Auth::id()) {
                $usertype = auth()->user()->usertype;

                if ($usertype == 'user') {
                    return abort(404);
                } elseif ($usertype == 'admin') {

                    if (request()->has('email')) {
                        Mail::to($validated['email'])->send(new MailLogin());
                    }

                    return redirect()->route('admin_dashboard')->with('success', 'Login Account Successfully !');
                }
            }
        }

        return redirect()
            ->route('login')
            ->withErrors(['email' => 'login failed'])
            ->onlyInput('email');
    }
}

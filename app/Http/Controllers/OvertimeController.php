<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\Overtime as MailOvertime;
use App\Mail\OvertimeApprove;
use App\Mail\OvertimeDelete;
use App\Models\Overtime;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OvertimeController extends Controller
{
    // view all data
    public function index()
    {
        $overtimes = Overtime::orderBy('created_at', 'DESC')->where('company_name', Auth::user()->company_name);

        if(request()->has('search')){
            $overtimes = Overtime::where( 'emp_no', 'like', '%'.request()->get('search', ''). '%');
        }

        return view('adminPage.overtime', ['overtimes' => $overtimes->paginate(2)]);
    }

    // view a data
    public function view($id){
        $overtime = Overtime::findOrFail($id);


        return view('viewing.overtime', ['overtime' => $overtime]);
    }

    // create a data
    public function create(User $user)
    {
        return view('pages.overtime', compact('user'));
    }

    public function store()
    {
        $validated = request()->validate([
            'company_name' => ['required'],
            'email' => ['required'],
            'emp_name' => ['required'],
            'emp_no' => ['required'],
            'position' => ['required'],
            'actual_ot' => ['required'],
            'ot_from' => ['required',],
            'ot_to' => ['required'],
            'reason' => ['required'],
        ]);

        Overtime::create($validated);

        if (request()->has('email')) {
            Mail::to($validated['email'])->send(new MailOvertime());
        }

        return redirect()->back()->with('success', ' Submit of form is Successfully !');
    }

    // approve a data

    public function approve($id){
        $validated = Overtime::findOrFail($id);

        $validated->status = "APPROVE";

        $validated->save();

        if(request()->has('email')){
            Mail::to($validated->email)->send(new OvertimeApprove);
        }

        return redirect()->back()->with('success', 'Approve request Successfully !');
    }


    // delete a data
    public function delete( $id){

        $validated = Overtime::findOrFail($id);

        if(request()->has('email')){
            Mail::to($validated->email)->send(new OvertimeDelete);
        }

        $validated->delete();

        return redirect()->back()->with('success', 'Deleted request form Successfully !');
    }

}

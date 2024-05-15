<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\Leave as MailLeave;
use App\Mail\LeaveApprove;
use App\Mail\OvertimeDelete;
use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LeaveController extends Controller
{
    // view all data
    public function index()
    {
        $leaves = Leave::orderBy('created_at', 'DESC')->where('company_name', Auth::user()->company_name);

        if(request()->has('search')){
            $leaves = Leave::where('emp_no', 'like', '%'. request()->get('search', ''). '%');
        }

        return view('adminPage.leave', ['leaves' => $leaves->paginate(1)]);
    }

    public function view($id)
    {
        $leave = Leave::findOrFail($id);

        return view('viewing.leave', ['leave' => $leave]);
    }

    // create a data
    public function create()
    {
        return view('pages.leave');
    }

    public function store()
    {
        $validated = request()->validate([
            'company_name' => ['required'],
            'email' => ['required'],
            'emp_name' => ['required'],
            'emp_no' => ['required'],
            'position' => ['required'],
            'status_leave' => ['required'],
            'l_from' => ['required'],
            'l_to' => ['required'],
            'reason' => ['required'],
        ]);

        Leave::create($validated);

        if (request()->has('email')) {
            Mail::to($validated['email'])->send(new MailLeave());
        }

        return redirect()->back()->with('success', 'Created Leave form Successfully');
    }

    // approve a data
    public function approve($id){
        $leave = Leave::findOrFail($id);

        $leave->status = "APPROVE";
        $leave->save();

        if(request()->has('email')){
            Mail::to($leave->email)->send(new LeaveApprove);
        }

        return redirect()->back()->with('success', 'Approve Request Successfully !');
    }

    // delete a data
    public function delete($id)
    {
        $validated = Leave::findOrFail($id);

        if (request()->has('email')) {
            Mail::to($validated->email)->send(new OvertimeDelete());
        }

        $validated->delete();

        return redirect()->back()->with('success', 'Deleted request form Successfully !');
    }
}

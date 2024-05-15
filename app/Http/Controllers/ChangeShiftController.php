<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ChangeShift as MailChangeShift;
use App\Mail\ChangeShiftApprove;
use App\Mail\OvertimeDelete;
use App\Models\ChangeShift;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ChangeShiftController extends Controller
{

    // view all data
    public function index(){
        $changeshifts = ChangeShift::orderBy('created_at', 'DESC')->where('company_name', Auth::user()->company_name);

        if(request()->has('search')){
            $changeshifts = ChangeShift::where('emp_no', 'like', '%'. request()->get('search', ''). '%');
        }

        return view('adminPage.changeshift', ['changeshifts' => $changeshifts->paginate(1)]);
    }

    // view a data
    public function view($id){
        $changeshift = ChangeShift::findOrFail($id);

        return view('viewing.changeshift', ['changeshift' => $changeshift]);
    }

    // create a data
    public function create(User $user){

        return view('pages.change-shift', compact('user'));
    }

    public function store(){

        $validated = request()->validate([
            'company_name' => ['required'],
            'email' => ['required'],
            'emp_name' => ['required'],
            'emp_no' => ['required'],
            'position' => ['required'],
            'actual_cs' => ['required'],
            'cs_from' => ['required'],
            'cs_to' => ['required'],
            'reason' => ['required']
        ]);

        ChangeShift::create($validated);

        if(request()->has('email')){
            Mail::to($validated['email'])->send(new MailChangeShift);
        }

        return redirect()->back()->with('success', 'Created Change Shift Successfully !');

    }

    // approve a data
    public function approve($id){

        $changeshift = ChangeShift::findOrFail($id);

        $changeshift->status = "APPROVE";

        $changeshift->save();

        if(request()->has('email')){
            Mail::to($changeshift->email)->send(new ChangeShiftApprove);
        }

        return redirect()->back()->with('success', 'Approve Request Successfully !');
    }

        // delete a data
        public function delete( $id){

            $validated = ChangeShift::findOrFail($id);

            if(request()->has('email')){
                Mail::to($validated->email)->send(new OvertimeDelete);
            }

            $validated->delete();

            return redirect()->back()->with('success', 'Deleted request form Successfully !');
        }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\Halfday as MailHalfday;
use App\Mail\HalfdayApprove;
use App\Mail\OvertimeDelete;
use App\Models\Halfday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HalfdayController extends Controller
{

    // view all data
    public function index(){

        $halfdays = Halfday::orderBy('created_at', 'DESC')->where('company_name', Auth::user()->company_name);

        if(request()->has('search')){
            $halfdays = Halfday::where('emp_no', 'like', '%'. request()->get('search', ''). '%');
        }

        return view('adminPage.halfday', ['halfdays' => $halfdays->paginate(1)]);
    }

    // view a data
    public function view($id){

        $halfday = Halfday::findOrFail($id);

        return view('viewing.halfday', ['halfday' => $halfday]);
    }

    // create a data
    public function create(){

        return view('pages.halfday');
    }

    public function store(){
        $validated = request()->validate([
            'company_name' => ['required'],
            'email' => ['required'],
            'emp_name' => ['required'],
            'emp_no' => ['required'],
            'position' => ['required'],
            'actual_hd' => ['required'],
            'hd_from' => ['required'],
            'hd_to' => ['required'],
            'reason' => ['required']
        ]);

        Halfday::create($validated);

        if(request()->has('email')){
            Mail::to($validated['email'])->send(new MailHalfday);
        }

        return redirect()->back()->with('success', 'Created Halfday Successfully !');
    }

    // approve a data
    public function approve($id){
        $halfday = Halfday::findOrFail($id);
        $halfday->status = "APPROVE";

        $halfday->save();

        if(request()->has('email')){
            Mail::to($halfday->email)->send(new HalfdayApprove);
        }

        return redirect()->back()->with('success', 'Aprrove Request Successfully !');
    }

            // delete a data
            public function delete( $id){

                $validated = Halfday::findOrFail($id);

                if(request()->has('email')){
                    Mail::to($validated->email)->send(new OvertimeDelete);
                }

                $validated->delete();

                return redirect()->back()->with('success', 'Deleted request form Successfully !');
            }
}

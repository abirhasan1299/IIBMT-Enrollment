<?php

namespace App\Http\Controllers;
use App\Models\Student;

use Carbon\Carbon;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function qrcode($id)
    {
        $data = Student::where('enroll_number',hex2bin($id))->first();
        return view('list.qrcode',compact('data'));
    }
    public function Home()
    {
        return view('enroll-form');
    }

    public function CheckEnrollment(Request $req)
    {
         $req->validate([
            'enrollNumber' => 'required|max:20',
            'dob' => 'required|date',
            //'g-recaptcha-response' => 'required'
        ]);

        $data = Student::where('dob',Carbon::parse($req->dob)->format('Y-m-d'))->first();
        if($data)
        {
            $number = $data->pretag.$data->enroll_number;
        }else{
            return redirect()->route('enrollment')->with('invalid','Verification Not Found');
        }

        if($number===$req->enrollNumber)
        {
            return view("verification",compact('data'));
        }else{
            return redirect()->route('enrollment')->with('invalid','Verification Not Found');
        }
    }
}

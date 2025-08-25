<?php

namespace App\Http\Controllers;

use App\Models\Mode;
use App\Models\Student;
use App\Models\Course;
use App\Models\Session;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function AddEnrollment()
    {
        $course  =Course::orderBy('id','desc')->get();
        $session  =Session::orderBy('id','desc')->get();
        $num = Student::orderBy('id','desc')->first();
        $mode = Mode::where('status','active')->get();
        if($num !=null)
        {
            $num = (int)$num->enroll_number+1;
        }else{
           $num = date('msid')*500;
        }

        return view('add-enrollment',compact('course','session','num','mode'));
    }


    public function EditStudent($id)
    {
        $data = Student::findorFail($id);
        $course  =Course::orderBy('id','desc')->get();
        $session  =Session::orderBy('id','desc')->get();
        $mode = Mode::where('status','active')->get();
        return view('edit-student',compact('data','course','session','mode'));
    }

    public function UpdateStudent(Request $req, $id)
    {
          $req->validate([
            'name' => 'required|string|max:255',
            'father_name'=>'required|string|max:255',
            'dob'=>'required|date',
            'course'=>'required|string|max:255',
            'session_out'=>'required|string|max:255',
            'status'=>'required',
            'gender'=>'required|string',
            'campus'=>'required',
            'mode'=>'required'
        ]);

        $student = Student::findOrFail($id);

        $student->update([
            'pretag'=>$req->pretag,
            'name' => $req->name,
            'father_name'=>$req->father_name,
            'dob'=>$req->dob,
            'course_id'=>$req->course,
            'session_id'=>$req->session_out,
            'status'=>$req->status,
            'mode'=>$req->mode,
            'gender'=>$req->gender,
            'campus'=>$req->campus
        ]);

        return redirect()->route('enroll');

    }
    public function DelStudent($id)
    {

        $admin = Student::findOrFail($id);

        $admin->delete();

        return redirect()->back();
    }
    public function Login()
    {
        return view('login');
    }
    public function EnrollmentList()
    {
        $data = Student::orderBy('id', 'desc')->get();
        $course = Course::orderBy('id', 'desc')->get();
        $session = Session::orderBy('id', 'desc')->get();
        $mode = Mode::where('status','active')->get();
        return view('enrollment-list', compact('data','course','session','mode'));
    }
    public function AddStudent(Request $request)
    {
         $request->validate([
            'pretag'=>'required',
            'enroll_number'=>'required|unique:students',
            'name' => 'required|string|max:255',
            'father_name'=>'required|string|max:255',
            'dob'=>'required|date',
            'programme'=>'required|string|max:255',
            'session_out'=>'required|string|max:255',
            'status'=>'required',
            'gender'=>'required',
            'mode'=>'required',
            'campus'=>'required|string',
            'image'=>'required|image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        $imagePath = $request->file('image')->store('uploads', 'public');

        Student::create([
            'pretag'=>$request->pretag,
            'enroll_number'=>$request->enroll_number,
            'name' => $request->name,
            'father_name'=>$request->father_name,
            'dob'=>$request->dob,
            'course_id'=>$request->programme,
            'session_id'=>$request->session_out,
            'status'=>$request->status,
            'img_name'=>$imagePath,
            'gender'=>$request->gender,
            'mode'=>$request->mode,
            'campus'=>$request->campus,
        ]);

        return redirect()->back()->with('success', 'New Enrollment Added');
    }

    public function filter(Request $request)
    {
        $data = Student::where('session_id',$request->session_out)
            ->orWhere('course_id',$request->course)
            ->orWhere('mode',$request->mode)
            ->orWhere('enroll_number',$request->enroll)
            ->get();
        $course = Course::orderBy('id', 'desc')->get();
        $session = Session::orderBy('id', 'desc')->get();
        $mode = Mode::where('status','active')->get();
        return view('list.filter', compact('data','course','session','mode'));
    }
}

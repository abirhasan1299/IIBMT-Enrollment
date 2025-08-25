<?php

namespace App\Http\Controllers;
use App\Models\Session;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function home()
    {
        $session = Session::withCount('students')->orderBy('id','desc')->get();
        return view('files.session',compact('session'));
    }

    public function StudentList($id)
    {
        $data = Student::where('session_id',$id)->get();
        return view('list.list',compact('data'));
    }
    public function StudentDetails($id)
    {
        $data = Student::where('id',$id)->first();
        return view('list.profile',compact('data'));
    }
    public function add()
    {
        $course = Course::orderBy('id','desc')->get();
        return view('files.add-session',compact('course'));
    }
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'course_id'=> 'required',
            'session'=>'required'
        ]);
        Session::create($validateData);
        return redirect()->route('sessions.home');
    }
}

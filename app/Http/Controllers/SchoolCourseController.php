<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\School;
use Illuminate\Http\Request;

class SchoolCourseController extends Controller
{
    public function SchoolHome()
    {
        $schools = School::orderBy('id','desc')->get();
        return view('files.school',compact('schools'));
    }
    public function courseDestroy($id)
    {
        $model = Course::findorFail($id);
        $model->delete();
        return redirect()->route('courses');
    }
    public function schoolDestroy($id)
    {
        $model = School::findorFail($id);
        $model->delete();
        return redirect()->route('schools');
    }
    public function CourseHome()
    {
        $course = Course::orderBy('id','desc')->get();
        return view('files.courses',compact('course'));
    }
    public function AddSchool()
    {
        return view('files.add-school');
    }
    public function AddCourse()
    {
        $school = School::orderBy('id','desc')->get();
        return view('files.add-course',compact('school'));
    }
    public function Schoolstore(Request $request)
    {
        $validateData = $request->validate([
           'name'=>'required|unique:schools|max:255',
           'code'=> 'required|unique:schools'
        ]);
        School::create($validateData);
        return redirect()->route('schools');
    }
    public function Coursestore(Request $request)
    {
        $validateData = $request->validate([
            'name'=>'required|unique:courses|max:255',
            'code'=> 'required|unique:courses',
            'shortcode'=>'required|unique:courses',
            'school_id'=>'required'
        ]);
        Course::create($validateData);
        return redirect()->route('courses');
    }


}

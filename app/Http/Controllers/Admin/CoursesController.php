<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Language;
use Illuminate\Http\Request;
use Auth;
use App\Models\Lesson;
use App\Models\User;
use App\Models\Rating;
use App\Models\UserCourse;
use App\Models\UserBill;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.courses.index')->with('courses', Course::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.courses.create')->with('languages', Language::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'language_id' => 'required',
            'level' => 'required',
            'type' => 'required',
            'min_members' => 'required_if:type,=,group',
            'max_members' => 'required_if:type,=,group',
            'type_of_course' => 'required',
            'start_of_the_course' => 'required',
            'end_of_the_course' => 'required',
            'course_content' => 'required',
            'img' => 'required',
            'price' => 'numeric'
        ]);

        if ($request->hasFile('img')) {
            $file = $request->img;
            $filename = $file->getClientOriginalName();
            $file->move('storage/', $filename);

            $course = new Course();
            $course->img    = $filename;
            $course->name   = $request->input('name');
            $course->language_id = $request->input('language_id');
            $course->level       = $request->input('level');
            $course->type        = $request->input('type');
            $course->min_members = $request->input('min_members');
            $course->max_members = $request->input('max_members');
            $course->type_of_course      = $request->input('type_of_course');
            $course->start_of_the_course = $request->input('start_of_the_course');
            $course->end_of_the_course   = $request->input('end_of_the_course');
            $course->course_content      = $request->input('course_content');
            $course->price               = $request->input('price'); 
            $course->save();
        }
        return redirect()->route('admin.courses.index')->with('success', 'You have successfully added the course');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return view('admin.courses.show')->with('course', $course);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('admin.courses.edit')->with([
            'course' => $course,
            'languages' => Language::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $this->validate($request, [
            'name' => 'required',
            'language_id' => 'required',
            'level' => 'required',
            'type' => 'required',
            'min_members' => 'required',
            'max_members' => 'required',
            'type_of_course' => 'required',
            'start_of_the_course' => 'required',
            'end_of_the_course' => 'required',
            'course_content' => 'required',
            'img' => 'required'
        ]);

        $course = Course::find($course->id);

        if ($request->hasFile('img')) {

            $file = $request->img;
            $filename = $file->getClientOriginalName();
            $file->move('storage/', $filename);

            $course->img  = $filename;
            $course->name = $request->input('name');
            $course->language_id = $request->input('language_id');
            $course->level       = $request->input('level');
            $course->type        = $request->input('type');
            $course->min_members    = $request->input('min_members');
            $course->max_members    = $request->input('max_members');
            $course->type_of_course = $request->input('type_of_course');
            $course->start_of_the_course = $request->input('start_of_the_course');
            $course->end_of_the_course   = $request->input('end_of_the_course');
            $course->course_content      = $request->input('course_content');
            $course->price               = $request->input('price'); 
            $course->save();
        }
        return redirect()->route('admin.courses.index')->with('success', 'You have successfully updated the course');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Success');
    }

    

    public function getPurchasedCourses ()
    {
        $user_courses = UserCourse::all();
        return view('admin.courses.purchased_courses')->with('user_courses', $user_courses);

    }

    public function getPurchasedCoursesById ($id)
    {
        
        $user_course = UserCourse::find($id);
        $user_bill = UserBill::where('user_course_id', $user_course->id)
                            ->where('user_id', $user_course->user_id)->first();
                            
        return view('admin.courses.bill')->with([
            'user_course' => $user_course,
            'user_bill'   => $user_bill
        ]);
    }

    public function approve (Request $request, $id)
    {
        
        $user_course = UserCourse::find($id);
        $user_course->active = 1;
        $user_course->save();
        return redirect()->route('admin.courses.purchased_courses');

    }
     
}


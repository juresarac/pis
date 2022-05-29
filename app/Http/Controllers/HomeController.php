<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\UserCourse;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indexAdmin()
    {
        return view('admin.index');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indexTeacher()
    {
        return view('teacher.index');
    }

    public function getCourses ()
    {
        if (Auth::user()) {
            $user_courses = UserCourse::where('user_id', Auth::user()->id)->get();
            return view('front')->with([
                'courses' => Course::all(),
                'user_courses' => $user_courses
            ]);
        }
        return view('front')->with([
            'courses' => Course::all(),
        ]);
    }
}

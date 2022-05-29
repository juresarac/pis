<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\UserCourse;
use App\Models\Rating;
use App\Models\Lesson;
use DB;
use Auth;
use PDF;

class CourseController extends Controller
{
    public function rating (Request $request)
    {
        Rating::create($request->all());
        return response()->json(array('message'=> 'Success'), 200);
    }


    public function destroyRating ($id)
    {
        $rating = Rating::findOrFail($id);
        $rating->delete();
        return redirect()->back()->with('success', 'You have successfully deleted your comment');
    }

    public function invoice ()
    {
        $user_course = UserCourse::orderBy('id', 'desc')->first();
        
        $pdf = PDF::loadView('user.courses.show', compact('user_course'))->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('invoice.pdf');
    }

    public function checkoutCourseByCourseId ($id)
    {
        $course = Course::find($id);
        $course_id = $course->id;

        foreach ($course->user_course as $course) {
            if ($course_id == $course->pivot->course_id && $course->pivot->active == 1 && $course->pivot->user_id === Auth::user()->id) {
                return redirect()->route('user.course.lessons', $course_id);
            } elseif ($course_id == $course->pivot->course_id && $course->pivot->active == 2 && $course->pivot->user_id === Auth::user()->id) {
                return redirect()->route('user.profile');
            }
        }
        return view('user.courses.checkout')->with('course', Course::find($id));
    }

    public function buyCourseByCourseId (Request $request)
    {
        $this->validate($request, [
            'address' => 'required',
            'city' => 'required',
            'zip'   => 'required',
            'name_card'   => 'required',
            'number_card' => 'required',
            'exp_month'   => 'required|min:1|max:12',
            'exp_year'    => 'required|integer|min:2022|max:2032',
            'cvv' => 'required|min:3|max:5',
    
        ]);

        $user_course_find = UserCourse::where('user_id', $request->input('user_id'))
                ->where('course_id', $request->input('course_id'))->first();

        if ($user_course_find) {
            return view('user.courses.buy');
        } else {
            $user_course = new UserCourse();
            $user_course->insert($request->except('_token'));
            return view('user.courses.buy');
        }
    }

    public function showBuyCourseByCourseId ()
    {
        $last_entry = UserCourse::orderBy('id', 'desc')->first();
        return view('user.courses.show')->with('user_course', $last_entry);
    }

    public function getLessonsByCourseId ($id)
    {
        return view('user.courses.lessons')->with('course', Course::find($id));
    }

    public function getLessonById ($id, $lesson_id)
    {
        return view('lesson')->with('lesson', Lesson::find($lesson_id));
    }
    
}

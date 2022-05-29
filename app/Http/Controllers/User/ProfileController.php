<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\User;
use App\Models\Course;
use App\Models\UserCourse;
use App\Models\UserBill;

class ProfileController extends Controller
{

    public function index () 
    {
        
        $user = User::find(Auth::user()->id);
        //$results = DB::table('student_results')->where('user_id', Auth::user()->id)->get();
        $results = DB::table('user_result')->where('user_id', Auth::user()->id)->get();
        $user_coures = UserCourse::where('user_id', Auth::user()->id)->get();
        $user_bills = UserBill::where('user_id', Auth::user()->id)->get();
        $courses = Course::all();
        return view('user.profile.index')->with([
            'user' => $user,
            'results' => $results,
            'user_courses' => $user_coures,
            'user_bills' => $user_bills
        ]);
    }

    public function uploadBillById ($id)
    {
        $user_course = UserCourse::find($id);
        
        return view('user.profile.upload_bill')->with('user_course', $user_course);
    }

    public function uploadBill (Request $request)
    {
        $this->validate($request, [
            'pdf_file' => 'required'
        ]);

        $user_bill = new UserBill();

        if ($request->hasFile('pdf_file')) {

            $file = $request->pdf_file;
            
            $filename = $file->getClientOriginalName();
            $file->move('storage/', $filename);
            $user_bill->pdf_file  = $filename;
            $user_bill->user_id   = Auth::user()->id; 
            $user_bill->user_course_id = $request->input('user_course_id');
            $user_bill->save();
        } 

        $user_course = UserCourse::find($user_bill->user_course_id);
        
        $user_course->active = 2;
        $user_course->save();
        return redirect()->route('user.profile');
        
    }
}

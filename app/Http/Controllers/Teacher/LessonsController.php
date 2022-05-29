<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Course;
use Auth;
use Illuminate\Http\Request;

class LessonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('teacher.lessons.index')->with('courses', Course::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teacher.lessons.create')->with('courses', Course::all());
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
            'course' => 'required',
            'file' => 'required',
        ]);
   
        if ($request->hasFile('file')) {
            $file = $request->file;
            $filename = $file->getClientOriginalName();
            $file->move('storage/', $filename);
            $lesson = new Lesson();
            $lesson->name      = $request->input('name');
            $lesson->course_id = $request->input('course');
            $lesson->user_id   = Auth::user()->id;
            $lesson->file      = $filename;
            $lesson->save();
        }

        return redirect()->route('teacher.lessons.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function show($course_id)
    {
        return view('teacher.lessons.show')->with('course', Course::find($course_id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        
        return view('teacher.lessons.edit')->with([
            'lesson' => $lesson,
            'courses' => Course::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        $this->validate($request, [
            'name' => 'required',
            'course_id' => 'required',
            'file' => 'required',
        ]);
    if($lesson->user_id === Auth::user()->id){
        if ($request->hasFile('file')) {
            $file = $request->file;
            $filename = $file->getClientOriginalName();
            $file->move('storage/', $filename);
            $lesson = new Lesson();
            $lesson->name      = $request->input('name');
            $lesson->course_id = $request->input('course_id');
            $lesson->user_id   = Auth::user()->id;
            $lesson->file      = $filename;
            $lesson->save();
        }
        return redirect()->route('teacher.lessons.index');
    }
}
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {  
        if($lesson->user_id === Auth::user()->id){
            if ($lesson->delete()) {
            return redirect()->route('teacher.lessons.index')->with('success', 'You have successfully deleted the lesson');
        }
    }
        return redirect()->route('teacher.lessons.index')->with('error', 'You not deleted the lesson');  
    }
}

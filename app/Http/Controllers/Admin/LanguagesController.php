<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Course;
use Illuminate\Http\Request;

class LanguagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.languages.index')->with('languages', Language::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.languages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Language::create($request->all());
        return redirect()->route('admin.languages.index')->with('success','Language Added Successfully');
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function edit(Language $language)
    {
        return view('admin.languages.edit')->with('language', $language);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Language $language)
    {
        $this->validate($request, [
            'name' => 'required|min:2'
        ]);
        $language = Language::find($language->id);
        $language->name = $request->input('name');
        $language->update();
        return redirect()->route('admin.languages.index')->with('success','Language Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Language  $language
     * @return \Illuminate\Http\Response
     */
    public function destroy(Language $language)
    {
        $course = Course::where('language_id', $language->id);
        if ($course) {
            return redirect()->route('admin.languages.index')->with('warning','You can not delete the language because they depend courses first delete the courses');
            
        }
        if ($language->delete()) {
            return redirect()->route('admin.languages.index')->with('success','Language Deleted Successfully');
        }
        return redirect()->route('admin.languages.index')->with('error','Language has not Deleted');
    }

}

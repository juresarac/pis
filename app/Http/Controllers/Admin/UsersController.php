<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index')->with('users', User::all());
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Auth::user()->id == $user->id) {
            return redirect()->route('admin.users.index')->with('warning', 'You are not allowed to edit yourself');
        }
        $type = DB::select(DB::raw("SHOW COLUMNS FROM users WHERE Field = 'role'"))[0]->Type;

        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach( explode(',', $matches[1]) as $value ){
            $v = trim( $value, "'" );
            $enum = Arr::add($enum, $v, $v);
        }
        return view('admin.users.edit')->with([
            'user'  => $user,
            'roles' => $enum,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user = User::find($user->id);
        $user->role = $request->input('role');
        $user->update();
        return redirect()->route('admin.users.index')->with('success','User Updated Successfully');
    }

    public function updateStatus ($id)
    {
        $user = User::find($id);
        if (Auth::user()->id == $user->id) {
            return redirect()->route('admin.users.index')->with('warning', 'You are not allowed to edit yourself');
        }
        
        if ($user->is_active === 0) {
            $user->is_active = 1;
        } else {
            $user->is_active = 0;
        }
        $user->save();
        return redirect()->route('admin.users.index')->with('success','User Updated Successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (Auth::user()->id == $user->id) {
            return redirect()->route('admin.users.index')->with('warning', 'You are not allowed to edit yourself');
        }
        $user = User::find($user->id);
        if ($user->delete()) {
            return redirect()->route('admin.users.index')->with('success', 'You have successfully deleted a user');
        }
        return redirect()->route('admin.users.index')->with('error', 'You not deleted a user');
    }
}

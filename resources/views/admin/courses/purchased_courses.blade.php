@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Course name</th>
            <th scope="col">Level</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">Email</th>
            <th scope="col">Active</th>
            <th scope="col">View</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user_courses as $user_course)
                <tr>
                    <th scope="row">{{ $user_course->course->name }}</th>
                    <td>{{ $user_course->course->level }}</td>
                    <td>{{ $user_course->user->first_name }}</td>
                    <td>{{ $user_course->user->last_name  }}</td>
                    <td>{{ $user_course->user->email }}</td>
                    <td>{{ $user_course->active }}</td>
                    <td>
                      
                        @if( $user_course->active === 2)
                        <a href="{{ route('admin.courses.purchased_courses.show', $user_course->id) }}" class="btn btn-primary btn-sm">Show bill</a>
                        @elseif( $user_course->active === 1)
                            <button class="btn btn-success disabled btn-sm">Paid</button>
                        @endif
                     </td>
                </tr>
            @endforeach
           
            
        </tbody>
        </table>

    </div>
</div>

@endsection
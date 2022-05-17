@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10" style="border:1px solid silver">
            <div class="row">
                <div class="col-md-6" style="border:1px solid silver; height:250px">
                    <img src="{{ asset('storage/'. $course->img) }}" width="100%" height="100%" alt="...">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->name }} - {{ $course->level }}</h5>
                        <p class="card-text">{{ $course->course_content }}.</p>
                        <p class="card-text"><small class="text-muted">Last updated 13 hours ago</small></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Type</th>
                            <th scope="col">Min Members</th>
                            <th scope="col">Max Members</th>
                            <th scope="col">Type of course</th>
                            <th scope="col">Start course</th>
                            <th scope="col">End course</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">{{ $course->id }}</th>
                                <td>{{ $course->type }}</td>
                                <td>{{ $course->min_members }}</td>
                                <td>{{ $course->max_members }}</td>
                                <td>{{ $course->type_of_course }}</td>
                                <td>{{ $course->start_of_the_course }}</td>
                                <td>{{ $course->end_of_the_course }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

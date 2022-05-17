@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        @include('partials.alert')
            <div class="card">
                <div class="card-header">{{ __('Courses') }}</div>
                <div class="card-body">
                    <a href="{{ route('admin.courses.create') }}" class="btn btn-outline-primary mt-2 mb-4">Add new course</a>
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Level</th>
                            <th scope="col">Show</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                            <tr>
                                <th scope="row">{{ $course->id }}</th>
                                <td>{{ $course->name }}</td>
                                <td>{{ $course->level }}</td>
                                <td>
                                    <a href="{{ route('admin.courses.show', $course->id) }}"><button type="button" class="btn btn-outline-primary btn-sm">Show</button></a>           
                                </td>
                                <td>
                                    <a href="{{ route('admin.courses.edit', $course->id) }}"><button type="button" class="btn btn-outline-warning btn-sm">Edit</button></a>           
                                </td>
                                <td>
                                    <form action="{{ route('admin.courses.destroy', $course) }}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

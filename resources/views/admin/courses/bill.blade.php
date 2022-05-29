@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Course name</th>
                <th scope="col">Price</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Email</th>
                <th scope="col">Active</th>
                <th scope="col">Approve</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <th scope="row">{{ $user_course->course->name  }}</th>
                        <td>{{ $user_course->course->price }}</td>
                        <td>{{ $user_course->user->first_name }}</td>
                        <td>{{ $user_course->user->last_name  }}</td>
                        <td>{{ $user_course->user->email }}</td>
                        <td>{{ $user_course->active }}</td>
                        <td>
                             <form action="{{ route('admin.courses.approve',$user_course->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm">Approve</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
        </table>
        </div>
        
    <embed src="{{ asset('storage/'. $user_bill->pdf_file) }}" width="800px" height="1500px" />
                
    </div>
</div>
@endsection
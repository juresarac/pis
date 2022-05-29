@extends('layouts.header')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center pt-3">
                    <h4>{{ $course->name }}</h4>
                </div>
                
                <div class="card-body">
                    <ul class="fa-ul">
                        @foreach ($course->lessons as $c)
                            <li><span class="fa-li"><i class="fas fa-check"></i></span>{{ $c->name }}</li>
                            
                        @endforeach
                    </ul>
                    <hr>
                    @guest
                        <button type="button" class="btn btn-lg btn-block btn-outline-primary btn-block">Sign up for free</button>
                    @else
                        <a href="{{ route('course.lessons', $course->id) }}" class="btn btn-primary">Show</a>
                    @endguest
            
                </div>
            </div>
        </div>
        
       
    </div>
</div>
@endsection

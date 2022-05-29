@extends('layouts.public.header')

@section('content')
<img src="{{ asset('storage/online-courses.jpg') }}" width="100%" height="400px">                 
     
    <div class="container">
       
    @include('partials.alert')
        <section>
            <div class="jumbotron">      
                <h1 class="text-center" style="color: #4A5A80">Newest Courses</h1>
                <hr>
            </div>
        </section>


        <section class="pricing py-5">
            <div class="container">
                <div class="row">
                @foreach ($courses as $course)
                    <div class="col-md-4 my-2">
                        <div class="card">
                            <img src="{{ asset('storage/'. $course->img) }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h1 class="card-title pricing-card-title">${{ $course->price }} <small class="text-muted">/ mo</small></h1>
                                <h5 class="card-title">{{ $course->name }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $course->level }}</h6>
                                <p class="card-text">{{ $course->course_content }}.</p>
                                @if (Auth::user())
                                    <a href="{{ route('user.course.checkout', $course) }}" class="btn btn-block btn-outline-primary text-uppercase">Browse course</a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-block btn-outline-primary btn-block text-uppercase">Sign up for payment</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

                    {{--@foreach ($courses as $course)
                        <div class="col-md-4 text-center my-2">
                            <div class="card-body" style="border:1px solid">
                                <img src="{{ asset('storage/'. $course->img) }}" class="card-img-top" alt="...">
                                <h1 class="card-title pricing-card-title">${{ $course->price }} <small class="text-muted">/ mo</small></h1>
                                <h5 class="card-title">{{ $course->name }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $course->level }}</h6>
                                <h2 class="card-subtitle mb-2 text-muted">{{ $course->id }}</h2>
                                <p class="card-text">{{ $course->course_content }} .</p>
                               
                                @if (Auth::user())
                                    
                                     @foreach ($course->user_course as $user_course)
                                        @if ($user_course->pivot->active == 0)
                                        <a href="{{ route('user.course.checkout', $course) }}" class="btn btn-block btn-outline-danger text-uppercase">Confirm the purchase</a>
                                        @elseif ($user_course->pivot->active == 1)
                                            <a href="{{ route('user.course.lessons', $course) }}" class="btn btn-block btn-outline-primary text-uppercase">Browse course</a>
                                        @elseif ($user_course->pivot->active == 2)
                                            <h3>Na cekanju</h3>
                                        @endif
                                    @endforeach 
                                       
                                   
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-block btn-outline-primary btn-block text-uppercase">Sign up for payment</a>
                                @endif
                                
                                
                            </div>
                        </div>
                    @endforeach --}}






                
                {{-- @foreach($courses as $course)
                <div class="col-md-4 text-center">
                    <div class="card-body" style="border:1px solid">
                    {{ $course->id }}
                        <img src="{{ asset('storage/'. $course->img) }}" class="card-img-top" alt="...">
                        <h1 class="card-title pricing-card-title">${{ $course->price }} <small class="text-muted">/ mo</small></h1>
                        <h5 class="card-title">{{ $course->name }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $course->level }}</h6>
                        <p class="card-text">{{ $course->course_content }} .</p>
                        @if (Auth::user())
                        
                            @if (!$user_courses->isEmpty())
                                @foreach ($user_courses as $user_course)
                                    
                                    
                                    @if ($user_course->course_id === $course->id && $user_course->active == 1)
                                        <a href="{{ route('user.course.lessons', $course) }}" class="btn btn-block btn-outline-primary text-uppercase">Browse course</a>
                                    @elseif ($user_course->course_id === $course->id && $user_course->active == 2)
                                    <h3>Na cekanju</h3>
                                    @elseif ($user_course->course_id === $course->id && $user_course->active == 0)
                                    <a href="{{ route('user.course.checkout', $course) }}" class="btn btn-block btn-outline-danger text-uppercase">Confirm the purchase</a>
                                    <!--<a href="{{ route('user.course.checkout', $course) }}" class="btn btn-block btn-outline-danger text-uppercase">Buy course</a>-->
                                     @else
                                        @if ($user_course->course_id === $course->id && $user_course->active == 0)
                                        <a href="{{ route('user.course.checkout', $course) }}" class="btn btn-block btn-outline-danger text-uppercase">Buy course ELSE</a> 
                    
                                        @endif 
                                     @endif
                                @endforeach
                            @else
                            
                            <a href="{{ route('user.course.checkout', $course) }}" class="btn btn-block btn-outline-danger text-uppercase">Buy course</a>
                            @endif
                            
                            
                        @elseif (!Auth::user())
                            <a href="{{ route('login') }}" class="btn btn-block btn-outline-primary btn-block text-uppercase">Sign up for payment</a>
                        @endif
                        
                    </div>
                </div>
                    
                @endforeach --}}




                {{--
                    
                    @foreach ($courses as $course)
                    <div class="col-lg-4">
                        <div class="card mb-5 text-center">
                            <div class="card-header" style="background-color: #4A5A80">
                                <h4 class="my-0 font-weight-normal text-light">Free</h4>
                            </div>
                            <div class="card-body" style="border: 1px solid #4A5A80">
                                <img src="{{ asset('storage/'. $course->img) }}" class="card-img-top" alt="...">
                                <h1 class="card-title pricing-card-title">${{ $course->price }} <small class="text-muted">/ mo</small></h1>
                                <h5 class="card-title text-muted text-uppercase">{{ $course->name }}</h5>
                                <h6 class="text-center">{{ $course->level }}</h6>
                                <hr>
                                <ul class="list-group">
                                    @foreach ($course->lessons as $c)
                                        <li class="list-group-item d-flex justify-content-between align-items-start mb-1">{{ $c->name }}</li>
                                        @endforeach
                                    
                                   </ul>
                                @guest
                                    <a href="{{ route('login') }}" class="btn btn-block btn-outline-primary btn-block text-uppercase">Sign up for payment</a>
                                @else --}}

                               

                                {{--@if (empty($user_course))
                                    <a href="{{ route('user.course.checkout', $course) }}" class="btn btn-block btn-outline-danger text-uppercase">Buy course</a>
                                @endif --}}
                               {{-- @foreach($user_courses as $user_course)
                                    {{--@if (Auth::user()->id === $user_course->user_id && $course->id == $user_course->course_id && $user_course->active === 0) --}}
                                     <!--   <a href="{{-- route('user.course.checkout', $course) --}}" class="btn btn-block btn-outline-danger text-uppercase">Buy course</a>-->
                                    {{--@elseif (Auth::user()->id === $user_course->user_id && $course->id == $user_course->course_id && $user_course->active === 1) --}}
                                        <!--<a href="{{-- route('user.course.checkout', $course) --}}" class="btn btn-block btn-outline-danger text-uppercase">Buy course</a>-->

                                    {{-- @if (Auth::user()->id === $user_course->user_id && $course->id == $user_course->course_id && $user_course->active === 1)
                                        <a href="{{ route('user.course.lessons', $course) }}" class="btn btn-block btn-outline-primary text-uppercase">Browse course</a>
                                    @else
                                        <a href="{{ route('user.course.checkout', $course) }}" class="btn btn-block btn-outline-danger text-uppercase">Buy course</a>
                                    @endif --}}
                                {{--@endforeach --}}
                                {{-- $user_courses --}}
                                    
                                    {{--@if (Auth::user())
                                    <a href="{{ route('user.course.lessons', $course) }}" class="btn btn-block btn-outline-primary text-uppercase">Browse course</a>
                                    @elseif (Auth::user() && 2 == 2)
                                    <a href="{{ route('user.course.checkout', $course) }}" class="btn btn-block btn-outline-danger text-uppercase">Buy course</a>
                                    @endif --}}
                                {{--@endguest --}}
                                {{-- @if ($kupiotecaj)
                        
                                @endif 
                                 </div>
                        </div>
                    </div>
                    @endforeach--}}
                    
                </div>
            </div>
        </section>
    </div>

@endsection


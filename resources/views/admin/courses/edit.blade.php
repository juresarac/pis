@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit course') }}</div>
                <div class="card-body">
                <form action="{{ route('admin.courses.update', $course) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $course->name }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" min="1" max="1000" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                    <div class="mb-3">
                                    <label for="language_id">Language</label>
                                    <select id="language_id" name="language_id" class="form-select">
                                        <option selected="true" disabled="disabled">Choose...</option>
                                        @foreach ($languages as $language)
                                           <option value="{{ $language->id }}" {{ $language->id == $course->language_id ? 'selected' : '' }}>{{ $language->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                    <div class="mb-3">
                                    <label for="level">Level</label>
                                    <select id="level" name="level" class="form-select">
                                        <option selected="true" disabled="disabled">Choose...</option>
                                        <option value="beginner" {{ $course->level == 'beginner' ? 'selected' : '' }}>Beginner</option>
                                        <option value="intermediate" {{ $course->level == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                        <option value="advanced" {{ $course->level == 'advanced' ? 'selected' : '' }}>Advanced</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="type">Type</label>
                                    <select id="type" name="type" class="form-select">
                                        <option selected="true" disabled="disabled">Choose...</option>
                                        <option value="individual" {{ $course->type == 'individual' ? 'selected' : '' }}>Individual</option>
                                        <option value="group" {{ $course->type == 'group' ? 'selected' : '' }}>Group</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="min" class="form-label">Min Members</label>
                                    <input type="number" class="form-control @error('min_members') is-invalid @enderror" id="min" name="min_members" value="{{ $course->min_members }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="max" class="form-label">Max Members</label>
                                    <input type="number" class="form-control @error('max_members') is-invalid @enderror" id="max" name="max_members" value="{{ $course->max_members }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="type_of_course" class="form-label">Type of course</label>
                                    <select id="type_of_course" name="type_of_course" class="form-select">
                                        <option selected="true" disabled="disabled">Choose...</option>
                                        <option value="conversation" {{ $course->type_of_course == 'conversation' ? 'selected' : '' }}>Conversation</option>
                                        <option value="business" {{ $course->type_of_course == 'business' ? 'selected' : '' }}>Business</option>                
                                    </select>
                                </div>
                            </div>
                        </div>
                      
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="start_of_the_course" class="form-label">Date start</label>
                                    <input type="date" class="form-control" id="start_of_the_course" name="start_of_the_course"  value="{{ Carbon\Carbon::parse($course->start_of_the_course)->format('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="end_of_the_course" class="form-label">Date end</label>
                                    <input type="date" class="form-control" id="end_of_the_course" name="end_of_the_course"  value="{{ Carbon\Carbon::parse($course->end_of_the_course)->format('Y-m-d') }}">
                                </div>
                            </div>
                        </div>
                            <div class="mb-3">
                                <label for="course_content" class="form-label">Content</label>
                                <input type="text" class="form-control" id="course_content" name="course_content" value="{{ $course->course_content }}">
                            </div>
                            <div class="mb-3">
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control @error('img') is-invalid @enderror" id="img" name="img">
                                    <label class="input-group-text" for="img">Upload</label>
                                </div>
                            </div>
                        <button type="submit" class="btn btn-outline-primary mt-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

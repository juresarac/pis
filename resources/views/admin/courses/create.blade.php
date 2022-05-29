@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Course') }}</div>
                <div class="card-body">
                <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
                                    <select id="language_id" name="language_id" class="form-select @error('language_id') is-invalid @enderror">
                                        <option selected="true" disabled="disabled">Choose...</option>
                                        @foreach ($languages as $language)
                                            <option value="{{ $language->id }}">{{ $language->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                    <div class="mb-3">
                                    <label for="level">Level</label>
                                    <select id="level" name="level" class="form-select @error('level') is-invalid @enderror">
                                        <option selected="true" disabled="disabled">Choose...</option>
                                        <option value="beginner">Beginner</option>
                                        <option value="intermediate">Intermediate</option>
                                        <option value="advanced">Advanced</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="type">Type</label>
                                    <select id="type" name="type" class="form-select @error('type') is-invalid @enderror">
                                        <option selected="true" disabled="disabled">Choose...</option>
                                        <option value="individual">Individual</option>
                                        <option value="group">Group</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="min" class="form-label">Min</label>
                                        <input type="number" class="form-control @error('min_members') is-invalid @enderror" id="min" name="min_members" value="{{ old('min_members') }}">
                                        @error('min_members')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="max" class="form-label">Max</label>
                                        <input type="number" class="form-control @error('max_members') is-invalid @enderror" id="max" name="max_members" value="{{ old('max_members') }}">
                                        @error('max_members')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="type_of_course" class="form-label">Type of course</label>
                                    <select id="type_of_course" name="type_of_course" class="form-select @error('max_members') is-invalid @enderror">
                                        <option selected="true" disabled="disabled">Choose...</option>
                                        <option value="conversation">Conversation</option>
                                        <option value="business">Business</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                      
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="start_of_the_course" class="form-label">Date start</label>
                                    <input type="date" class="form-control @error('start_of_the_course') is-invalid @enderror" id="start_of_the_course" name="start_of_the_course"  value="{{ old('start_of_the_course') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="end_of_the_course" class="form-label">Date end</label>
                                    <input type="date" class="form-control  @error('end_of_the_course') is-invalid @enderror" id="end_of_the_course" name="end_of_the_course"  value="{{ old('end_of_the_course') }}">
                                </div>
                            </div>
                        </div>
                            <div class="mb-3">
                                <label for="course_content" class="form-label">Content</label>
                                <input type="text" class="form-control @error('course_content') is-invalid @enderror" id="course_content" name="course_content"  value="{{ old('course_content') }}">
                                @error('course_content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control  @error('img') is-invalid @enderror" id="img" name="img">
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

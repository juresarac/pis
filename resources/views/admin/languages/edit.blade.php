@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Edit Language') }}</div>

                <div class="card-body">
                    <form action="{{ route('admin.languages.update', $language->id) }}" method="POST">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="mb-3">
                            <label for="name" class="form-label  @error('name') is-invalid @enderror">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $language->name }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

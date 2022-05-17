@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Edit user: {{ $user->first_name }}</div>

                <div class="card-body">
                   
                   <form action="{{ route('admin.users.update', $user) }}" method="POST">
                        @csrf
                        {{ method_field('PUT') }}
                        @foreach ($roles as $role)
                        <div class="col-md-12 form-check mt-2">
                            <input type="radio" class="flat" name="role" id="role" value="{{ $role }}" 
                                {{ $user->role == $role ? 'checked' : '' }} >                    
                            <label class="form-check-label" for="role"> {{ $role }} </label>
                        </div> 
                        @endforeach
                        <button type="submit" class="btn btn-outline-primary">
                            Update
                        </button>
                   </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

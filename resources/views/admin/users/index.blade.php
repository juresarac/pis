@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
        @include('partials.alert')
            <div class="card">
                <div class="card-header">{{ __('Users') }}</div>
                <div class="card-body">
                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Id</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Email</th>
                        <th scope="col">Active</th>
                        <th scope="col">Role</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->is_active === 1)
                                    <button disabled class="btn btn-success btn-sm">Activated</button>
                                    <a href="{{ route('admin.users.update.status', $user->id) }}" class="btn btn-danger btn-sm">Deactivate</a>
                                    @else
                                    <a href="{{ route('admin.users.update.status', $user->id) }}" class="btn btn-success btn-sm">Activate</a>
                                    <button disabled class="btn btn-danger btn-sm">Deactivate</button>
                                @endif

                            </td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user->id) }}"><button type="button" class="btn btn-outline-warning btn-sm">Edit</button></a>           
                            </td>
                            <td>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
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

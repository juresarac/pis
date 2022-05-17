@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
        @include('partials.alert')
            <div class="card">
                <div class="card-header">{{ __('Languages') }}</div>
                <div class="card-body">
                <a href="{{ route('admin.languages.create') }}" class="btn btn-outline-primary mt-2 mb-4">Add new language</a>
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Id</th>
                            <th scope="col">First</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($languages as $language)
                            <tr>
                                <th scope="row">{{ $language->id }}</th>
                                <td>{{ $language->name }}</td>
                                <td>
                                    <a href="{{ route('admin.languages.edit', $language->id) }}"><button type="button" class="btn btn-outline-warning btn-sm">Edit</button></a>           
                                </td>
                                <td>
                                    <form action="{{ route('admin.languages.destroy', $language) }}" method="POST">
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

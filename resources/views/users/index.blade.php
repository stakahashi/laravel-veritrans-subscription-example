@extends('layouts.default')

@section('content')
<div class="container">
    <h1>Users</h1>

    <div class="mb-3"><a href="{{ action('UserController@create') }}" class="btn btn-primary">ADD</a></div>

    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>
                    <a class="btn btn-secondary" href="{{ route('user.show', ['id' => $user->id]) }}">SHOW</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

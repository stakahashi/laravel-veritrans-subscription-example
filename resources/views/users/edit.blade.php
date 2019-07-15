@extends('layouts.default')

@section('content')
<div class="container">
    <h1>Users / Create</h1>

    <form action="{{ $action }}" method="{{ $method }}">
        {{ csrf_field() }}

        <div class="form-group">
            <label>Name</label>
            <input class="form-control" name="name" />
        </div>

        <div class="form-group">
            <label>Email</label>
            <input class="form-control" type="email" name="email" />
        </div>

        <div class="form-group">
            <label>Password</label>
            <input class="form-control" type="password" name="password" />
        </div>

        <button class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection

@extends('layouts.default')

@section('content')
<div class="container">
    <h1>Users / {{ $user->name }}</h1>

    @if (session('msg'))
    <div class="alert alert-danger" role="alert">
        {{ session('msg') }}
    </div>
    @endif

    <dl class="row">
        <dt class="col-sm-3">id</dt>
        <dd class="col-sm-9">{{ $user->id }}</dd>

        <dt class="col-sm-3">name</dt>
        <dd class="col-sm-9">{{ $user->name }}</dd>

        <dt class="col-sm-3">email</dt>
        <dd class="col-sm-9">{{ $user->email }}</dd>
    </dl>

    <h2>Subscription</h2>
    @if (!$user->subscription)
    <form action="{{ route('subscription.store') }}" method="POST">
        {{ csrf_field() }}

        <input type="hidden" name="user_id" value="{{ $user->id }}" />

        <div class="form-group">
            <label>Plan</label>
            <select name="plan_id" class="form-control">
                @foreach ($plans as $plan)
                <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Card Number</label>
            <input class="form-control" type="number" name="number" value="4111111111111111" />
        </div>

        <div class="form-group">
            <label>Code</label>
            <input class="form-control" type="number" name="cvv" value="123" />
        </div>

        <div class="form-group">
            <label>Period</label>
            <div class="form-inline">
                <input class="form-control mr-2" placeholder="MM" type="number" name="month" value="01" /> / <input class="form-control ml-2" placeholder="YY" type="number" name="year" value="25" />
            </div>
        </div>

        <button class="btn btn-primary">Submit</button>
    </form>
    @else
    <dl class="row">
        <dt class="col-sm-3">id</dt>
        <dd class="col-sm-9">{{ $user->subscription->id }}</dd>

        <dt class="col-sm-3">name</dt>
        <dd class="col-sm-9">{{ $user->subscription->plan->name }}</dd>

        <dt class="col-sm-3">price</dt>
        <dd class="col-sm-9">{{ $user->subscription->plan->price }}</dd>

        <dt class="col-sm-3">start</dt>
        <dd class="col-sm-9">{{ $user->subscription->start }}</dd>

        <dt class="col-sm-3">end</dt>
        <dd class="col-sm-9">{{ $user->subscription->end }}</dd>
    </dl>
    @endif
</div>
@endsection

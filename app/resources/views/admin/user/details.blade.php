@extends('layouts.admin')

@section('title')
{{ 'Users' }}
@endsection

@section('content')

<div class="container">
    <div class="row my-3">
        <div class="d-flex justify-content-between align-items-center">
            <h1>{{ $user->first_name }}</h1>
            <a href="{{ route('admin.users') }}">
                <button class="btn btn-primary">{{ __('admin/users.back') }}</button>
            </a>
        </div>

        @if (!$user)
        <div class="card p-5 d-flex justify-content-center align-items-center">
            <h2>{{ __('admin/users.empty') }}</h2>
        </div>
        @else
        <div class="card p-3">
            <div class="row my-2">
                <div class="col-6">
                    <h5>{{ __('auth/userdetails.firstname') }}: </h5>
                    {{ $user->first_name }}
                </div>
                <div class="col-6">
                    <h5>{{ __('auth/userdetails.lastname') }}: </h3>
                    {{ $user->last_name }}
                </div>
            </div>
            <div class="row my-2">
                <div class="col-6">
                    <h5>{{ __('auth/userdetails.phoneno') }}: </h5>
                    {{ $user->phone_no }}
                </div>
                <div class="col-6">
                    <h5>{{ __('auth/userdetails.email') }}: </h3>
                    {{ $user->email }}
                </div>
            </div>
            <div class="row my-2">
                <div class="col-6">
                    <h5>{{ __('auth/userdetails.address1') }}: </h5>
                    {{ $user->address1 }}
                </div>
                <div class="col-6">
                    <h5>{{ __('auth/userdetails.address2') }}: </h3>
                    {{ $user->address2 ?? '-' }}
                </div>
            </div>
            <div class="row my-2">
                <div class="col-6">
                    <h5>{{ __('auth/userdetails.city') }}: </h5>
                    {{ $user->city }}
                </div>
                <div class="col-6">
                    <h5>{{ __('auth/userdetails.state') }}: </h3>
                    {{ $user->state }}
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <h5>{{ __('auth/userdetails.country') }}: </h5>
                    {{ $user->country }}
                </div>
                <div class="col-6">
                    <h5>PIN code: </h3>
                    {{ $user->pincode }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@endsection

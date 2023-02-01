@extends('layouts.admin')

@section('title')
{{ 'Users' }}
@endsection

@section('content')

<div class="container">
    <div class="row my-3">
        <div class="d-flex justify-content-between">
            <h1>{{ __('admin/users.user') }}</h1>
        </div>

        @if ($users->isEmpty())
        <div class="card p-5 d-flex justify-content-center align-items-center">
            <h2>{{ __('admin/users.empty') }}</h2>
        </div>
        @else
        <div class="card p-3">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                    <tr>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('admin/users.name') }}</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('admin/users.email') }}</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('admin/users.roleas') }}</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('admin/users.more') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td class="text-center">{{ $user->id }}</td>
                            <td class="text-center"><h6>{{ $user->name }}</h6></td>
                            <td class="text-center"><p>{{ $user->email }}</p></td>
                            <td class="text-center"><p>{{ $user->role_as == 1 ? __('admin/users.adminrole') : __('admin/users.userrole') }}</p></td>
                            <td class="text-center">
                                <a href="{{ route('admin.users.details', ['user' => $user]) }}"><button class="btn btn-primary">{{ __('admin/users.details') }}</button></a>
                            </td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</div>

@endsection

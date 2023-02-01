@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row my-3">
            <div class="d-flex justify-content-between">
                <h1>{{ __('admin/categories.categories') }}</h1>
                <a href="{{ route('admin.category.create') }}" class="btn btn-primary">{{ __('admin/categories.addcat') }}</a>
            </div>

            @if ($categories->isEmpty())
            <div class="card p-5 d-flex justify-content-center align-items-center">
                <h2>{{ __('admin/categories.empty') }}</h2>
            </div>
            @else
            <div class="card p-3">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{ __('admin/categories.name') }}</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('admin/categories.description') }}</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('admin/categories.image') }}</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('admin/categories.more') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td class="text-center">{{ $category->id }}</td>
                                <td class="text-center"><h6>{{ $category->name }}</h6></td>
                                <td class="text-center"><p>{{ $category->description }}</p></td>
                                <td class="text-center"><img src="{{ asset('/uploads/category/'.$category->image) }}" alt="" height="100" width="100"></td>
                                <td class="text-center">
                                    <a href="{{ route('admin.category.edit', ['category' => $category]) }}" class="btn btn-primary">{{ __('admin/categories.edit') }}</a>
                                    <a href="{{ route('admin.category.delete', ['category' => $category]) }}" class="btn btn-primary">{{ __('admin/categories.delete') }}</a>
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

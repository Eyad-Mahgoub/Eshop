@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('auth/userdetails.title') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('userdetails.store') }}">
                        @csrf
                        <input type="text" name="user_id" class="d-none" value="{{ $user->id }}">

                        <div class="row mb-3">
                            <div class="col-md-6 mt-3">
                                <label for="">{{ __('auth/userdetails.firstname') }}</label>
                                <input name="first_name" type="text" class="first_name form-control" placeholder="{{ __('auth/userdetails.firstname') }}" value="{{ old('first_name') }}">
                                @error('first_name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="col-md-6 mt-3">
                                <label for="">{{ __('auth/userdetails.lastname') }}</label>
                                <input name="last_name" type="text" class="last_name form-control" placeholder="{{ __('auth/userdetails.lastname') }}" value="{{ old('last_name') }}">
                                @error('last_name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="col-md-6 mt-3">
                                <label for="">{{ __('auth/userdetails.email') }}</label>
                                <input name="email" type="text" class="email form-control" placeholder="{{ __('auth/userdetails.email') }}" value="{{ $user->email }}">
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="col-md-6 mt-3">
                                <label for="">{{ __('auth/userdetails.phoneno') }}</label>
                                <input name="phone_no" type="text" class="phone_no form-control" placeholder="{{ __('auth/userdetails.phoneno') }}" value="{{ old('phone_no') }}">
                                @error('phone_no')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="col-md-6 mt-3">
                                <label for="">{{ __('auth/userdetails.address1') }}</label>
                                <input name="address1" type="text" class="address1 form-control" placeholder="{{ __('auth/userdetails.address1') }}" value="{{ old('address1') }}">
                                @error('address1')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="col-md-6 mt-3">
                                <label for="">{{ __('auth/userdetails.address2') }}</label>
                                <input name="address2" type="text" class="address2 form-control" placeholder="{{ __('auth/userdetails.address2') }} (Optional)" value="{{ old('address2') }}">
                                @error('address2')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="col-md-6 mt-3">
                                <label for="">{{ __('auth/userdetails.city') }}</label>
                                <input name="city" type="text" class="city form-control" placeholder="{{ __('auth/userdetails.city') }}" value="{{ old('city') }}">
                                @error('city')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="col-md-6 mt-3">
                                <label for="">{{ __('auth/userdetails.state') }}</label>
                                <input name="state" type="text" class="state form-control" placeholder="{{ __('auth/userdetails.state') }}" value="{{ old('state') }}">
                                @error('state')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="col-md-6 mt-3">
                                <label for="">{{ __('auth/userdetails.country') }}</label>
                                <input name="country" type="text" class="country form-control" placeholder="{{ __('auth/userdetails.country') }}" value="{{ old('country') }}">
                                @error('country')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="col-md-6 mt-3">
                                <label for="">PIN Code</label>
                                <input name="pincode" type="text" class="pincode form-control" placeholder="Enter Pin Code" value="{{ old('pincode') }}">
                                @error('pincode')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">{{ __('auth/userdetails.save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

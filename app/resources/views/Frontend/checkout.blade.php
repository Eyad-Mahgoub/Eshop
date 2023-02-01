@extends('layouts.front')

@section('lang')
<ul class="dropdown-menu">

    @foreach (config('laravellocalization.supportedLocales') as $key => $local)
        @if ($key != app()->getLocale())
            <li>
                <a class="dropdown-item" rel="alternate" hreflang="{{ $key }}" href="{{ LaravelLocalization::getLocalizedURL($key, route(Route::currentRouteName())) }}">
                    {{ $local['native'] }} - {{ $key }}
                </a>
            </li>
        @endif

    @endforeach
</ul>
@endsection

@section('content')
<?php $total = 0; ?>

<div class="container my-3">
    <div class="row">
        <div class="col-md-7">
            <form action="{{ route('checkout.placeOrder') }}" method="post">
                @csrf

                <div class="card">
                    <div class="card-body">
                        <h6>{{ __('frontend/index.checkout') }}</h6>

                        <hr>

                        <div class="row form-checkout">
                            <div class="col-md-6 mt-3">
                                <label for="">{{ __('auth/userdetails.firstname') }}</label>
                                <input name="first_name" type="text" class="first_name form-control" placeholder="Enter First Name" value="{{ $userDetails->first_name }}">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">{{ __('auth/userdetails.lastname') }}</label>
                                <input name="last_name" type="text" class="last_name form-control" placeholder="Enter Last Name" value="{{ $userDetails->last_name }}">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">{{ __('auth/userdetails.email') }}</label>
                                <input name="email" type="text" class="email form-control" placeholder="Enter Email" value="{{ $userDetails->email }}">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">{{ __('auth/userdetails.phoneno') }}</label>
                                <input name="phone_no" type="text" class="phone_no form-control" placeholder="Enter Phone Number" value="{{ $userDetails->phone_no }}">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">{{ __('auth/userdetails.address1') }}</label>
                                <input name="address1" type="text" class="address1 form-control" placeholder="Enter Address" value="{{ $userDetails->address1 }}">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">{{ __('auth/userdetails.address2') }}</label>
                                <input name="address2" type="text" class="address2 form-control" placeholder="Enter Address (Optional)" value="{{ $userDetails->address2 }}">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">{{ __('auth/userdetails.city') }}</label>
                                <input name="city" type="text" class="city form-control" placeholder="Enter City" value="{{ $userDetails->city }}">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">{{ __('auth/userdetails.state') }}</label>
                                <input name="state" type="text" class="state form-control" placeholder="Enter State" value="{{ $userDetails->state }}">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">{{ __('auth/userdetails.country') }}</label>
                                <input name="country" type="text" class="country form-control" placeholder="Enter Country" value="{{ $userDetails->country }}">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Pin Code</label>
                                <input name="pincode" type="text" class="pincode form-control" placeholder="Enter Pin Code" value="{{ $userDetails->pincode }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h6>{{ __('frontend/index.basicdetails') }}</h6>
                        <hr>

                        <table class="w-100">
                            <thead>
                                <th>{{ __('frontend/index.name') }}</th>
                                <th>{{ __('frontend/index.quantity') }}</th>
                                <th>{{ __('frontend/index.price') }}</th>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $item)
                                <tr>
                                    <td>
                                        {{ $item->product->name }}
                                    </td>
                                    <td>
                                        {{ $item->prod_qty }}
                                    </td>
                                    <td>
                                        ${{ $item->product->selling_price }}
                                    </td>
                                </tr>
                                <?php $total += $item->product->selling_price * $item->prod_qty ?>
                                @endforeach
                                <tr>
                                    <th>{{ __('frontend/index.total') }}</th>
                                    <td></td>
                                    <td>${{ $total }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <button type="submit" class="btn btn-primary w-100 my-3">{{ __('frontend/index.cod') }}</button>
                        <div id="paypal-button-container"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('title', 'Checkout')

@section('scripts')
<script src="https://www.paypal.com/sdk/js?client-id=ASq34EjrQ1DahPJ3LQnQ953YNVbNFkWqSkdMmDiPvxoEOazO46yt1MjO47bjzmuwc66EU22xS66mcj7u&currency=USD"></script>
<script>
    paypal.Buttons({
      // Sets up the transaction when a payment button is clicked
      createOrder: (data, actions) => {
        return actions.order.create({
          purchase_units: [{
            amount: {
              value: '{{ $total }}' // Can also reference a variable or function
            }
          }]
        });
      },
      // Finalize the transaction after payer approval
      onApprove: (data, actions) => {
        return actions.order.capture().then(function(orderData) {
          // Successful capture! For dev/demo purposes:
            let data = {
                'first_name'  : $('.first_name').val(),
                'last_name'   : $('.last_name').val(),
                'email'       : $('.email').val(),
                'phone_no'    : $('.phone_no').val(),
                'address1'    : $('.address1').val(),
                'address2'    : $('.address2').val(),
                'city'        : $('.city').val(),
                'state'       : $('.state').val(),
                'country'     : $('.country').val(),
                'pincode'     : $('.pincode').val(),
                'type'        : 'paypal',
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: "/place-order",
                data: data,
                success: function (response) {
                    Swal.fire({
                        title: "Order Placed Succesfully",
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((value) => {
                        window.location.href = '/my-orders';
                    });
                }
            });
        });
      }
    }).render('#paypal-button-container');
</script>
@endsection

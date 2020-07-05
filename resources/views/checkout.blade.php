@extends('layout')

@section('customCSS')
    <link rel="stylesheet" href="{{asset('styles/cart.css')}}">
    <link rel="stylesheet" href="/styles/player.css">
    <link rel="stylesheet" href="{{asset('styles/checkout.css')}}">
@endsection

@php
    if(Auth::user()->carted()->count() > 0)
        $percentOff = round(100 - $total / Auth::user()->carted->sum('price') * 100, 0);
    $egpToUsd = \App\Http\Controllers\PaymentController::getEGPtoUSD();
@endphp

@section('content')

<div class="new-bg"></div>
<section class="sntra">
    <div class="container ">
        <div class="row">
            <div class="col-12 col-lg-8" id="course-info">
                <h2>Choose your payment method:</h2>
                <ul class="nav nav-pills mb-3 row" id="pills-tab" role="tablist">
                    <li class="nav-item col-12 col-lg-6 my-3" role="presentation">
                        <a class="nav-link" id="paypal-toggle-tab" data-toggle="pill" href="#paypal-toggle" role="tab" aria-controls="paypal-toggle" aria-selected="false">
                            <span class="check">
                                <i data-feather="check"></i>
                            </span>
                            <img class="img-fluid" src="{{asset('images')}}/paypal-logo.png" alt="">
                        </a>
                    </li>
                    <li class="nav-item col-12 col-lg-6 my-3" role="presentation">
                        <a class="nav-link active" id="accept-toggle-tab" data-toggle="pill" href="#accept-toggle" role="tab" aria-controls="accept-toggle" aria-selected="true">
                            <span class="check">
                                <i data-feather="check"></i>
                            </span>
                            <img class="img-fluid" src="{{asset('images')}}/masari-logo.png" alt="">
                            <img class="img-fluid aman p-3" src="{{asset('images')}}/aman-logo.png" alt="">
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-12 col-lg-4">
                <div class="cart-sammery shadow-sm p-3 my-3 rounded">
                    <ul>
                        <li class="mb-3">
                            <b class="text-muted font-weight-bold">
                                Courses:
                            </b>
                        </li>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade" id="paypal-toggle" role="tabpanel" aria-labelledby="paypal-toggle-tab">
                    @if(count($courses) > 0)
                        @foreach($courses as $course)
                            <li
                                class="d-flex justify-content-between mb-3">
                                <p class="p-title my-0 text-muted"
                                   style="width: 200px; white-space: nowrap; overflow: hidden;
                                        text-overflow: ellipsis;">{{$course['name']}}</p>
                                <span class="font-weight-bolder" style="color: #65D3BF">
                                        {{$course['price'] == 0 ? 'FREE' : '$' . number_format($course['price'] * $egpToUsd, 2, '.', '')}}
                                    </span>
                            </li>

                        @endforeach
                    <li class="mt-3">
                        <p class="total text-muted">Sub total:</p>
                    </li>
                    @if($percentOff > 0)
                        <li>
                            <h3 class="font-weight-bold strike-through d-inline-block" style="color: #D36565;">${{number_format(Auth::user()->carted->sum('price') * $egpToUsd, 2, '.', '')}}</h3>
                        </li>
                        <li class="d-flex align-items-baseline">
                            <h3 class="font-weight-bold" style="color: #65D3BF">${{number_format($total * $egpToUsd, 2, '.', '')}}</h3>
                            <span class="font-weight-bold text-muted ml-2">({{$percentOff}}% off)</span>
                        </li>
                    @else
                        <li class="d-flex">
                            <h3 class="font-weight-bold" style="color: #65D3BF">${{number_format($total * $egpToUsd, 2, '.', '')}}</h3>
                        </li>
                    @endif
                    <li>
                    <li class="mt-3 px-4 d-flex justify-content-center align-items-center">
                        <div id="paypal-button" class="px-5"></div>
                    </li>
                    @else
                        <li>
                            <h1 class="my-5 py-5 text-muted text-center">You don't have any courses in your cart yet.</h1>
                        </li>
                    @endif
                </div>
                <div class="tab-pane fade show active" id="accept-toggle" role="tabpanel" aria-labelledby="accept-toggle-tab">
                    @if(count($courses) > 0)
                        @foreach($courses as $course)
                            <li
                                class="d-flex justify-content-between mb-3">
                                <p class="p-title my-0 text-muted"
                                   style="width: 200px; white-space: nowrap; overflow: hidden;
                                        text-overflow: ellipsis;">{{$course['name']}}</p>
                                <span class="font-weight-bolder" style="color: #65D3BF">
                                        {{$course['price'] == 0 ? 'FREE' : $course['price'] . ' EGP' }}
                                    </span>
                            </li>

                        @endforeach

                    <li class="mt-3">
                        <p class="total text-muted">Sub total:</p>
                    </li>
                    @if($percentOff > 0)
                        <li>
                            <h3 class="font-weight-bold strike-through d-inline-block" style="color: #D36565;">{{Auth::user()->carted->sum('price')}} EGP</h3>
                        </li>
                        <li class="d-flex align-items-baseline">
                            <h3 class="font-weight-bold" style="color: #65D3BF">{{number_format($total, 2, '.', '')}} EGP</h3>
                            <span class="font-weight-bold text-muted ml-2">({{$percentOff}}% off)</span>
                        </li>
                    @else
                        <li class="d-flex">
                            <h3 class="font-weight-bold" style="color: #65D3BF">{{$total}} EGP</h3>
                        </li>
                    @endif
                    <li>
                    <li class="mt-3">
                        <a href="/cart/checkout/accept{{$code ? '?code=' . $code : ''}}" class="btn btn-veedros-new btn-veedros-red m-auto btn-veedros-md border-0">Check out</a>
                    </li>
                    @else
                        <li>
                            <h1 class="my-5 py-5 text-muted text-center">You don't have any courses in your cart yet.</h1>
                        </li>
                    @endif
                </div>
            </div>


                            <div class="btn-redeem-veedros m-auto pt-3">
                                <form method="GET" action="/cart/checkout">
                                    <input class="btn-redeem form-control profile-form-field email-field-props border-light border-radius-sm" placeholder="Add Coupon" type="text" name="code">
                                    <button class="btn-redeem-icon border-0">
                                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

        </div>



        <div class="row my-5">
            <a href="courses/" class="btn btn-veedros-new btn-veedros-md border-0 mx-auto">
                <span>Explore more courses</span>
            </a>

        </div>

    </div>
</section>
@endsection

@section('customJS')
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>

    <script>
        window.enrollmentID = null;
        paypal.Button.render({
            env: 'sandbox', // Or 'production',
            style: {
                size: 'large',
                color: 'blue',
                shape: 'pill',
                tagline: 'false'
            },
            // Set up the payment:
            // 1. Add a payment callback
            payment: function(data, actions) {
                // 2. Make a request to your server
                return actions.request.post('/api/paypal/create-payment/{{Auth::user()->id . '/' . ($code ? $code : 'null')}}')
                    .then(function(res) {
                        // 3. Return res.id from the response
                        window.enrollmentID = res.enrollment_id;
                        return res.id;
                    });
            },
            // Execute the payment:
            // 1. Add an onAuthorize callback
            onAuthorize: function(data, actions) {
                // 2. Make a request to your server
                return actions.request.post('/api/paypal/execute-payment', {
                    paymentID: data.paymentID,
                    payerID:   data.payerID,
                    enrollmentID: window.enrollmentID
                })
                    .then(function(res) {
                        if(res.state == 'approved'){
                        Swal.fire({
                            toast:true,
                            position: 'top',
                            icon: 'success',
                            title: "Payment successful! You'll be redirected to your dashboard in 3 seconds.",
                            showConfirmButton: false,
                            timer: 10000,
                            allowOutsideClick:true,
                            showCloseButton:true
                        })
                        setTimeout(function(){
                            window.location.href = '/dashboard';
                        }, 3000);
                        }
                        else{
                            Swal.fire({
                                toast:true,
                                position: 'top',
                                icon: 'error',
                                title: "Oops! Something went wrong with your payment.",
                                allowOutsideClick:true,
                                timer: 10000,
                            })
                        }
                    });
            }
        }, '#paypal-button');
    </script>
@endsection

@extends('layout')

@section('customCSS')
    <link rel="stylesheet" href="{{asset('styles/cart.css')}}">
@endsection
@php
    if(Auth::user()->carted()->count() > 0)
        $percentOff = round(100 - $total / Auth::user()->carted->sum('price') * 100, 0);
@endphp
@section('content')

<div class="new-bg"></div>
<section class="sntra">

    <div class="container ">
        <div class="row flex-row-reverse ">
            <div class="col-12 col-lg-4">
                <div class="cart-sammery shadow-sm p-3 my-3 rounded">
                    <ul>
                        @if(count(Auth::user()->carted) > 0)
                            @foreach(Auth::user()->carted as $course)
                                <li
                                    class="d-flex justify-content-between mb-3">
                                    <p class="p-title my-0 text-muted"
                                       style="width: 200px; white-space: nowrap; overflow: hidden;
                                        text-overflow: ellipsis;">{{$course['name']}}</p>
                                    <span class="font-weight-bolder" style="color: #65D3BF">
                                        {{$course['price'] == 0 ? 'FREE' :$course['price'] . ' EGP' }}
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
                            @endif
                        <li>
                            <a href="/cart/checkout{{$code ? '?code=' . $code : ''}}" class="btn btn-veedros-new btn-veedros-red m-auto btn-veedros-md border-0">Check out </a>
                        </li>
                        <li>
                            <div class="btn-redeem-veedros m-auto pt-3">
                                <form method="GET" action="/cart">
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
            <div class="col-lg-8 col-md-auto col-12 test-best px-4">
                @if(count(Auth::user()->carted) > 0)
                    @foreach(Auth::user()->carted as $course)
                    <div class="row  cart-card shadow-sm my-3   rounded-lg-mine">
                        <div class="col-3 align-self-center ">
                            <div class="card course-card  development-card noJquery" style="background-image: url({{$course->img}})">
                            </div>
                        </div>
                        <div class="col-5 align-self-center ">
                            <div class="container ">
                                <div class="">

                                    <div>

                                        <p class="p-title">{{$course->name}}</p>
                                        <ul class="menu">
                                            <p class="p-description d-none-mine">{{$course->about}}
                                            </p>

                                        </ul>
                                    </div>

                                </div>



                            </div>
                        </div>
                        <div class="col-4 align-self-center ">
                            <div class="cart-options">
                                <ul class="px-2">
                                    <div class="">
                                        <li>
                                            <a href="/cart/remove/{{$course->id}}">Remove</a>
                                        </li>
                                        <li>
                                            <a href="/save/{{$course->id}}">Add to saved</a>
                                        </li>

                                    </div>

                                </ul>

                                <ul class="px-2">
                                    <div class="">
                                        <li>
                                            <span class="font-weight-bolder" style="color: #65D3BF">
                                        {{$course->price}} EGP
                                        </span>
                                        </li>
                                    </div>

                                </ul>
                            </div>

                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="d-flex w-100 h-100 justify-content-center align-items-center">
                        <h1 class="text-muted text-center my-auto">You don't have any courses in your cart yet.</h1>
                    </div>
                @endif

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


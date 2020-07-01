@extends('layout')

@section('customCSS')
    <link rel="stylesheet" href="{{asset('styles/cart.css')}}">
@endsection

@section('content')

<div class="new-bg"></div>
<section class="sntra">

    <div class="container ">
        <div class="row flex-row-reverse ">
            <div class="col-12 col-lg-4">
                <div class="cart-sammery shadow-sm p-3 my-3 rounded">
                    <ul>
                        <li>
                            <div class="">
                                <p class="total text-muted">Sub total:</p>
                            </div>
                        </li>
                        <li>
                            <h2>{{$total}} EGP</h2>
                        </li>
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

                                    <div class=" expend-description">

                                        <input class="menu-btn" type="checkbox" id="pass-menu-btn" />
                                        <label class="menu-text" for="pass-menu-btn">
                                </label>
                                        <p class="p-title">{{$course->name}}</p>
                                        <ul class="menu">
                                            <p class="p-description d-none-mine">{{$course->about}}
                                            </p>

                                        </ul>
                                    </div>

                                </div>



                            </div>
                        </div>
                        <div class="col-4 vertical-border align-self-center ">
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
                                            <span>Price</span>
                                        </li>
                                        <li>
                                            <span class="Price">{{$course->price}} EGP</span>
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


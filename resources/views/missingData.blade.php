@extends('layout')

@section('customCSS')
    <link rel="stylesheet" href="{{asset('styles')}}/player.css">
    <link rel="stylesheet" href="{{asset('styles')}}/courses.css">
    <link rel="stylesheet" href="{{asset('styles')}}/profile.css">
    <style>
        .missing ul li{
            list-style-type: decimal;
            list-style-position: inside;
            font-size: 1.75rem;

        }
    </style>
@endsection

@section('content')
    <div class="new-bg" style="z-index: -1;"></div>
    <div class="missing container my-5 py-5" id="course-info">
        <div class="my-5 py-5">
        <h2>Your account is missing a couple of things before you can Checkout.</h2>
        <ul>
            @if(!Auth::user()->verified())
            <li class="py-5 text-muted">
                <h3 class="d-inline-block">You need to verify your email.</h3>
                <div class="input-group">
                    <h5 class="pl-4">An email was sent to you to verify your email,
                        if you don't receive one in the next few minutes,
                        click on the link below to resend the verification email.</h5>
                </div>
                <div class="d-flex justify-content-center align-items-center w-100">
                    <a class="dot-hover dot-hover-red" href="/cart/checkout">Resend</a>
                </div>

            </li>
            @endif
            @if(!Auth::user()->phone || Auth::user()->name)
                    <form id="form" action="{{route('manage')}}" method="POST" enctype="multipart/form-data">
                        @csrf

            @if(!Auth::user()->phone)
                <li class="pt-5 text-muted">
                    <h3 class="mb-5 d-inline-block mb-1">You need to add a phone number to your account.</h3>
                </li>
                            <div class="input-group mb-2 col-lg-6 mx-auto">
                                <h5>Phone number</h5>
                                <input type="text" name="phone" id="phone" class="form-control profile-form-field email-field-props border-light border-radius-sm" placeholder="Your phone number here" />
                            </div>
            @endif
                @if(count($name) < 2)
                    <li class="pt-5 text-muted">
                        <h3 class="mb-5 d-inline-block mb-1">You need to add your full name to your account (eg. John Smith).</h3>
                    </li>
                            <div class="input-group mb-2  col-lg-6 mx-auto">
                                <h5>Name</h5>
                                <input type="text" name="name" id="name" class="form-control profile-form-field email-field-props border-light border-radius-sm" placeholder="John Smith" />
                            </div>
                @endif


                        <button type="submit" id="btnsubmit" class="btn btn-veedros-new btn-veedros-md mx-auto border-0">
                            <h4 class="my-0 mx-5">Save</h4>
                        </button>
                    </form>
            @endif

        </ul>
        </div>
    </div>
@endsection

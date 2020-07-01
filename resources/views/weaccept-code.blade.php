@extends('layout')

@section('customCSS')
    <link href="https://fonts.googleapis.com/css2?family=Tajawal&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/styles/profile.css">
    <link rel="stylesheet" href="/styles/player.css">

    <style>
        .ar{
            text-align:right;
            font-family: 'Tajawal', sans-serif;
            background: #F8F8F8;
            border-radius: 5px;
            padding: 0px 5px;
        }

    </style>
@endsection



@section('content')
    <div class="new-bg"></div>

    <section class="profile my-5 py-5" id="course-info">

        <div class="container">
            <div class="row">

            <div class="card profile-card my-5 px-4 py-5 flex-grow-1">
                <div class="card-body text-center">
                    <h2>Your courses are one step away!</h2>
                    <br>
                    <h3 class="text-muted">
                        To finish enrolling in
                        <b>{{$enrollment->courses[0]->name .
                    ($enrollment->courses()->count() > 1 ? ', and ' .
                    ($enrollment->courses()->count() - 1) . ' other' .
                    ($enrollment->courses()->count() > 2 ? 's' : ''): '')}}
                            (Subtotal: <span style="color: #65D3BF">{{$enrollment->subtotal}} EGP</span>).</b>
                        <br>
                        You need to go to your nearest Aman/Masari <span class="ar">(أمان\مصاري)</span> outlet,
                        and ask for <span class="ar">"مدفوعات متنوعة آكسيبت"</span> and provide the code below:
                    </h3>
                    <br>
                    <h1><span class="ar">{{$amanCode}}</span></h1>
                    <br>
                    @if($isMail)
                        <h4 class="text-muted font-weight-bold text-left">
                            Stay safe,
                            <br>
                            Veedros
                        </h4>
                    @else
                        <h4 class="text-muted font-weight-bold">
                            An email was also sent to you with the code and instructions.
                        </h4>
                    @endif
                </div>
            </div>
            </div>
            </div>

    </section>
@endsection

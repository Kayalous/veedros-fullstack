@extends('layout')

@section('customCSS')
    <link rel="stylesheet" href="{{asset('styles')}}/404.css" />
@endsection
@section('content')
    <section class="error-container my-5 py-5">
        <div class="container my-5 py-5">
            <div class="row">
                <div class="col-lg-6 position-relative error-text text-center d-flex justify-content-center align-items-center flex-column">
                    <h1>500</h1>
                    <h2>Whoops! Something went wrong. We're on it!</h2>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <img class="img-fluid" src="{{asset('images')}}/error.png" alt="Error image">
                </div>
            </div>
            <div class="row mt-5 justify-content-center align-items-center">
                <a href="javascript:history.back()" class="btn btn-outline btn-veedros-new btn-veedros-md my-1 mr-3 "
                   type="button">
                    <span>Go Back</span>

                </a>
                <a href="{{asset("/")}}" class="btn btn-veedros-new btn-veedros-md border-0 my-1 ml-3"
                   type="button">
                    <span>Go Home </span>

                </a>
            </div>
        </div>
    </section>
@endsection

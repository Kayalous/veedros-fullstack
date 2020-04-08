@extends('layout')

@section('customCSS')
    <link rel="stylesheet" href="{{asset('styles')}}/profile.css">
@endsection

@section('content')
    <div class="new-bg"></div>
    <div class="profile">
    <div class="container my-5 py-5">
    <div class="row">
        <div class="col-lg-10 col-12 mx-auto">
            <div class="card profile-card px-4 py-5">
                <div class="text-center"><h2 style="font-size: 35px !important;
                font-weight: 700;
            color: #313c8b;">Reset password</h2></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group col-md-6 mx-auto">
                            <h5 for="email">{{ __('E-Mail Address') }}</h5>

                            <div class="">
                                <input id="email" type="email" class="form-control profile-form-field email-field-props border-light border-radius-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="example@gmail.com">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0 mt-5">
                            <div class="w-100">
                                <button type="submit" class="btn btn-veedros-new btn-veedros-md mx-auto border-0">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
@endsection

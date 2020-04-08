@extends('layout')

@section('customCSS')
    <link rel="stylesheet" href="{{asset('styles')}}/profile.css">
@endsection

@section('content')
    <div class="new-bg"></div>
    <div class="profile">
        <div class="container my-5 py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-12 mx-auto">
            <div class="card profile-card px-4 py-5">
                <div class="text-center"><h2 style="font-size: 35px !important;
                font-weight: 700;
            color: #313c8b;">Reset password</h2></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row d-none">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group col-md-6 mx-auto">
                            <h5 for="password">{{ __('Password') }}</h5>

                            <div>
                                <input id="password" type="password" class="@error('password') is-invalid @enderror form-control profile-form-field email-field-props border-light border-radius-sm" name="password" required autocomplete="new-password" placeholder="● ● ● ● ● ● ● ●">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group col-md-6 mx-auto">
                            <h5 for="password-confirm" class="">{{ __('Confirm Password') }}</h5>

                            <div class="">
                                <input id="password-confirm" type="password" class="form-control profile-form-field email-field-props border-light border-radius-sm" name="password_confirmation" required autocomplete="new-password" placeholder="● ● ● ● ● ● ● ●">
                            </div>
                        </div>

                        <div class="form-group row mb-0 mt-5 w-100">
                                <button type="submit" class="btn btn-veedros-new btn-veedros-md mx-auto border-0">
                                    {{ __('Reset Password') }}
                                </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
@endsection

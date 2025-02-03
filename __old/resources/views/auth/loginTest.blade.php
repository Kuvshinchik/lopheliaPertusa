@extends('layouts.app')

@section('contentLogin')

    <!-- col-md-6 -->
    <div class="col-12 col-md-12 col-lg-6" style="margin-left: auto; margin-right: auto;">
        <div class="section-header">
            <h3>{{ __('Login') }}</h3>
        </div><!-- Section Header Over -->
        <div class="contact-form bottom-shadow">
            <form class="form-horizontal login-page" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <label class="col-12 col-md-4 col-lg-4">{{ __('Email Address') }}</label>
                        <div class="col-12 col-md-8 col-lg-8">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            placeholder="enter your email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus/>
							@error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="password" class="col-12 col-md-4 col-lg-4">{{ __('Password') }}</label>
                        <div class="col-12 col-md-8 col-lg-8">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"  placeholder="*****" name="password" required autocomplete="current-password"/>
							@error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                </div>
                <div class="drop-line bottom-shadow"></div>
                <div class="form-group">
                    <div class="response"></div>
                    <input class="btn btn-default  pull-right" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
					 <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>                   
                </div>
				 <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
            </form>
        </div>
    </div>
    <!-- col-md-6 /- -->



@endsection

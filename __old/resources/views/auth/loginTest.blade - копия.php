@extends('layouts.app')

@section('contentLogin')

    <!-- col-md-6 -->
    <div class="col-12 col-md-12 col-lg-6" style="margin-left: auto; margin-right: auto;">
        <div class="section-header">
            <h3>Авторизация</h3>
        </div><!-- Section Header Over -->
        <div class="contact-form bottom-shadow">
            <form class="form-horizontal login-page" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <label class="col-12 col-md-4 col-lg-4">Email</label>
                        <div class="col-12 col-md-8 col-lg-8">
                            <input type="email" class="form-control" id="txt_email"
                                   placeholder="enter your email" required class="require" name="email"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label for="password" class="col-12 col-md-4 col-lg-4">Пароль</label>
                        <div class="col-12 col-md-8 col-lg-8">
                            <input type="password" class="form-control" id="password" placeholder="*****"
                                   required class="require"/>
                        </div>
                    </div>
                </div>
                <div class="drop-line bottom-shadow"></div>
                <div class="form-group">
                    <div class="response"></div>
                    <input type="submit" value="Login" name="form_type"  class="btn btn-default  pull-right">
                    <a title=">Forgot Password " href="#"  class="submitForm">Забыли пароль?</a>
                </div>
            </form>
        </div>
    </div>
    <!-- col-md-6 /- -->



@endsection

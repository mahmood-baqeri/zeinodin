@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="panel panel-default" >
                    <div style="background-color: darkred;color: white" class="panel-heading"> ورود به سامانه</div>

                    <div class="panel-body" style="color: black">
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-20">
                                    <label>تلفن همراه </label>
                                </div>
                                <div class="col-45">
                                    <input id="mobile" type="mobile" class="form-control" name="mobile" value="{{ old('mobile') }}" required autofocus>
                                    @if ($errors->has('mobile'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('mobile') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-20">
                                    <label>کلمه عبور</label>
                                </div>
                                <div class="col-45">
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-50">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> مرا به خاطر بسپار
                                        </label>
                                    </div>
                                </div>
                            </div><hr>

                            <div class="form-group">
                                <div class="col-md-8  pull-left">
                                    <button type="submit" class="btn btn_login">
                                        ورود       <i class="fas fa-sign-in-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
@endsection

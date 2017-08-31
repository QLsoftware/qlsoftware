@extends('layouts.app')

@section('content')





    <div id="templatemo_contact" class="container_wapper">
        <div class="container-fluid">
            <h1>进入智慧山大</h1>

            <form action="{{ url('/login') }}" method="post" role="form" class="col-md-6">
                <div class="row"></div>
                <div class="col-md-12">
                    <h2>用户登录</h2>
                </div>
                {{ csrf_field() }}
                <div class="col-md-12">
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                        <label for="email">{{--E-Mail Address--}}邮箱</label>
                        <input id="email" type="email" class="form-control" name="email"
                               value="{{ old('email') }}">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password">{{--Password--}}密码</label>
                        <input id="password" type="password" class="form-control" name="password">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <div class="checkbox">
                            <input type="checkbox" name="remember">
                            <p>记住我</p>
                        </div>
                    </div>
                </div>

                <div class="col-xs-6 col-sm-3 col-md-offset-6">
                    <div class="form-group">
                        <button type="submit">
                            <i class="fa fa-btn fa-sign-in"></i> {{--Login--}}登陆
                        </button>
                    </div>
                    <div class="col-xs-6 col-sm-3">
                        <button>
                            <a class=""
                               href="{{ url('/password/reset') }}">{{--Forgot Your Password?--}}忘记了密码</a></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

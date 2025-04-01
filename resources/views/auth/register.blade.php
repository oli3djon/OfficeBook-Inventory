@extends('layouts.auth')

@section('content')

    <div class="form-signin" style="background: #cccccc">
        <h2 class="h3 mb-3 font-weight-normal">Регистрация</h2>

        <form method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}
            
            <div class="form-group has-feedback">
                <input type="name" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Имя" required autofocus>
                <span class="glyphicon form-control-feedback"></span>
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong></span>
                @endif
            </div>
            
            <div class="form-group has-feedback">
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="E-mail" required autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong></span>
                @endif
            </div>
            
            <div class="form-group has-feedback">
                <input type="password" class="form-control"  id="password" name="password" placeholder="Пароль" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong></span>
                @endif
            </div>
            
            <div class="form-group has-feedback">
                <input type="password" class="form-control"  id="password-confirm" name="password_confirmation" placeholder="Повторить пароль" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Зарегистрироваться</button>
        </form>

        </div>

@endsection
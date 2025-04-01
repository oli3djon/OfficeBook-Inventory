@extends('layouts.auth')

@section('content')

    <div class="form-signin" style="background: #cccccc">
        <h2 class="h3 mb-3 font-weight-normal">Сменить пароль</h2>

        <form method="POST" role="form" action="{{ route('password.request') }}">
        {{ csrf_field() }}
        <input type="hidden" name="token" value="{{ $token }}">
        
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        
            <div class="form-group has-feedback">
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control"  id="password" name="password" placeholder="Пароль" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
            </div>
             <div class="form-group has-feedback">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Повтор пароля" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Сменить пароль</button>

        </div>
        </form>
    </div>

@endsection
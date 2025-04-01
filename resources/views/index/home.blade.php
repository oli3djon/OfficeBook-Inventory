@extends('layouts.auth')

@section('content')

    <div class="login-logo">
        <a href="/"><b>Admin</b>Office</a>
    </div>

    <div class="login-box-body">
        <p class="login-box-msg">Авторизация</p>

        <form method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <div class="form-group has-feedback">
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control"  id="password" name="password" placeholder="Пароль" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> Заомнить меня
                        </label>
                    </div>
                </div>

                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Вход</button>
                </div>
            </div>
        </form>
        <a href="/password/reset">Востановить пароль</a><br>
        <a href="/register" class="text-center">Зарегестрировать</a>
        </div>

@endsection
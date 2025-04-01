@extends('layouts.auth')

@section('content')

    <form method="POST" action="{{ route('login') }}" class="form-signin" style="background: #cccccc">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <h1 class="h3 mb-3 font-weight-normal">Вход</h1>
            <div class="form-group has-feedback">
                <input type="email" name="email" value="{{ old('email') }}" id="inputEmail" class="form-control" placeholder="E-mail" required autofocus>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Пароль" required>
            </div>

            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me" checked> Запомнить меня
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Вход</button>
            <div style="margin-top: 10px;">
                <a href="/password/reset">Востановить пароль</a><br>
                <a href="/register" class="text-center">Зарегистрироваться</a>
            </div>
    </form>

@endsection
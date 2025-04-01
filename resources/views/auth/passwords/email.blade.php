@extends('layouts.auth')

@section('content')

    <div class="form-signin" style="background: #cccccc">
        <h2>Сброс пароля</h2>
        
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" role="form" action="{{ route('password.email') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <div class="form-group has-feedback">
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Отправить ссылку для сброса пароля</button>

        </form>
        <div style="margin-top: 10px">
            <a href="/register" class="text-center">Зарегистрироваться</a> | <a href="{{ route('login') }}" class="text-center">Вход</a>
        </div>
    </div>
        
@endsection
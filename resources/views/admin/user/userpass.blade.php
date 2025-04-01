@extends('layouts.admin')

@section('content')

<section class="content">
    <div class="box box-default form-horizontal">
        <div class="box-header with-border" >
            <h3 class="box-title">Сменить пароль</h3>
        </div>
        
        {!! Form::open(['url' => 'admin/userpass/'], ['method' => 'put']) !!}
        
        @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" name="id" value="<?=$id?>">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Текущий пароль</label>
                        <div class="col-sm-8">
                            <input name="current" type="password" class="form-control" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Новый пароль</label>
                        <div class="col-sm-8">
                            <input name="password" type="password" class="form-control" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Повтор нового пароля</label>
                        <div class="col-sm-8">
                            <input name="password_confirmation" type="password" class="form-control" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
            </div>
            <div class="box-footer">
                <?=$sevedapp?>
                <button type="submit" class="btn btn-info pull-right">Сохранить</button>
            </div>
        </div>
              
        {!! Form::close() !!}
            
    </div>
</section>

@endsection
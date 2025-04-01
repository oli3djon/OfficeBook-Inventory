@extends('layouts.admin')

@section('content')

<section class="content">
    <div class="box box-default form-horizontal">
        <div class="box-header with-border" >
            <i class="fa fa-user"></i>
            <h3 class="box-title">Данные пользователя</h3>
        </div>
        
        {!! Form::open(['url' => 'admin/user/'.$user->id], ['method' => 'put']) !!}
        
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
                    <input type="hidden" name="id" value="<?=$user->id?>">
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Имя</label>
                        <div class="col-sm-10">
                            <input name="name" type="text" class="form-control" value="<?=$user->name?>" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">E-mail</label>
                        <div class="col-sm-10">
                            <input name="email" type="text" class="form-control" value="<?=$user->email?>" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-5">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="apanel" <?=$user->apanel?>> Доступ в админ-панель
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="history" <?=$user->history?>> Просмотр истори
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Сотрудник</label>
                        <div class="col-sm-10">
                            {!!Form::select('peoples', $peoples, $user->peoples, ['class' => 'form-control select2', 'style' => 'width: 100%;'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <a href="/admin/userpassall/<?=$id?>">Сменить пароль</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-offset-2 col-sm-10">Роли</label>
                        
                        @foreach ($roles as $role)
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="role[<?=$role->id?>]" <?=$checkboxrole[$role->id]?>> <?=$role->name?>
                                </label>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>  
                </div>             
            </div>
            <div class="box-footer">
                <?=$sevedapp?>
                <button type="submit" class="btn btn-info pull-right">Сохранить</button>
            </div>
        </div>
    </div>
    
    {!! Form::close() !!}
    
</section>

@endsection
@extends('layouts.admin')

@section('content')

<section class="content">
    <div class="row">
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="/alte/dist/img/user2-160x160.jpg" >
                    <h3 class="profile-username text-center"><?=$user->name?></h3>
                    <p class="text-muted text-center">Сотрудник: <strong><?=$peoples?></strong></p>
                    <hr>
                    <strong><i class="fa fa-th"></i> Роли:</strong>
                    <div class="form-group">
                        <ul>
                            
                        @foreach ($userroles as $userrole)
                        <li><?=$userrole?></li>
                        @endforeach
                        
                        </ul>
                    </div>
                    <a href="/admin/userpass" class="btn btn-info btn-block"><b>Сменить пароль</b></a> 
                </div>
            </div>
        </div>
        <div class="col-md-9">
           <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-user"></i>
                    <h3 class="box-title">Информация о пользователе</h3>
                </div>

                @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <?=$sevedapp?>
                <div class="box-body">
             
                    {!! Form::open(['url' => 'admin/userprofile/'], ['method' => 'put']) !!}
                    {{ Form::token() }}
                    
                    <div class="row">
                        <input type="hidden" name="id" value="<?=$user->id?>">
                        <div class="form-group col-md-7">
                            <label>Имя</label>
                            <input name="name" type="text" class="form-control" value="<?=$user->name?>" placeholder=".col-md-7" >
                        </div>
                        <div class="form-group col-md-7">
                            <label>E-mail</label>
                            <input name="email" type="text" class="form-control" value="<?=$user->email?>" placeholder=".col-md-7" >
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right">Сохранить</button>
                    </div>
                    
                    {!! Form::close() !!}
                    
                </div>
            </div>
        </div>
    </div>      
</section>

@endsection
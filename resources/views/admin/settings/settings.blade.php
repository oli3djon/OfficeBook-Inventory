@extends('layouts.admin')

@section('content')

<section class="content">
    <div class="box box-default form-horizontal">
        <div class="box-header with-border" >
            <i class="fa fa-home"></i>
            <h3 class="box-title">Организация</h3>
        </div>
        
        {!! Form::open(['url' => 'admin/settings/'], ['method' => 'put']) !!}
        
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
                <div class="col-md-12">
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Название организации</label>
                        <div class="col-sm-4">
                            <input name="name" class="form-control" id="site-name" value="<?=$settings['2']?>" placeholder="Введите название" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Описание</label>
                        <div class="col-sm-4">
                            <input name="text" class="form-control" id="site-title" value="<?=$settings['3']?>" placeholder="Введите описание">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">E-mail</label>
                        <div class="col-sm-4">
                            <input name="email" type="email" class="form-control" id="site-title" value="<?=$settings['4']?>" placeholder="Введите e-mail">
                        </div>
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
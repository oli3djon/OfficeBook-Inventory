@extends('layouts.admin')

@section('content')
<section class="content">
    <div class="box box-default form-horizontal">
        <div class="box-header with-border" >
            <i class="fa fa-child"></i>
            <h3 class="box-title">
                @if (Gate::allows('people_delele'))
                <button type="button" data-toggle="modal" data-target="#modal-default" title="Удалить"><i class="fa fa-fw fa-times"></i></button>
                @endif
                <a href="/admin/people/<?=$people->peoples_id?>"><?=$people->surname?> <?=$people->name?> </a>
            </h3>
        </div>
        
        {!! Form::open(['url' => 'admin/peopleedit/'.$people->peoples_id], ['method' => 'put']) !!}
        
        @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
        @if($mesalt != '')
            <div class="alert alert-danger">
                <ul>
                    <li>{{ $mesalt }}</li>
                </ul>
            </div>
        @endif
        
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" name="id" value="<?=$people->peoples_id?>">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Фамилия*</label>
                        <div class="col-sm-9">
                            <input  name="surname" type="text" class="form-control" value="<?=$people->surname?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Имя*</label>
                        <div class="col-sm-9">
                            <input  name="name" type="text" class="form-control" value="<?=$people->name?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Статус</label>
                        <div class="col-sm-9">
                            {!!Form::select('status', $status, $people->status, ['class' => 'form-control select2', 'style' => 'width: 100%;'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Должность</label>
                        <div class="col-sm-9">
                            {!!Form::select('position', $positions, $people->position, ['class' => 'form-control select2', 'style' => 'width: 100%;'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Адрес</label>
                        <div class="col-sm-9">
                            {!!Form::select('addresses', $addresses, $people->addresses, ['class' => 'form-control select2', 'style' => 'width: 100%;'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Раб. телефон</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <input id="telwork" name="telwork"  type="text" class="form-control" data-inputmask='' data-mask value="<?=$people->telwork?>" placeholder=''>
                            </div>
                        </div>    
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Личный тел.</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                 <input id="telpersonal" name="telpersonal" type="text" class="form-control" data-inputmask='' data-mask value="<?=$people->telpersonal?>" placeholder=''>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">E-mail рабочий</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                 {!!Form::select('mailwork', $mailwork, $people->mailwork, ['class' => 'form-control select2', 'style' => 'width: 100%;'])!!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">E-mail личный</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                 <input name="mailpersonal"  type="email" class="form-control" value="<?=$people->mailpersonal?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">День рождения</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-birthday-cake"></i>
                                </div>
                                <input name="birthday"  type="text" class="form-control" value="<?=$people->birthday?>" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12">Дополнительная информация</label>
                        <div class="col-sm-12">
                            <textarea name="text" id="editor1" name="editor1" rows="10" cols="80"><?=$people->text?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            *Поля обязательны для заполнения
                        </div>
                    </div>
                </div>  
            </div>
        </div>
        <div class="modal modal-danger fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Удалить сотрудника: <?=$people->name?> <?=$people->surname?></h4>
                    </div>
                    <div class="modal-body">
                        <p>Вы уверены?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Отменить</button>
                        <a href="/admin/peopledel/<?=$people->peoples_id?>"  type="button" class="btn btn-primary">Удалить</a>
                    </div>
                </div>
            </div>
        </div>
        <?=$sevedapp?>
        <div class="box-footer">
            <button type="submit" class="btn btn-info pull-right">Сохранить</button>
        </div> 
    </div>
    
     {!! Form::close() !!}
    
</section>

@endsection
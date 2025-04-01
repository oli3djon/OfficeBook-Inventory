@extends('layouts.admin')

@section('content')

<section class="content">
    <div class="box box-default form-horizontal">
        <div class="box-header with-border">
            <i class="fa fa-laptop"></i>
            @if (Gate::allows('root'))
            <button type="button" data-toggle="modal" data-target="#modal-default" title="Удалить"><i class="fa fa-fw fa-times"></i></button>
            @endif
            <?=$booton_writeoff?>
            <?=$booton_delist?>
            <a href="/admin/history/3/<?=$inventory->id?>"> <button type="button"  title="История"><i class="fa fa-fw fa-history"></i></button></a>
            <h3 class="box-title"> <?=$inventory->name?></h3>
        </div>
        
        {!! Form::open(['url' => 'admin/inventoryedit/'.$inventory->id], ['method' => 'put']) !!}
        
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
                    <input type="hidden" name="id" value="<?=$inventory->id?>">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Инвентарный № </label>
                        <div class="col-sm-3">
                            <input name="id" type="text" class="form-control" value="<?=$inventory->id?>" disabled> 
                        </div>
                        <div class="col-sm-6">
                            <?=$state?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Имя*</label>
                        <div class="col-sm-9">
                            <input name="name" type="text" class="form-control" value="<?=$inventory->name?>" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Группа</label>
                        <div class="col-sm-9">
                            {!!Form::select('groups', $groups, $inventory->groups, ['class' => 'form-control select2', 'style' => 'width: 100%;'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Место нахождения</label>
                        <div class="col-sm-9">
                            {!!Form::select('points', $points, $inventory->points, ['class' => 'form-control select2', 'style' => 'width: 100%;'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Ответственный сотрудник*</label>
                        <div class="col-sm-9">
                            {!!Form::select('peoples', $peoples, $inventory->peoples, ['class' => 'form-control select2', 'style' => 'width: 100%;'])!!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-12">Дополнительная информация</label>
                        <div class="col-sm-12">
                            <textarea name="text" id="editor1" name="editor1" rows="5" cols="80"><?=$inventory->text?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            *Поля обязательны для заполнения
                        </div>
                    </div>
                    <div class="modal modal-danger fade" id="modal-default">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Удалить инвентарную еденицу: <?=$inventory->name?></h4>
                                </div>
                                <div class="modal-body">
                                    <p>Вы уверены?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Отменить</button>
                                    <a href="/admin/inventdel/<?=$inventory->id?>"  type="button" class="btn btn-primary">Удалить</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-info pull-right">Сохранить</button>
        </div> 
    </div>
    
     {!! Form::close() !!}
    
</section>

@endsection
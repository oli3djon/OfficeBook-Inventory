@extends('layouts.admin')

@section('content')

<section class="content">
    <div class="box box-default form-horizontal">
        <div class="box-header with-border" >
            <h3 class="box-title">Данные товара</h3>
        </div>
        
        {!! Form::open(['url' => 'admin/inventoryadd/'], ['method' => 'put']) !!}
        
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
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Инвентарный номер*</label>
                        <div class="col-sm-9">
                            <input name="id" type="text" class="form-control" value="<?=$inventory['id']?>" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Имя*</label>
                        <div class="col-sm-9">
                            <input name="name" type="text" class="form-control" value="{{ old('name') }}" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <div class="checkbox">
                                <label>
                                    <input name="state" type="checkbox" > Используется
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Группа</label>
                        <div class="col-sm-9">
                            {!!Form::select('groups', $groups, $inventory['groups'], ['class' => 'form-control select2', 'style' => 'width: 100%;'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Место нахождения</label>
                        <div class="col-sm-9">
                            {!!Form::select('points', $points, $inventory['points'], ['class' => 'form-control select2', 'style' => 'width: 100%;'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Ответственный сотрудник*</label>
                        <div class="col-sm-9">
                           {!!Form::select('peoples', $peoples, $inventory['people'], ['class' => 'form-control select2', 'style' => 'width: 100%;'])!!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <textarea name="text" id="editor1" name="editor1" rows="5" cols="80"><?=$inventory['text']?></textarea>
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
        <div class="box-footer">
            <button type="submit" class="btn btn-info pull-right">Создать</button>
        </div> 
    </div>
    
     {!! Form::close() !!}
    
</section>

@endsection
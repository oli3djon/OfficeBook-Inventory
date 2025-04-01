@extends('layouts.admin')

@section('content')

<section class="content">
    <div class="box box-default form-horizontal">
        <div class="box-header with-border" >
            <i class="fa fa-child"></i>
            <h3 class="box-title"><?=$mesege?></h3>
        </div>
        
        {!! Form::open(['url' => 'admin/peopleadd/'], ['method' => 'put']) !!}
        
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
                        <label class="col-sm-3 control-label">Фамилия*</label>
                        <div class="col-sm-9">
                            <input  name="surname" type="text" class="form-control" value="{{ old('surname') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Имя*</label>
                        <div class="col-sm-9">
                            <input  name="name" type="text" class="form-control" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Статус</label>
                        <div class="col-sm-9">
                            {!!Form::select('status', $status, '1', ['class' => 'form-control select2', 'style' => 'width: 100%;'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Должность</label>
                        <div class="col-sm-9">
                            {!!Form::select('position', $positions, '1', ['class' => 'form-control select2', 'style' => 'width: 100%;'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Адрес</label>
                        <div class="col-sm-9">
                            {!!Form::select('addresses', $addresses, '1', ['class' => 'form-control select2', 'style' => 'width: 100%;'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Раб. телефон</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <input id="telwork" name="telwork"  type="text" value="{{ old('telwork') }}" class="form-control" data-inputmask='' data-mask placeholder='' >
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
                                 <input id="telpersonal" name="telpersonal" type="text" value="{{ old('telpersonal') }}" class="form-control" data-inputmask='' data-mask placeholder=''>
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
                                 {!!Form::select('mailwork', $mailworks, $mailwork, ['class' => 'form-control select2', 'style' => 'width: 100%;'])!!}
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
                                <input name="mailpersonal"  type="email" value="{{ old('mailpersonal') }}" class="form-control" >
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
                                <input name="birthday"  type="text" value="{{ old('birthday') }}" class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Дополнительная информация</label>
                        <div class="col-sm-12">
                            <textarea name="text" id="editor1" name="editor1" rows="10" cols="80"></textarea>
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
            <button type="submit" class="btn btn-info pull-right">Сохранить</button>
        </div> 
    </div>
    
     {!! Form::close() !!}
    
</section>

@endsection
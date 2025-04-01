@extends('layouts.admin')

@section('content')

<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Импорт с Excel</h3>
        </div>
           
        @if(count($errors) > 0)
		<div class="alert alert-danger">
			<p><?=$errors_mes?></p>
            <ul>
				@foreach($errors->all() as $error)
					<li>{{ $error}}</li>
				@endforeach
			</ul>
		</div>
	   @endif    
        
        
        {!! Form::open(array('url' => '/admin/import/','files'=>'true')) !!}
        <div class="box-body">
            <div class="form-group">
                {!! Form::file('file') !!}
                <p class="help-block">Выберите файл Microsoft Excel (.xlsx) размером не более 50 Мбайт.</p>
            </div>
        </div>
        <div class="box-footer">
            <button type="button" data-toggle="modal" data-target="#modal-default" class="btn btn-primary">Импортировать</button>
        </div>
          
        <div class="modal modal-warning fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Импортировать данные с файла?</h4>
                    </div>
                    <div class="modal-body">
                        <ul>
                            <li>При загрузке данных сотрудников, если в базе уже есть такой сотрудник, то его данные обновятся, если нет, то добавится новый.</li>
                            <li>При загрузке данных инвентаризации, если в базе уже есть такой инвентарный номер, то его данные обновятся, если нет, то добавится новый.</li>
                            <li>При загрузке данных инвентаризации, если в базе нет такого ответственного, то он будет создан.</li>
                            <li>История правок с файла не импортируется, в истории появляется только одно новое событие сознание или правка инвентарной единицы.</li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Отменить</button>
                        <button type="submit" class="btn btn-outline">Выполнить импорт</button>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>   
    
    
    @if(count($peoples) > 0)
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title"><?=$header['people']?></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th width="10">№</th>
                            <th>Статус</th>
                            <th>Имя</th>
                            <th>Должность</th>
                            <th>Адресс</th>
                            <th>E-mail раб.</th>
                            <th>E-mail лич.</th>
                            <th>Тел. раб.</th>
                            <th>Тел. лич.</th>
                            <th>День рождения</th>
                            <th>Доп. инф.</th>
                        </tr>
                        </thead>
                        <tbody>
                        
                        <?php $i = 0;?>
                        @foreach ($peoples as $id => $people)
                            <tr>
                                <td><?=$i += 1?></td>
                                <td><?=$peoples[$id]['status']?></td>
                                <td><?=$peoples[$id]['name']?></td>
                                <td><?=$peoples[$id]['position']?></td>
                                <td><?=$peoples[$id]['addresses']?></td>
                                <td><?=$peoples[$id]['mailwork']?></td>
                                <td><?=$peoples[$id]['mailpersonal']?></td>
                                <td><?=$peoples[$id]['telwork']?></td>
                                <td><?=$peoples[$id]['telpersonal']?></td>
                                <td><?=$peoples[$id]['birthday']?></td>
                                <td><?=$peoples[$id]['text']?></td>
                            </tr>
                        @endforeach
            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
        
    @if(count($inventorys) > 0)
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title"><?=$header['invent']?></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th width="10">№</th>
                            <th>Инв. №</th>
                            <th>Группа</th>
                            <th>Найменование</th>
                            <th>Местонахождения</th>
                            <th>Ответственный</th>
                            <th>Доп. инф.</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0;?>
                        @foreach ($inventorys as $id => $inventory)
                            <tr>
                                <td><?=$i += 1?></td>
                                 <td><?=$id?> <?=$inventorys[$id]['invent_add']?></td>
                                <td><?=$inventorys[$id]['group']?></td>
                                <td><?=$inventorys[$id]['name']?></td>
                                <td><?=$inventorys[$id]['point']?></td>
                                <td><?=$inventorys[$id]['people']?></td>
                                <td><?=$inventorys[$id]['text']?></td>
                            </tr>
                        @endforeach
            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
    
</section>
@endsection
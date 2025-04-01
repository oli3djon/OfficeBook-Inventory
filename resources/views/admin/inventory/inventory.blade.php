@extends('layouts.admin')

@section('content')

<section class="content">
    <div class="box box-default form-horizontal">
        <div class="box-header with-border" >
            <i class="fa fa-laptop"></i>
            @if (Gate::allows('root'))
            <button type="button" data-toggle="modal" data-target="#modal-default" title="Удалить"><i class="fa fa-fw fa-times"></i></button>
            @endif
            @if (Gate::allows('inventory_edit'))
                <a href="/admin/inventoryedit/<?=$inventory->id?>"> <button type="button"  title="Редактировать"><i class="fa fa-fw fa-edit"></i></button></a>
            @endif
            @if (Gate::allows('history'))
            <a href="/admin/history/3/<?=$inventory->id?>"> <button type="button"  title="История"><i class="fa fa-fw fa-history"></i></button></a>
            @endif
            <h3 class="box-title"> <?=$inventory->name?></h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
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

                    <dl class="dl-horizontal">
                        <dt>Инвентарный номер:</dt>
                        <dd><?=$inventory->id?> <?=$state?></dd>
                    </dl> 
                    <dl class="dl-horizontal">
                        <dt>Название:</dt>
                        <dd><?=$inventory->name?></dd>
                    </dl>                   
                    
                    @if (Gate::allows('group'))
                    <dl class="dl-horizontal">
                        <dt>Группа:</dt>
                        <dd><a href="/admin/inventorys/<?=$inventory->groups_id?>"><?=$inventory->groups_name?></a></dd>
                    </dl>
                    @endif
                    @if (Gate::allows('point'))
                    <dl class="dl-horizontal">
                        <dt>Место нахождения:</dt>
                        <dd><a href="/admin/pointin/<?=$inventory->points_id?>"><?=$inventory->points_name?></a></dd>
                    </dl>
                    @endif
                    @if (Gate::allows('people'))
                    <dl class="dl-horizontal">
                        <dt>Ответственный:</dt>
                        <dd><a href="/admin/people/<?=$inventory->peoples_id?>"><?=$inventory->peoples_surname?> <?=$inventory->peoples_name?></a></dd>
                    </dl>
                    @endif
                </div>
                <div class="col-md-6">
                    <dl class="dl-horizontal">
                        <dt>Доп. информация:</dt>
                        <dd><?=$inventory->text?></dd>
                    </dl> 
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
</section>    

@endsection
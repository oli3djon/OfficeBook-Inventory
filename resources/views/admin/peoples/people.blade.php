@extends('layouts.admin')

@section('content')

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-default">
                <div class="box box-solid">
                    <div class="box-header with-border" >
                        <i class="fa fa-child"></i>
                        <h3 class="box-title">
                            @if (Gate::allows('people_delete'))
                            <button type="button" data-toggle="modal" data-target="#modal-default" title="Удалить"><i class="fa fa-fw fa-times"></i></button>
                            @endif
                            @if (Gate::allows('people_edit'))
                            <a href="/admin/peopleedit/<?=$people->peoples_id?>"> <button type="button"  title="Редактировать"><i class="fa fa-fw fa-edit"></i></button></a>
                            @endif
                            <?=$people->surname?> <?=$people->name?>
                        </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                        </div>
                    </div>
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
                                <label>Статус: </label> <cite><a href="/admin/peoples/<?=$people->status?>"><?=$status[$people->status]?></a></cite><br />
                                @if (Gate::allows('position'))
                                <label>Должность: </label> <cite><a href="/admin/position/<?=$people->position?>"><?=$positions[$people->position]?></a></cite><br />
                                @endif
                                @if (Gate::allows('addresses'))
                                <label>Адрес: </label> <cite ><a href="/admin/addressin/<?=$people->addresses?>"><?=$people->addresses_name?></a></cite><br />
                                @endif
                                <label>Дополнительная информация:</label> <cite title="Source Title"><?=$people->text?></cite>
                            </div>
                            <div class="col-md-6">
                                @if (Gate::allows('mailwork'))
                                <?=$email?>
                                @endif
                                <?=$tel?>
                                <?=$birthday?>
                                <br>
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
                    </div>
                </div>
            </div>
            
            @if (Gate::allows('inventory'))
            <?=$sevedapp?>
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Ответственный за имущество: <?=$people->surname?> <?=$people->name?></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    {!! Form::open(['url' => 'admin/people/'.$people->peoples_id], ['method' => 'put']) !!}
                    {{ Form::token() }}
                    <table id="tabledata" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            @if (Gate::allows('inventory_edit'))
                            <th width="10"><input type="checkbox"  id="all" value="1"  class="checkbox"></th>
                            @endif
                            <th width="25">Кол.</th>
                            <th width="25">Инв. №</th>
                            <th>Название</th>
                            @if (Gate::allows('group'))
                            <th>Группа</th>
                            @endif
                            @if (Gate::allows('point'))
                            <th>Местонахождение</th>
                            @endif
                            <th>Доп. информация</th>
                            @if (Gate::allows('inventory_edit'))
                            <th width="25"></th>
                            @endif
                            @if (Gate::allows('history'))
                            <th width="25"></th>
                            @endif
                            @if (Gate::allows('inventory_delete'))
                            <th width="25"></th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0;?>
                        @foreach ($inventorys as $inventory)
                            <tr>
                                @if (Gate::allows('inventory_edit'))
                                <td><input type="checkbox" name="move[<?=$inventory->id?>]" class="checkbox"></td>
                                @endif
                                <td><?=$i += 1?></td>
                                <td><?=$inventory->id?></td>
                                <td>
                                    <a href="/admin/inventory/<?=$inventory->inventorys_id?>"><?=$inventory->inventorys_name?></a>
                                    @if (Gate::allows('inventory_edit'))
                                    <a href="/admin/inventoryedit/<?=$inventory->id?>" title="Редактировать"> <i class="fa fa-fw fa-edit"></i></a>
                                    @endif
                                </td>
                                @if (Gate::allows('group'))
                                <td><a href="/admin/inventorys/<?=$inventory->groups_id?>"><?=$inventory->groups_name?></a></td>
                                @endif
                                @if (Gate::allows('point'))
                                <td><a href="/admin/pointin/<?=$inventory->points_id?>"><?=$inventory->points_name?></a></td>
                                @endif
                                <td><?=$texts[$inventory->id]?></td>
                                @if (Gate::allows('inventory_edit'))
                                <td><?=$states[$inventory->id]?></td>
                                @endif
                                @if (Gate::allows('history'))
                                <td>
                                    <a href="/admin/history/3/<?=$inventory->id?>"> <button type="button" class="btn btn-xs" title="История"><i class="fa fa-fw fa-history"></i></button></a>
                                </td>
                                @endif
                                @if (Gate::allows('inventory_delete'))
                                <td>
                                    <div class="col-md-3 col-sm-4" data-toggle="modal" data-target="#modal-default_<?=$inventory->id?>" title="Удалить"  style="cursor: pointer;" > <i class="fa fa-fw fa-times"></i></div>
                                </td>
                                @endif
                            </tr>
                            <div class="modal modal-danger fade" id="modal-default_<?=$inventory->id?>">
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
                        @endforeach
                        </tbody>
                    </table>
                    @if (Gate::allows('inventory_edit'))
                    <script type="text/javascript">
                        $('#all').click(function(){
                            if ($(this).is(':checked')){
                                $('#tabledata input:checkbox').prop('checked', true);
                            } else {
                                $('#tabledata input:checkbox').prop('checked', false);
                            }
                        });
                    </script>
                    @endif
                </div>
                
                @if (Gate::allows('inventory_edit'))
                <div class="form-group margin-bottom-none">
                    <div class="col-sm-9">
                        {!!Form::select('peoples', $peoples, $people->peoples_id, ['class' => 'form-control select2', 'style' => 'width: 100%;'])!!}
                    </div>
                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-info pull-right">Передать выбраное</button>
                    </div>
                </div>
                {!! Form::close() !!}
                @endif
                
            </div>
            @endif
        </div>
    </div>
</section>
    
@endsection
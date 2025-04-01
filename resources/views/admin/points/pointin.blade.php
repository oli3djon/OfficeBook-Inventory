@extends('layouts.admin')

@section('content')

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <?=$sevedapp?>
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?=$mesege?></h3>
                    @if (Gate::allows('inventoryedit'))
                    <a href="/admin/inventoryadd"><button class="btn btn-info pull-right">Создать</button></a>
                    @endif
                </div>
                <div class="box-body">
                
                    {!! Form::open(['url' => 'admin/pointin/'.$id], ['method' => 'put']) !!}
                    {{ Form::token() }}
                    
                    <table id="tabledata" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            @if (Gate::allows('inventory_edit'))
                            <th width="10"><input type="checkbox"  id="all" value="1"  class="checkbox"></th>
                            @endif
                            <th width="25">№</th>
                            <th>Инв. №</th>
                            <th>Название</th>
                            @if (Gate::allows('group'))
                            <th>Группа</th>
                            @endif
                            @if (Gate::allows('people'))
                            <th>Ответственный сотрудник</th>
                            @endif
                            <th>Доп. информация</th>
                            @if (Gate::allows('inventory_edit'))
                            <th width="25"></th>
                            @endif
                            @if (Gate::allows('history'))
                            <th></th>
                            @endif
                            @if (Gate::allows('root'))
                            <th></th>
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
                                <td>
                                    <?=$inventory->id?>
                                </td>
                                <td>
                                    <a href="/admin/inventory/<?=$inventory->id?>" title="Посмотеть подробнее: <?=$inventory->name?>"><?=$inventory->name?></a>
                                    @if (Gate::allows('inventory_edit'))
                                        <a href="/admin/inventoryedit/<?=$inventory->id?>" title="Редактировать"> <i class="fa fa-fw fa-edit"></i></a>
                                    @endif
                                </td>
                                @if (Gate::allows('group'))
                                <td><a href="/admin/inventorys/<?=$inventory->groups_id?>"><?=$inventory->groups_name?></td>
                                @endif
                                @if (Gate::allows('people'))
                                <td><a href="/admin/people/<?=$inventory->peoples?>"><?=$inventory->peoples_surname?> <?=$inventory->peoples_name?></a></td>
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
                                @if (Gate::allows('root'))
                                <td>
                                    <div data-toggle="modal" data-target="#modal-default_<?=$inventory->id?>" title="Удалить"  style="cursor: pointer;" > <i class="fa fa-fw fa-times"></i></div>
                                </td>
                                @endif
                            </tr>

                            @if (Gate::allows('root'))
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
                            @endif
                            
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
                        {!!Form::select('points', $points, $id, ['class' => 'form-control select2', 'style' => 'width: 100%;'])!!}
                    </div>
                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-info pull-right">Переместить выбраное</button>
                    </div>
                </div>
                @endif
            {!! Form::close() !!}
            </div>
        </div>
</section>

@endsection
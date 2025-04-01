@extends('layouts.admin')

@section('content')

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?=$mesege?></h3>
                    @if (Gate::allows('inventory_edit'))
                    <a href="/admin/inventoryadd/<?=$group?>"><button class="btn btn-info pull-right">Создать</button></a>
                    @endif
                </div>
                <div class="box-body">
                    <table id="tabledata" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th width="10">№</th>
                            <th width="50">Инв. №</th>
                            <th>Название</th>
                            @if (Gate::allows('group'))
                            <th>Группа</th>
                            @endif
                            @if (Gate::allows('people'))
                            <th>Ответственный сотрудник</th>
                            @endif
                            @if (Gate::allows('point'))
                            <th>Местонахождение</th>
                            @endif
                            <th>Доп. информация</th>
                            @if (Gate::allows('inventory_edit'))
                            <th width="25"></th>
                            @endif
                            @if (Gate::allows('history'))
                            <th></th>
                            @endif
                            @if (Gate::allows('inventory_delete'))
                            <th></th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0;?>
                        @foreach ($inventorys as $inventory)
                            <tr>
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
                                <td><a href="/admin/inventorys/<?=$inventory->groups_id?>"><?=$inventory->groups_name?></a></td>
                                @endif
                                @if (Gate::allows('people'))
                                <td><a href="/admin/people/<?=$inventory->peoples?>"><?=$inventory->peoples_surname?> <?=$inventory->peoples_name?></a></td>
                                @endif
                                @if (Gate::allows('point'))
                                <td><a href="/admin/pointin/<?=$inventory->points_id?>"><?=$inventory->points_name?></a></td>
                                @endif
                                <td><?=$texts[$inventory->id]?></td>
                                @if (Gate::allows('inventory_edit'))
                                    <td ><?=$states[$inventory->id]?></td>
                                @endif
                                @if (Gate::allows('history'))
                                <td>
                                    <a href="/admin/history/3/<?=$inventory->id?>"> <button type="button" class="btn btn-xs" title="История"><i class="fa fa-fw fa-history"></i></button></a>
                                </td>
                                @endif
                                @if (Gate::allows('inventory_delete'))
                                <td>
                                    <div data-toggle="modal" data-target="#modal-default_<?=$inventory->id?>" title="Удалить"  style="cursor: pointer;" > <i class="fa fa-fw fa-times"></i></div>
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
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
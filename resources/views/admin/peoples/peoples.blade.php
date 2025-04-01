@extends('layouts.admin')

@section('content')

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?=$mesege?></h3>
                    @if (Gate::allows('people_edit'))
                    <a href="/admin/peopleadd"><button class="btn btn-info pull-right">Создать сотрудника</button></a>
                    @endif
                </div>
                
                @if($mesalt != '')
                <div class="alert alert-danger">
                    <ul>
                        <li>{{ $mesalt }}</li>
                    </ul>
                </div>
                @endif
                
                <div class="box-body">
                    <table id="tabledata" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>№</th>
                            <th width="25"></th>
                            <th>Полное имя</th>
                            @if (Gate::allows('position'))
                            <th>Должность</th>
                            @endif
                            @if (Gate::allows('addresses'))
                            <th>Адресс</th>
                            @endif
                            <th>Телефон лич.</th>
                            <th>Телефон раб.</th>
                            @if (Gate::allows('mailwork'))
                            <th>E-Mail рабочий</th>
                            @endif
                            @if (Gate::allows('people_delele'))
                            <th width="25"></th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                            
                            <?php $i = 0;?>
                            @foreach ($peoples as $people)

                            <tr>
                                <td><?=$i += 1?></td>
                                <td>
                                    <?=$peoples_status[$people->peoples_id]?>
                                </td>
                                <td>
                                    <a href="/admin/people/<?=$people->peoples_id?>"><?=$people->surname?> <?=$people->name?></a>
                                    @if (Gate::allows('people_edit'))
                                    <a href="/admin/peopleedit/<?=$people->peoples_id?>" title="Редактировать"> <i class="fa fa-fw fa-edit"></i></a>
                                    @endif
                                </td>
                                @if (Gate::allows('position'))
                                <td><a href="/admin/position/<?=$people->position?>"><?=$people->position_name?></a></td>
                                @endif
                                @if (Gate::allows('addresses'))
                                <td><a href="/admin/addressin/<?=$people->addresses?>"><?=$people->addresses_name?></a></td>
                                @endif
                                <td><?=$people->telpersonal?></td>
                                <td><?=$people->telwork?></td>
                                @if (Gate::allows('mailwork'))
                                <td><?=$people->mailwork_name?></td>
                                @endif
                                @if (Gate::allows('people_delele'))
                                <td>
                                    <div class="col-md-3 col-sm-4" data-toggle="modal" data-target="#modal-default_<?=$people->peoples_id?>" title="Удалить"  style="cursor: pointer;" > <i class="fa fa-fw fa-times"></i></div>
                                </td>
                                @endif
                            </tr>
                            <div class="modal modal-danger fade" id="modal-default_<?=$people->peoples_id?>">
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
                            
                            @endforeach
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
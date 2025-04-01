@extends('layouts.admin')

@section('content')

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Группы техники</h3>
                    @if (Gate::allows('group_edit'))
                    <a href="/admin/groupadd"><button class="btn btn-info pull-right">Создать</button></a>
                    @endif
                </div>
                
                @if($mesalt != '')
                <div class="alert alert-danger">
                    <ul>
                        <li>{{ $mesalt }}</li>
                    </ul>
                </div>
                @endif
                
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th width="25">№</th>
                            <th>Название</th>
                            @if (Gate::allows('group_edit'))
                            <th width="25"></th>
                            @endif
                            @if (Gate::allows('group_delete'))
                            <th width="25"></th>
                            @endif
                        </tr>

                        <?php $i = 0;?>
                        @foreach ($groups as $key => $name)
                        <tr>
                            <td><?=$i += 1?></td>
                            <td><a href="/admin/inventorys/<?=$key?>" title="Посмотреть все в этой группе"><?=$name?></a></td>
                            @if (Gate::allows('group_edit'))
                            <td><div class="col-md-3 col-sm-4"><a href="/admin/group/<?=$key?>" title="Редактировать"><i class="fa fa-fw fa-edit"></i></a></div></td>
                            @endif
                            @if (Gate::allows('group_delete'))
                            <td><div class="col-md-3 col-sm-4"><a href="/admin/groupdel/<?=$key?>" title="Удалить"><i class="fa fa-fw fa-times"></i></a></div></td>
                            @endif
                        </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
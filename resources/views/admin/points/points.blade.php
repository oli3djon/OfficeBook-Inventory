@extends('layouts.admin')

@section('content')

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Места храения</h3>
                    @if (Gate::allows('point'))
                    <a href="/admin/pointadd"><button class="btn btn-info pull-right">Создать</button></a>
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
                            @if (Gate::allows('point_edit'))
                            <th width="25"></th>
                            @endif
                            @if (Gate::allows('root'))
                            <th width="25"></th>
                            @endif
                        </tr>

                        <?php $i = 0;?>
                        @foreach ($points as $point)
                            <tr>
                                <td><?=$i += 1?></td>
                                <td><a href="/admin/pointin/<?=$point->id?>" title="Посмотреть все в этом месте"><?=$point->name?></a></td>
                                @if (Gate::allows('point_edit'))
                                <td><div class="col-md-3 col-sm-4"><a href="/admin/point/<?=$point->id?>" title="Редактировать"><i class="fa fa-fw fa-edit"></i></a></div></td>
                                @endif
                                @if (Gate::allows('root'))
                                <td><div class="col-md-3 col-sm-4"><a href="/admin/pointdel/<?=$point->id?>" title="Удалить"><i class="fa fa-fw fa-times"></i></a></div></td>
                                @endif
                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
</section>

@endsection
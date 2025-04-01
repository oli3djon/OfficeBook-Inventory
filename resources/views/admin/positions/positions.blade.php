@extends('layouts.admin')

@section('content')

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Должности</h3>
                    @if (Gate::allows('position_edit'))
                    <a href="/admin/positionadd"><button class="btn btn-info pull-right">Создать</button></a>
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
                            <th width="25"></th>
                            @if (Gate::allows('position_delete'))
                            <th width="25"></th>
                            @endif
                        </tr>
                        
                            <?php $i = 0;?>
                            @foreach ($positions as $position)
                            
                            <tr>
                                <td><?=$i += 1?></td>
                                <td><a href="/admin/position/<?=$position->id?>" ><?=$position->name?></a></td>
                                @if (Gate::allows('position_delete'))
                                <td><div class="col-md-3 col-sm-4"><a href="/admin/positiondel/<?=$position->id?>" title="Удалить"><i class="fa fa-fw fa-times"></i></a></div></td>
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
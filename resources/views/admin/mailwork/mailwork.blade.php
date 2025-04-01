@extends('layouts.admin')

@section('content')

<section class="content">
    <div class="box box-default">
        <div class="box box-solid">
            <div class="box-header with-border" >
                <i class="fa fa-envelope"></i>
                <h3 class="box-title">
                    Почта рабочая: <?=$mailwork->name?>
                </h3>
            </div>

            @if($mesalt != '')
                <div class="alert alert-danger">
                    <ul>
                        <li>{{ $mesalt }}</li>
                    </ul>
                </div>
            @endif

            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="box-body table-responsive no-padding">
                <table class="table">
                    
                    @if (Gate::allows('mailwork_edit'))
                    {!! Form::open(['url' => 'admin/mailwork/'.$mailwork->id], ['method' => 'put']) !!}
                    
                    <tr>
                        <td><input name="name" type="text" class="form-control" value="<?=$mailwork->name?>" disabled></td>
                        <td><input name="pass" type="text" class="form-control" value="<?=$mailwork->pass?>"></td>
                        <td>
                            <button type="submit" class="btn btn-info pull-right">Сохранить</button>
                        </td>
                        @if (Gate::allows('mailwork_delete'))
                        <?=$del_button?>
                        @endif
                    </tr>
                    
                    {!! Form::close() !!}
                    @endif
                    
                </table>
                
                <div class="modal modal-danger fade" id="modal-default">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Удалить E-mail: <?=$mailwork->name?></h4>
                            </div>
                            <div class="modal-body">
                                <p>Вы уверены?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Отменить</button>
                                <a href="/admin/mailworkdel/<?=$mailwork->id?>"  type="button" class="btn btn-primary">Удалить</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @if($cloum > 0 && Gate::allows('people') )

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Зкреплен за:</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div>
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th width="25">Кол.</th>
                    <th width="250">Имя</th>
                    @if (Gate::allows('position'))
                    <th width="200">Должность</th>
                    @endif
                    <th></th>
                    @if (Gate::allows('people_edit'))
                    <th width="25"></th>
                    @endif
                </tr>
                </thead>
                <tbody>
                <?php $i = 0;?>
                @foreach ($peoples as $people)

                    <tr>
                        <td><?=$i += 1?></td>
                        <td><a href="/admin/people/<?=$people->peoples_id?>"><?=$people->surname?> <?=$people->name?></a></td>
                        @if (Gate::allows('position'))
                        <td><?=$people->position_name?></td>
                        @endif
                        <td></td>
                        @if (Gate::allows('people_edit'))
                        <td>
                            <div class="col-md-3 col-sm-4"><a href="/admin/mailworkpeopledel/<?=$people->peoples_id?>" title="Открепить E-mail"><i class="fa fa-fw  fa-toggle-on"></i></a></div>
                        </td>
                        @endif
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>
    
    @endif
    
</section>
@endsection
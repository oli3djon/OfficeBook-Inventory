@extends('layouts.admin')

@section('content')

<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <i class="fa fa-sign-out"></i>
            <h3 class="box-title"><?=$del_button?> <?=$position->name?></h3>
        </div>

        @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error}}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if($mesalt != '')
        <div class="alert alert-danger">
            <ul>
                <li>{{ $mesalt }}</li>
            </ul>
        </div>
        @endif

        @if (Gate::allows('position'))
        <table class="table">
            
            @if (Gate::allows('position_edit'))
            {!! Form::open(['url' => 'admin/position/'.$position->id], ['method' => 'put']) !!}
            
            <tr>
                <td width="300"><input name="name" type="text" class="form-control" value="<?=$position->name?>"</td>
                <td><input type="hidden" name="id" value="<?=$position->id?>"></td>
                <td width="150">
                    <button type="submit" class="btn btn-info pull-right">Сохранить</button>
                </td>
            </tr>
            
            {!! Form::close() !!}
            @endif
            
        </table>
        @endif
    </div>

    <div class="modal modal-danger fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Удалить должность: <?=$position->name?></h4>
                </div>
                <div class="modal-body">
                    <p>Вы уверены?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Отменить</button>
                    <a href="/admin/positiondel/<?=$position->id?>"  type="button" class="btn btn-primary">Удалить</a>
                </div>
            </div>
        </div>
    </div>

    @if($cloum > 0 && Gate::allows('people'))

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">На этой должности:</h3>
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
                    @if (Gate::allows('аddress'))
                    <th width="200">Адресс</th>
                    @endif
                    <th></th>
                    @if (Gate::allows('position'))
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
                            <a href="/admin/people/<?=$people->peoples_id?>"><?=$people->people_surname?> <?=$people->people_name?></a>
                            @if (Gate::allows('people_edit'))
                            <a href="/admin/peopleedit/<?=$people->peoples_id?>" title="Редактировать"><i class="fa fa-fw fa-edit"></i></a>
                            @endif
                        </td>
                        @if (Gate::allows('аddress'))
                        <td><a href="/admin/аddressin/<?=$people->addresses_id?>"><?=$people->addresses_name?></a></td>
                        @endif
                        <td></td>
                        @if (Gate::allows('people_edit'))
                        <td>
                            <div class="col-md-3 col-sm-4"><a href="/admin/positionoff/<?=$people->peoples_id?>" title="Снять с должности"><i class="fa fa-fw  fa-toggle-on"></i></a></div>
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
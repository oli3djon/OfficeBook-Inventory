@extends('layouts.admin')

@section('content')

    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <i class="fa fa-users"></i> Роль
                <h3 class="box-title"></h3>
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
            
            <?=$sevedapp?>
            @if (Gate::allows('position'))
                <table class="table">
                    {!! Form::open(['url' => 'admin/role/'.$role->id], ['method' => 'put']) !!}
                    <tr>
                        <td width="300"><input name="name" type="text" class="form-control" value="<?=$role->name?>"</td>
                        <td width="150">
                            <button type="submit" class="btn btn-info pull-right">Сохранить</button>
                        </td>
                    </tr>
                    {!! Form::close() !!}
                </table>
            @endif
        </div>

        <div class="modal modal-danger fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Удалить должность: </h4>
                    </div>
                    <div class="modal-body">
                        <p>Вы уверены?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Отменить</button>
                        <a href="/admin/positiondel/"  type="button" class="btn btn-primary">Удалить</a>
                    </div>
                </div>
            </div>
        </div>

        @if($cloum > 0)

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Эта роль дана:</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th width="25">№ </th>
                        <th width="200">Имя</th>
                        <th width="200">Адресс</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    
                        <?php $i = 0;?>
                        @foreach ($users as $user)

                        <tr>
                            <td><?=$i += 1?></td>
                            <td><a href="/admin/user/<?=$user->users_id?>" ><?=$user->users_name?></a></td>
                            <td><?=$user->email?></td>
                            <td></td>
                        </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        
        @endif

    </section>
    
@endsection
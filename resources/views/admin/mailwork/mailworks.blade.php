@extends('layouts.admin')

@section('content')

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Почта рабочая</h3>
                </div>
                @if($mesalt != '')
                    <div class="alert alert-danger">
                        <ul>
                            <li>{{ $mesalt }}</li>
                        </ul>
                    </div>
                @endif
                <div class="box-body table-responsive no-padding">
                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <table class="table table-hover">
                    </table>

                    <table class="table table-hover" >
                        
                        @if (Gate::allows('mailwork_edit'))
                        {!! Form::open(['url' => 'admin/mailworks/'], ['method' => 'put']) !!}
                        
                        <tr style="background-color: #CCCCCC;">
                            <td></td>
                            <td><input name="name" type="text" class="form-control" value="{{ old('name') }}" ></td>
                            <td><input name="pass" type="text" class="form-control" ></td>
                            <td></td>
                            <td colspan="2"><button type="submit" class="btn btn-info pull-right">Создать</button></td>
                        </tr>
                        
                        {!! Form::close() !!}
                        @endif

                        <tr>
                            <th width="25">№</th>
                            <th width="300">Название</th>
                            <th width="200">Пароль</th>
                            <th></th>
                            <th width="25"></th>
                        </tr>

                        <?php $i = 0;?>
                        @foreach ($mailworks as $mailwork)
                            <?php if($mailwork->id != 1){?>
                            <tr>
                                <td><?=$i += 1?></td>
                                <td><a href="/admin/mailwork/<?=$mailwork->id?>" title="Редактировать"><?=$mailwork->name?></a></td>
                                <td><?=$mailwork->pass?></td>
                                <td></td>
                                @if (Gate::allows('mailwor_delete'))
                                <td><div class="col-md-3 col-sm-4"><a href="/admin/mailworkdel/<?=$mailwork->id?>" title="Удалить"><i class="fa fa-fw fa-times"></i></a></div></td>
                                @endif
                            </tr>
                            <?php } ?>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
</section>

@endsection
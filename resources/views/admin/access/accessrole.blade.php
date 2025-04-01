@extends('layouts.admin')

@section('content')

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <i class="fa fa-th"></i>
                    <h3 class="box-title">Матрица прав</h3>
                    <a href="/admin/roleadd"><button class="btn btn-info pull-right">Создать роль</button></a>
                </div>
            </div>

            <?=$sevedapp?>

            {!! Form::open(['url' => 'admin/accessrole'], ['method' => 'put']) !!}
            {{ Form::token() }}

            @foreach ($roles as $idrol => $role)
                @if($idrol >1)

                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?=$role?></h3>
                            <div class="box-tools pull-right">
                                <a href="/admin/role/<?=$idrol?>"> <button type="button"  title="Редактировать"><i class="fa fa-fw fa-edit"></i></button></a>
                                <button type="button" data-toggle="modal" data-target="#modal-default_<?=$idrol?>" title="Удалить роль <?=$role?>"><i class="fa fa-fw fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <table class="table table-hover">
                                <tr style="background-color: #cccccc">
                                    <th >Документ</th>
                                    <th style="text-align: center; width: 100px;">Чтение</th>
                                    <th style="text-align: center; width: 100px;">Редактировать</th>
                                    <th style="text-align: center; width: 100px;">Удалить</th>
                                </tr>
                                @foreach ($typedocs as $iddoc => $typedoc)
                                    <tr>
                                        <td><?=$typedoc?> <input name="id[<?=$idrol?>][<?=$iddoc?>]" type="hidden" value="<?=$accessdoc[$idrol][$iddoc]['id']?>"></td>
                                        <td style="text-align: center;"><input type="checkbox"  name="role[<?=$idrol?>][<?=$iddoc?>][1]" <?=$accessdoc[$idrol][$iddoc]['1']?> <?=$accessdocdis[$idrol][$iddoc]['1']?> class="flat-red"></td>
                                        <td style="text-align: center;"><input type="checkbox"  name="role[<?=$idrol?>][<?=$iddoc?>][2]" <?=$accessdoc[$idrol][$iddoc]['2']?> <?=$accessdocdis[$idrol][$iddoc]['2']?> class="flat-red"></td>
                                        <td style="text-align: center;"><input type="checkbox"  name="role[<?=$idrol?>][<?=$iddoc?>][3]" <?=$accessdoc[$idrol][$iddoc]['3']?> <?=$accessdocdis[$idrol][$iddoc]['3']?> class="flat-red"></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>

                    <div class="modal modal-danger fade" id="modal-default_<?=$idrol?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Удалить роль: <?=$role?></h4>
                                </div>
                                <div class="modal-body">
                                    <p>Вы уверены?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Отменить</button>
                                    <a href="/admin/roledel/<?=$idrol?>"  type="button" class="btn btn-primary">Удалить</a>
                                </div>
                            </div>
                        </div>
                    </div>

                @else
                
                    <div class="box box-default">
                        <div class="box box-solid">
                            <div class="box-header with-border" >
                                <h3 class="box-title"><?=$role?></h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                                </div>
                            </div>
                            <div class="box-body" style="display: none;">
                                <table class="table table-hover">
                                    <tr style="background-color: #cccccc">
                                        <th >Документ</th>
                                        <th style="text-align: center; width: 100px;">Чтение</th>
                                        <th style="text-align: center; width: 100px;">Редактировать</th>
                                        <th style="text-align: center; width: 100px;">Удалить</th>
                                    </tr>
                                    @foreach ($typedocs as $iddoc => $typedoc)
                                        <tr>
                                            <td><?=$typedoc?> <input name="id[<?=$idrol?>][<?=$iddoc?>]" type="hidden" value="<?=$accessdoc[$idrol][$iddoc]['id']?>"></td>
                                            <td style="text-align: center;"><input type="checkbox"  name="role[<?=$idrol?>][<?=$iddoc?>][1]" <?=$accessdoc[$idrol][$iddoc]['1']?> <?=$accessdocdis[$idrol][$iddoc]['1']?> class="flat-red"></td>
                                            <td style="text-align: center;"><input type="checkbox"  name="role[<?=$idrol?>][<?=$iddoc?>][2]" <?=$accessdoc[$idrol][$iddoc]['2']?> <?=$accessdocdis[$idrol][$iddoc]['2']?> class="flat-red"></td>
                                            <td style="text-align: center;"><input type="checkbox"  name="role[<?=$idrol?>][<?=$iddoc?>][3]" <?=$accessdoc[$idrol][$iddoc]['3']?> <?=$accessdocdis[$idrol][$iddoc]['3']?> class="flat-red"></td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                    
                @endif
                
            @endforeach

            <div >
                <button type="submit" class="btn btn-info pull-right">Сохранить</button>
            </div>
            {!! Form::close() !!}

        </div>
    </div>
</section>

@endsection
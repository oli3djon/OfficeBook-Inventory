@extends('layouts.admin')

@section('content')

<section class="content">
    <div class="box box-default form-horizontal">
        <div class="box-header with-border" >
            <i class="fa fa-user-secret"></i>
            <h3 class="box-title">Безопасность</h3>
        </div>
        
        {!! Form::open(['url' => 'admin/security/'], ['method' => 'put']) !!}
        
        @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    
                    <div class="form-group">
                        <div class="col-sm-offset-1 col-sm-11">
                            <div class="checkbox">
                                <label>
                                    <input  name="ipon" type="checkbox" <?=$ipon?> > Включить IP фильтр
                                </label>
                            </div>
                        </div>
                        
                        <div class="col-sm-offset-1 col-sm-11">
                            <br>Если выключен - доступ открыт с любого IP адресса! Мой IP: <?=$moyip?><br><br>
                            <table width="300">
    
                                @foreach ($ipmas as $key => $ipma)
                                <tr>
                                    <td width="230" height="40"><button type="button" class="btn btn-block btn-success btn" data-toggle="modal" data-target="#modal-success"><?=$ipma?></button></td>
                                    <td align="center"> <a href="/admin/ipdel/<?=$key?>"> удалить</a></td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2" height="50">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-laptop"></i>
                                                </div>
                                                <input name="ip" type="text" class="form-control" data-inputmask="'alias': 'ip'" data-mask>
                                                <span class="input-group-btn">
                                                <button type="submit" class="btn btn-primary btn-flat">Добавить IP</button>
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-offset-2 col-sm-10">Отображать в разделе Office</label>
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="inventory" <?=$inventory?> > Имущество
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="contact" <?=$contact?> > Контакты
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="position" <?=$position?> > Доджность
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="tel" <?=$tel?> > Рабочий телефон и e-mail
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="address" <?=$address?> > Адресс
                                </label>
                            </div>
                        </div>
                        
                        
                        
                    </div>  
                </div>             
            </div>
            <div class="box-footer">
                <?=$sevedapp?>
                <button type="submit" class="btn btn-info pull-right">Сохранить</button>
            </div>
        </div>
    </div>
    
    {!! Form::close() !!}
    
</section>

@endsection
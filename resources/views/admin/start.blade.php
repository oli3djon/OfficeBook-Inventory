@extends('layouts.admin')

@section('content')

    <section class="content">
        <div class="box box-default">
            <div class="box box-solid">
                <div class="box-header with-border" >
                    <h3 class="box-title"><i class="fa fa-bar-chart"></i>Статистика</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            
                            @if (Gate::allows('people'))
                            <p> <a href="/admin/peoples/1">Сотрудников:</a> <?=$peoples?> человек</p>
                            @endif
                            
                            @if (Gate::allows('root'))
                            <p> <a href="/admin/users">Пользователей:</a> <?=$users?> человек</p>
                            @endif
                            
                            @if (Gate::allows('inventory'))
                            <p> <a href="/admin/inventorys">Имущество:</a> <?=$inventory?> шт.</p>
                            @endif
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection

@extends('layouts.admin')

@section('content')

<section class="content">
    <div class="box box-default">
        <div class="box box-solid">

            <div class="box-header with-border" >
                <i class="fa fa-file-excel-o"></i>
                <h3 class="box-title">
                    Експотр в Excel
                </h3>
            </div>
            <div class="nav-tabs-custom">
                <div class="tab-content">

                    {!! Form::open(['url' => '/admin/export'], ['method' => 'put']) !!}

                    @if (Gate::allows('people_edit'))
                    <div class="form-group">
                        <label>
                            <input name="peoples" type="checkbox" class="flat-red" >
                            Люди
                        </label>
                    </div>
                    @endif
                    @if (Gate::allows('inventory_edit'))
                    <div class="form-group">
                        <label>
                            <input name="inventorys" type="checkbox" class="flat-red" >
                            Номенклатура
                        </label>
                    </div>
                    @endif
                    @if (Gate::allows('root'))
                    <div class="form-group">
                        <label>
                            <input name="historys" type="checkbox" class="flat-red" >
                            История
                        </label>
                    </div>
                    @endif
                    <button type="submit" class="btn btn-primary btn-flat">Выполнить</button>
                    
                    {!! Form::close() !!}
                        
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
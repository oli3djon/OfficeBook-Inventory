@extends('layouts.admin')

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Добавить должность</h3>
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

            <table class="table">
            
                {!! Form::open(['url' => '/admin/positionadd'], ['method' => 'post']) !!}
                {{ Form::token() }}
                
                <tr>
                    <td width="300"><input name="name" type="text" class="form-control" value="<?=$position['name']?>"</td>
                    <td></td>
                    <td width="100"><button type="submit" class="btn btn-info pull-right">Создать</button></td>
                </tr>
                
                {!! Form::close() !!}
                
            </table>
        </div>
    </section>

@endsection
@extends('layouts.admin')

@section('content')

<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Изменить название группы</h3>
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

        <table class="table">
            {!! Form::open(['url' => 'admin/group/'.$group->id], ['method' => 'put']) !!}
            {{ Form::token() }}
            <tr>
                <td width="400"><input name="name" type="text" class="form-control" value="<?=$group->name?>"</td>
                <td><input type="hidden" name="id" value="<?=$group->id?>"></td>
                <td width="150">
                    <button type="submit" class="btn btn-info pull-right">Сохранить</button>
                </td>
            </tr>
            {!! Form::close() !!}
        </table>

    </div>
</section>

@endsection
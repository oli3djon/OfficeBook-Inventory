@extends('layouts.admin')

@section('content')

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <i class="fa fa-users"></i>
                    <h3 class="box-title">Пользователи</h3>
                </div>
                <div class="box-body">
                    <table id="tabledata" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>№</th>
                            <th>Имя пользователя</th>
                            <th>Сотрудник</th>
                            <th>E-mail</th>
                            <th>Дата регистрации</th>
                            <th>Дата последнего входа</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php $i = 0;?>
                        @foreach ($users as $user)
                            <tr>
                                <td><?=$i += 1?></td>
                                <td><a href="/admin/user/<?=$user->id?>"><?=$user->name?></a></td>
                                <td><?=$peopleus[$user->id]?></td>
                                <td><?=$user->email?></td>
                                <td><?=$user->created_at?></td>
                                <td><?=$user->updated_at?></td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>        
        </div>
    </div>
</section>

@endsection
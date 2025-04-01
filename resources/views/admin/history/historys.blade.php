@extends('layouts.admin')

@section('content')

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?=$mesege?></h3>
                </div>

                <div class="box-body">
                        <table  id="tabledata" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Тип документа</th>
                                <th>№</th>
                                <th>Вид правки</th>
                                <th>Автор</th>
                                <th>Время правки</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0;?>
                            @foreach ($historys as $history)
                                <tr>
                                    <td><?=$history->typedoc_name?></td>
                                    <td><a href="/admin/history/<?=$history->typedoc?>/<?=$history->id_doc?>"> <?=$history->id_doc?></a></td>
                                    <td><?=$history->typeedit_name?></td>
                                    <td><?=$history->users_name?></td>
                                    <td><?=$history->time?></td>
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
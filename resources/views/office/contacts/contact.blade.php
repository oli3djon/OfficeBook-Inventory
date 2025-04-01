@extends('layouts.office')

@section('content')

<main>
    <div class="container" >
        <div class="row">
            <div class="col-md-7">
                <h2 class="box-title"> <?=$people->surname?> <?=$people->name?></h2>
                @if ($settings[7] == 1)
                <label>Статус:</label> <cite title="Source Title"><?=$people->status_name?></cite><br />
                <label>Должность:</label> <cite title="Source Title"><?=$people->position_name?></cite><br />
                @endif
                @if ($settings[9] == 1)
                <label>Адрес:</label> <cite title="Source Title"><?=$people->addresses_name?></cite><br />
                @endif
            </div>
            <div class="col-md-5">
                </br>
                <?=$email?>
                <?=$tel?>
                <br>
            </div>
        </div>

        @if ($settings[5] == 1)
        <div class="container">
            <div class="row mt-2 mb-2">
                <h2 class="box-title">Ответственный за имущество:</h2>
                <table id="tabledata" class="table table-hover">
                    <thead >
                    <tr class="thead-dark">
                        <th width="25">Кол.</th>
                        <th width="70">Инв. №</th>
                        <th>Название</th>
                        <th>Группа</th>
                        <th>Местонахождение</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                        <?php $i = 0;?>
                        @foreach ($inventorys as $inventory)
                        
                        <tr>
                            <td><?=$i += 1?></td>
                            <td><?=$inventory->id?></td>
                            <td><?=$inventory->inventorys_name?></td>
                            <td><?=$inventory->groups_name?></td>
                            <td><?=$inventory->points_name?></td>
                        </tr>
                        
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
<main>

@endsection
@extends('layouts.office')

@section('content')

<main>
    <div class="container">
        <div class="row mt-2 mb-2">
            <table id="tabledata" class="table table-hover">
                <thead >
                <tr class="thead-dark">
                    <th scope="col">№</th>
                    <th scope="col">Инв. №</th>
                    <th scope="col">Найменование</th>
                    <th scope="col">Ответственный</th>
                    <th scope="col">Группа</th>
                    <th scope="col">Местонахождение</th>

                </tr>
                </thead>
                <tbody>
                
                    <?php $i = 0;?>
                    @foreach ($inventorys as $inventory)
                    
                    <tr>
                        <td><?=$i += 1?></td>
                        <td><?=$inventory->id?></td>
                        <td><?=$inventory->inventorys_name?></td>
                        <td><a href="/office/contact/<?=$inventory->peoples_id?>"><?=$inventory->peoples_surname?> <?=$inventory->peoples_name?></a></td>
                        <td><?=$inventory->groups_name?></td>
                        <td><?=$inventory->points_name?></td>
                    </tr>
                
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</main>

@endsection
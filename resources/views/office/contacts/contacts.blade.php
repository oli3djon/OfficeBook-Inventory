@extends('layouts.office')

@section('content')

<main>
    <div class="container">
        <div class="row mt-2 mb-2">
            <table id="tabledata" class="table table-hover">
                <thead >
                <tr class="thead-dark">
                    <th scope="col">№</th>
                    <th scope="col">Имя</th>
                    @if ($settings[7] == 1)
                    <th scope="col">Должность</th>
                    @endif
                    <th scope="col" style="min-width:100px">Телефон</th>
                    <th scope="col">E-mail</th>
                    @if ($settings[9] == 1)
                    <th scope="col" style="min-width:100px">Адресс</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                
                    <?php $i = 0;?>
                    @foreach ($peoples as $people)
                    
                    <tr>
                        <td><?=$i += 1?></td>
                        <td><a href="/office/contact/<?=$people->peoples_id?>"><?=$people->surname?> <?=$people->name?></a></td>
                        @if ($settings[7] == 1)
                        <td><?=$people->position_name?></td>
                        @endif
                        <td><?=$dates['tel'][$people->peoples_id]?></td>
                        <td><?=$dates['mail'][$people->peoples_id]?></td>
                        @if ($settings[9] == 1)
                        <td><?=$people->addresses_name?></td>
                        @endif
                    </tr>
                    
                    @endforeach
                
                </tbody>
            </table>
        </div>
    </div>
</main>

@endsection
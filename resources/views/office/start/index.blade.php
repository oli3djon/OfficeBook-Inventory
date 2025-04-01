@extends('layouts.officeup')

@section('content')
    
<div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-1z" data-slide-to="1"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
            <div class="view">
                <video class="video-intro" autoplay loop muted>
                    <source src="/img/office/video/office1.mp4" type="video/mp4" >
                </video>
                <div class="mask rgba-black-light d-flex justify-content-center align-items-center">
                    <div class="text-center white-text mx-5 wow fadeIn">

                        <h1 class="mb-4">
                            <strong><?=$settings['2']?></strong>
                        </h1>
                        <p>
                            <strong><?=$settings['3']?></strong>
                        </p>
                        
                        @if ($settings[6] == 1)
                        <a href="/office/contacts" class="btn btn-outline-white btn-lg">Контакты</a>
                        @endif
                        @if ($settings[5] == 1)
                        <a href="/office/inventorys" class="btn btn-outline-white btn-lg">Имущество</a>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        <div class="carousel-item">
            <div class="view">
                <video class="video-intro" autoplay loop muted>
                    <source src="/img/office/video/office3.mp4" type="video/mp4">
                </video>
                <div class="mask rgba-black-light d-flex justify-content-center align-items-center">
                    <div class="text-center white-text mx-5 wow fadeIn">
                        <h1 class="mb-4">
                            <strong><?=$settings['2']?></strong>
                        </h1>
                        <p>
                            <strong><?=$settings['3']?></strong>
                        </p>
                        
                        @if ($settings[6] == 1)
                        <a href="/office/contacts" class="btn btn-outline-white btn-lg">Контакты</a>
                        @endif
                        @if ($settings[5] == 1)
                        <a href="/office/inventorys" class="btn btn-outline-white btn-lg">Имущество</a>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Предыдущий</span>
    </a>
    <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Следующий</span>
    </a>
</div>

@endsection
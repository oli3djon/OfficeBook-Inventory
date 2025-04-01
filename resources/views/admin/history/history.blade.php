@extends('layouts.admin')

@section('content')

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <ul class="timeline">

                @foreach ($historys as $history)
                <li class="time-label">
                    <span class="bg-green">
                        <?=$history->time?>
                    </span>
                </li>
                    <li>
                        <i class="fa fa-user bg-aqua"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> <?=$passedtime[$history->id]?></span>
                            <h3 class="timeline-header no-border"><a href="/admin/user/<?=$history->user?>"><?=$history->users_name?></a><span class="text-yellow"> <?=$history->typeedit_name?></span></h3>
                            <div class="timeline-body">
                                <ul >
                                @foreach ($hi_edits[$history->id] as $edits)
                                    <li ><span class="text-muted"> <?=$edits['name']?>: </span> <?=$edits['old']?> <?=$edits['new']?></li>
                                @endforeach
                                </ul>
                            </div>
                        </div>
                    </li>
                @endforeach

                <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                </li>
            </ul>
        </div>
    </div>
</section>

@endsection
<?php $i = 1 ?>
@forelse($user->sortedPacks as $pack)

    @if($pack->cards->count() == 0)
        @continue
    @endif

    @if($i == 1)
        <div class="row">
    @endif

    <div class="col-md-3 col-6 dashboard-pack">
        <a class="dashboard-pack__link" href="{{route('repeat', ['pack'=>$pack])}}">
            <div class="dashboard-pack__info hvr-rectangle-out dashboard-pack__info{{ $pack->repeat_now ? '-now' : '-later' }} hvr-rectangle-out{{ $pack->repeat_now ? '-now' : '-later' }}">
                <div class="dashboard-pack__info__text text-center">
                    @if($pack->repeat_now)
                        <span class="dashboard-pack__repeat-now">{{__('pages.repeat_now')}}</span>
                    @else
                        <span class="dashboard-pack__repeat-later">{{trans_choice('pages.next_pack_session', $pack->repeat_in_days, ['days' => $pack->repeat_in_days])}}</span>
                    @endif
                </div>
            </div>
            <div class="dashboard-pack__title text-center">
                {{$pack->title}}
            </div>
        </a>
    </div>

    @if($i == 4)
        </div>
        <?php
            $i = 1;
        ?>
        @continue
    @endif

    <?php $i++ ?>
@empty
    <h3><a href="#">{{__('pages.create_pack')}}</a></h3>
@endforelse

<div class="row">
    <div class="col-md-3 mb-4">
        <h3>{{__('pages.cards_for_session')}}</h3>
        <div class="mb-2">
            {{__('pages.repeated_stats',[
                'count_repeated_cards_in_session' => $sessionStats['count_repeated_cards_in_session'],
                'count_cards_in_session' => $sessionStats['count_cards_in_session'],
                'count_cards_in_pack' => $sessionStats['count_cards_in_pack'],
            ])}}
        </div>
        <div>
            @foreach($sessionStats['cards'] as $sessionCard)
                @if($sessionCard['repeated'] == '1')
                    <i class="fa fa-check-circle"></i>
                @else
                    <i class="fa fa-minus"></i>
                @endif
                    {{$sessionCard['title']}} <br>
            @endforeach
        </div>
    </div>
    <div class="col-md-9">

        <h3>{{$card->title}}</h3>
        {{$card_data}}
        <button class="start-session-button btn btn-success" data-card="{{$card->id}}">
            {{__('pages.next')}}
        </button>

    </div>
</div>

@component('components.card', ['card' => $card, 'pack' => $pack, 'sessionStats' => $sessionStats])

    @slot('card_data')
        <div class="repeat-image-area">
            <img src="{{$card->resource->url}}" class="img-fluid">
        </div>
    @endslot

@endcomponent
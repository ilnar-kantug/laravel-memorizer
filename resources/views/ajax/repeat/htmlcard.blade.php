@component('components.card', ['card' => $card, 'pack' => $pack, 'sessionStats' => $sessionStats])

    @slot('card_data')
        <div class="repeat-html-area">
            {!! $card->resource->data !!}
        </div>
    @endslot

@endcomponent
@extends('layouts.app')

@section('menu')
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ __('menu.create') }} <span class="caret"></span>
        </a>

        <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
            <a class="dropdown-item disabled" href="#">
                {{ __('menu.create_card') }}
            </a>
            <a class="dropdown-item disabled" href="#">
                {{ __('menu.create_pack') }}
            </a>
        </div>
    </li>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card dashboard-profile text-center">
                <div class="card-header">
                    <h2>{{$user->name}}</h2>
                </div>

                <div class="card-body text-center dashboard-profile__body">
                    <div>
                        <div class="dashboard-profile__level">
                            {{__('pages.your_rank_is')}} "{{$user->characteristics['title']}}"
                        </div>
                        <img class="rounded characteristics-avatar" src="{{$user->characteristics['avatar']}}">
                    </div>
                    <div>
                        <div class="dashboard-profile__level">
                            {{__('pages.your_level_is')}} {{$user->level['current']}}
                        </div>
                        <div id="progressbar">
                            <div class="progressbar-label">
                                {{$user->level['percentage']}}%
                            </div>
                        </div>
                    </div>
                    <div>
                        {{__('pages.last_session')}} <br> {{$user->profile->last_session->diffForHumans()}}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">

                <div class="card-header text-center">
                    <h2>{{__('pages.your_card_packs')}}</h2>
                </div>

                <div class="card-body">

                    @include('partials.dashboard_packs')

                </div>
            </div>
            <div class="card">

                <div class="card-header text-center">
                    <h2>{{__('pages.your_cards')}}</h2>
                </div>

                <div class="card-body">
                    <div class="row dashboard-cards">
                        @forelse($user->cards as $card)
                            <div class="col-md-2 col-4 dashboard-cards__item">
                            @if($loop->index == 4)
                                    <a class="disabled" href="#">{{__('pages.see_all_cards')}}</a>
                                </div>
                                @break
                            @endif
                            @if($loop->last)
                                    {{$card->title}}
                                </div>
                                <div class="col-md-2 col-4 dashboard-cards__item">
                                    <a class="disabled" href="#">{{__('pages.see_all_cards')}}</a>
                                </div>
                                @break
                            @endif
                                {{$card->title}}
                            </div>
                        @empty
                            <h3><a href="#">{{__('pages.create_card')}}</a></h3>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials.functionality-modal')
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(  ) {
            $( "#progressbar" ).progressbar({
                max: {{$user->level['max_experience']}},
                value: {{$user->level['current_experience']}}
            });

            $('.dashboard-pack__info-later').hover(
                function() {
                    var text_element = $( this ).find('.dashboard-pack__repeat-later');
                    text_element_data = text_element.text();
                    text_element.empty().text('{{__('pages.do_you_want_repeat_now')}}');
                }, function() {
                    $( this ).find('.dashboard-pack__repeat-later').empty().text(text_element_data);
                }
            );
            if(!Cookies.get('functionality')){
                $('#functionalityModal').modal('show');
            }

            $('#functionalityStop').on('click', function(event) {
                event.preventDefault();
                Cookies.set('functionality', 'stop');
                $('#functionalityModal').modal('hide');
            });
        });
    </script>
@endsection
@extends('layouts.app')

@section('menu')
    <li class="nav-item">
        <a class="nav-link" href="#">{{ __('menu.edit_pack') }}</a>
    </li>
@endsection

@section('content')
    <div class="container">
        <div class="repeat-title">{{$pack->title}}</div>
        <div class="repeat-info">
            <div>{{__('pages.last_session')}}<br>{{$pack->last_session->diffForHumans()}}</div>
            <div>
                {{__('pages.session_needed')}} <br>
                    @if($pack->repeat_now)
                        <span class="repeat-when-now">{{__('pages.now')}}</span>
                    @else
                        <span class="repeat-when-days">{{trans_choice('pages.next_pack_session', $pack->repeat_in_days, ['days' => $pack->repeat_in_days])}}</span>
                    @endif
            </div>
        </div>
        <div class="text-center mt-5">
            <button class="repeat-button btn btn-success">
                {{__('pages.start_session')}}
                @if(!$pack->repeat_now)
                    ?
                @endif
            </button>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
@extends('layouts.app')

@section('menu')
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ __('menu.create') }} <span class="caret"></span>
        </a>

        <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('dashboard') }}">
                {{ __('menu.create_card') }}
            </a>
            <a class="dropdown-item" href="{{ route('dashboard') }}">
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
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        jQuery(document).ready(function(  ) {
            "use strict";
            jQuery( "#progressbar" ).progressbar({
                max: {{$user->level['max_experience']}},
                value: {{$user->level['current_experience']}}
            });
        });
    </script>
@endsection
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Keep In Mind</title>

        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Scripts -->
        <script src="{{ mix('js/app.js', 'build') }}"></script>

        <!-- Styles -->
        <link href="{{ mix('css/app.css', 'build') }}" rel="stylesheet">
    </head>
    <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mr-2">
                    <span class="navbar-text">ver. - {{config('app.version')}}</span>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">{{ __('menu.dashboard') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('menu.logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('menu.login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="modal" data-target="#exampleModal" href="#">{{ __('menu.register') }}</a>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>
    <div class="container lp-content">
        <div>
            <div class="lp-title">
                Keep In Mind
            </div>

            <div class="lp-description text-center">
                {{__('pages.description')}}
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title text-center" id="exampleModalLabel">{{ __('menu.register') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    Регистрация с подтверждением почтового ящика работает,<br>
                    <strong>но</strong><br>
                    т.к. функционал создания карточек и тематических подборок пока что не выпущен,
                    то рекомендуем воспользоваться существующими пользователями для оценки текущего
                    функционала сервиса
                    <hr>
                    Нажмите на кнопку "Войти"
                </div>
                <div class="modal-footer">
                    <a class="btn btn-success" href="{{ route('login') }}">{{ __('menu.login') }}</a>
                    <a class="btn btn-success" href="{{ route('register') }}">{{ __('menu.register') }}</a>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>

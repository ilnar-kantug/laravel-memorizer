<!-- Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title text-center" id="registerModalLabel">{{ __('menu.register') }}</h5>
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

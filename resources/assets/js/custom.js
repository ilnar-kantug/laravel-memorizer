$(document).ready(function() {
    var repeat_container = $('.repeat-container');
    repeat_container.on('click', '.start-session-button', function(event) {
        $.ajax({
            type 		: 'GET',
            dataType 	: 'json',
            url 		: repeat_url_start,
            data        : {'card': $(event.target).data('card')}
        })
        .done(function(data) {
            if ( ! data.success) {
                console.log('error');
            } else {
                repeat_container.empty().html(data.html);
            }
        })
        .fail(function(data) {
            console.log('fail');
        });
        event.preventDefault();
    });
});

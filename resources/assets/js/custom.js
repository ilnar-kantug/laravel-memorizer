$(function() {
    "use strict";
    $( "#progressbar" ).progressbar({
        max: user_max_experience,
        value: user_current_experience
    });
});

<?php

function create($class, $attributes = [], $times = null)
{
    return factory($class, $times)->create($attributes);
}

function make($class, $attributes = [], $times = null)
{
    return factory($class, $times)->make($attributes);
}

function rawData($class, $attributes = [])
{
    return factory($class)->raw($attributes);
}

function search_in_toastr_session($message)
{
    return in_array($message, array_column(session()->get('toastr::notifications'), 'message'));
}

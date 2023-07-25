<?php

function setActive($path, $active = 'active') {
    return call_user_func_array('Request::is', (array)$path) ? $active : '';
}


/*
function alert($message = null, $title = '') {
    return call_user_func_array('Alert::', $path.';
}
*/
function setShow($path, $show = 'show') {
    return call_user_func_array('Request::is', (array)$path) ? $show : '';
}
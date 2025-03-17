<?php
function mori_dynamic_version() {
    $version = wp_get_theme()->get('Version');
    $timestamp = time();
    return $version.'_time_'.$timestamp;
}
<?php

use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route as FacadesRoute;

if (!function_exists('merge_classes')) {
    function merge_classes(...$classes)
    {
        return implode(' ', array_filter($classes));
    }
}

if (!function_exists('active_route')) {
    function active_route($routeName, $class = 'active-page')
    {
        return FacadesRoute::currentRouteName() == $routeName ? $class : '';
    }
}

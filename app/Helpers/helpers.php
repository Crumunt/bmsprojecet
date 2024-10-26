<?php


if (!function_exists('merge_classes')) {
    function merge_classes(...$classes) {
        return implode(' ', array_filter($classes));
    }
}

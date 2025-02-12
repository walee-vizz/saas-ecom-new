<?php


if (!function_exists('module_asset')) {
    function module_asset($path)
    {
        return url("Modules/{$path}");
    }
}

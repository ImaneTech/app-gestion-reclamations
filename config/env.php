<?php

if (!function_exists('envOrDefault')) {
    function envOrDefault($key, $default) {
        $value = getenv($key);
        return ($value !== false && $value !== '') ? $value : $default;
    }
}

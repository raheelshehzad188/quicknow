<?php

if (!function_exists('format_amount')) {
    function format_amount($amount = 0) {
        return env('CUR').' '.$amount;
    }
}

if (!function_exists('custom_assets')) {
    function custom_assets($path = '') {
        return env('IMG_URL') . $path;
    }
}
if (!function_exists('env')) {
    /**
     * Safe env access (works with config:cache)
     */
    function env($key, $default = null)
    {
        // Convert ENV_KEY to config.key format
        $configKey = strtolower(str_replace('_', '.', $key));

        // First try direct config
        if (config()->has($configKey)) {
            return config($configKey);
        }

        // Try app.* namespace
        if (config()->has('app.' . strtolower($key))) {
            return config('app.' . strtolower($key));
        }

        return $default;
    }
}


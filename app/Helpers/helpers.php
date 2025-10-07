<?php

if (!function_exists('format_amount')) {
    function format_amount($amount = 0) {
        return env('CUR').' '.$amount;
    }
}

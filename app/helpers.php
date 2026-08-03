<?php

use App\Services\TranslationService;

if (!function_exists('translate')) {

    function translate($text)
    {
        return app(TranslationService::class)
            ->translate($text, session('language', 'en'));
    }
}
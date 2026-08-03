<?php

namespace App\Services;

use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslationService
{
    public function translate($text, $targetLanguage)
    {
        if ($targetLanguage == 'en') {
            return $text;
        }

        try {

            $translator = new GoogleTranslate();

            $translator->setSource('en');      // Original Language
            $translator->setTarget($targetLanguage);

            return $translator->translate($text);

        } catch (\Exception $e) {

            return $text;

        }
    }
}
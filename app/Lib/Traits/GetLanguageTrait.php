<?php

namespace App\Lib\Traits;


trait GetLanguageTrait
{
    public function getRequestLanguage($request)
    {
        $language_list = config('custom.supported_langauges');
        $language = null;
        if ($request->hasHeader('X-Language')) {
            $language = $request->header('X-Language');
            if (!in_array($language, $language_list))
                $language = 'az';
        }

        return $language;
    }
}

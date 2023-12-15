<?php

namespace App\Http\Resources;

use App\Lib\Traits\GetLanguageTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    use GetLanguageTrait;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $languageCode = $this->getRequestLanguage($request);
        $translations = $this->translation($languageCode)->get();

        return [
            'id_news'           => $this->id,
            'view_count'        => $this->view_count,
            'translation'       => NewsTranslationResource::collection($translations)
        ];
    }
}

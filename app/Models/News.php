<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function translation($languageCode = null)
    {
        $query = $this->hasMany(NewsTranslation::class, 'fk_id_news', 'id');

        if ($languageCode !== null) {
            $query->where('language_code', $languageCode);
        }
        return $query;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}

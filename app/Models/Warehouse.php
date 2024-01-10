<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function getDescriptionByLocale(string $locale): string
    {
        return $locale === 'ru' ? $this->description_ru : $this->description;
    }
}

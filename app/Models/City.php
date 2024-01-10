<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public function warehouses()
    {
        return $this->hasMany(Warehouse::class);
    }

    public function getSettlementTypeByLocale(string $locale): string
    {
        return $locale === 'ru' ? $this->settlement_type_description_ru : $this->settlement_type_description;
    }

    public function getDescriptionByLocale(string $locale): string
    {
        return $locale === 'ru' ? $this->description_ru : $this->description;
    }

    public function getAreaByLocale(string $locale): string
    {
        return $locale === 'ru' ? $this->area_description_ru : $this->area_description;
    }
}

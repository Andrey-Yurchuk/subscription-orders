<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property bool $cooking_day_before
 */
class Tariff extends Model
{
    protected $fillable = [
        'ration_name',
        'cooking_day_before',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $schedule_type
 * @property Tariff $tariff
 */

class Order extends Model
{
    protected $fillable = [
        'client_name',
        'client_phone',
        'tariff_id',
        'schedule_type',
        'comment',
        'first_date',
        'last_date',
    ];

    public function rations(): HasMany
    {
        return $this->hasMany(Ration::class);
    }

    public function tariff(): BelongsTo
    {
        return $this->belongsTo(Tariff::class);
    }
}

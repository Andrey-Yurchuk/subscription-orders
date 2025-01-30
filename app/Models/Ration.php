<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ration extends Model
{
    protected $fillable = [
        'order_id',
        'cooking_date',
        'delivery_date',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}

<?php

namespace App\Models;

use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Timezone extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'country_id',
        'name',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');

    }

}

<?php

namespace App\Models;

use App\Models\City;
use App\Models\Country;
use App\Models\Currency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class State extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'country_id',
        'name	',
        'country_code',
    ];
 
    public function city(): hasMany
    {
        return $this->hasMany(City::class, 'state_id');

    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'state_id');

    }

}

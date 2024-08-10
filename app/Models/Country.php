<?php

namespace App\Models;

use App\Models\City;
use App\Models\State;
use App\Models\Company;
use App\Models\Currency;
use App\Models\Timezone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'iso2',
        'name',
        'status',
        'phone_code',
        'region',
        'subregion',

    ];
    
    public function company(): hasMany
    {
        return $this->hasMany(Company::class, 'country');

    }

    public function city(): hasMany
    {
        return $this->hasMany(City::class, 'country_id');

    }

    public function Timezone(): BelongsTo
    {
        return $this->belongsTo(Timezone::class, 'country_id');

    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'country_id');

    }

}

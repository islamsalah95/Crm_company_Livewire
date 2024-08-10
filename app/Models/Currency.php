<?php

namespace App\Models;

use App\Models\State;
use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Currency extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'country_id',
        'state_id',
        'name',
        'country_code',
    ];
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');

    }
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'state_id');

    }
}

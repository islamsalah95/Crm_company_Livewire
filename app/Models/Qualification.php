<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Qualification extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class,'qualification_id');
    }
}

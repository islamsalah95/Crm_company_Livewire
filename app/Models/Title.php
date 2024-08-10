<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Title extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'job_ar',
        'job_en',
        'salary'
    ];


    public function title(): HasOne
    {
        return $this->hasOne(User::class,'title_id');
    }


}

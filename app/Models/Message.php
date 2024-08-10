<?php

namespace App\Models;

use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'message',
        'from_user_id',
        'to_user_id',
        'company_id',
        'created_at',
        'updated_at',

    ];

    public function from(): BelongsTo
    {
        return $this->belongsTo(User::class, 'from_user_id');

    }


    public function to(): BelongsTo
    {
        return $this->belongsTo(User::class, 'to_user_id');

    }


    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');

    }

}

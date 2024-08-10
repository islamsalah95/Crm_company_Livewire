<?php

namespace App\Models;

use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'project_name',
        'project_type',
        'start_date',
        'end_date',
        'company_id',
        'user_id',
        'share_project_to',
        'rating',
        'ip_address',
        'created_at',
        'updated_at',
    ];
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');

    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user', 'project_id', 'user_id');

    }

}

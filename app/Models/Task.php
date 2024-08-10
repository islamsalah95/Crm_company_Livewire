<?php

namespace App\Models;

use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'type',
        'remind',
        'project_id',
        'company_id',
        'user_id',
        'status',
        'ip_address',
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'task_user', 'task_id', 'user_id');

    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');

    }

}

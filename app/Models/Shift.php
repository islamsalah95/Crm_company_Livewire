<?php

namespace App\Models;

use App\Models\Task;
use App\Models\User;
use App\Models\Company;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shift extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'check_in',
        'check_out',
        'check_out_time',
        'user_id',
        'company_id',
        'project_id',
        'task_id',
        'manual_edit',
        'cron_edit',
        'approved_time',
        'ip_address',
        'created_at',
        'updated_at',
        'current_dt',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');

    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');

    }


    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');

    }


    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'task_id');

    }



}

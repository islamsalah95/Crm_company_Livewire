<?php

namespace App\Models;

use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contract extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id',
        'company_id',
        'EstLaborOfficeId',
        'EstSequenceNumber',
        'is_molTWC',
        'working_hours',
        'working_hours_per_day',
        'working_hours_per_week',
        'hourly_rate',
        'start_date',
        'end_date',
        'gosi_job_title_id',
        'created_by',
        'created_on',
        'status',
        'reference_number',
        'message',
        'status_id',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');

    }

    public function usersCreated_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');

    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');

    }

}

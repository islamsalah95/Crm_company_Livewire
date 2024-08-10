<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use App\Models\City;
use App\Models\Task;
use App\Models\Zoom;
use App\Models\Title;
use App\Models\Project;
use App\Models\Contract;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasFactory, Notifiable ,InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'emp_surname' ,
        'contact1' ,
        'birthday' ,
        'employee_national_number',
        'city_id' ,
        'title_id',
        'qualification_id',
        'email' ,
        'password',
        'company_id' ,
        'department',
        'privacy_check',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function title(): BelongsTo
    {
        return $this->belongsTo(Title::class, 'title_id');

    }

    public function qualification(): BelongsTo
    {
        return $this->belongsTo(Qualification::class, 'qualification_id');

    }

    public function contracts(): hasMany
    {
        return $this->hasMany(Contract::class, 'user_id');

    }

    public function expiration($userId)
    {
        // Retrieve the latest contract for the user
        $contract = Contract::where('user_id', $userId)
            ->latest('created_on')
            ->first();

        // Check if a contract was found
        if ($contract) {
            // Retrieve the end date from the contract
            $endDate = $contract->end_date;

            // Convert the end date string to a Carbon instance for comparison
            $endDate = Carbon::parse($endDate);

            // Get today's date
            $today = Carbon::today();

            // Check if the end date has passed today
            if ($endDate->lessThanOrEqualTo($today)) {
                // End date has passed, contract is invalid
                return false;
            } else {
                // End date is in the future, contract is still valid
                return true;
            }
        } else {
            // No contract found for the user
            return false;
        }
    }



    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_user', 'user_id', 'project_id');

    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_user', 'user_id', 'task_id');

    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');

    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');

    }
    public function zooms()
    {
        return $this->belongsToMany(Zoom::class, 'zoom_user', 'user_id', 'zoom_id');

    }

    


}

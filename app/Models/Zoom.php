<?php

namespace App\Models;

use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Zoom extends Model
{
    use HasFactory;
    protected $fillable = [
        "id" ,
        "host_email" ,
        "topic" ,
        "start_time" ,
        "duration" ,
        "timezone" ,
        "start_url" ,
        "join_url" ,
        "password" ,
        "company_id" ,
        "status" ,

    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'zoom_user', 'zoom_id', 'user_id');

    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');

    }

}

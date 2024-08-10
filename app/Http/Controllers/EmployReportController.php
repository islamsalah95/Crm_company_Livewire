<?php

namespace App\Http\Controllers;

use App\Models\User;



class EmployReportController extends Controller
{


    public function index(User $user)
    {


        return view('crm.profiles.show',['user'=>$user]);


    }


}

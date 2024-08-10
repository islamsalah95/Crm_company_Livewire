<?php

namespace App\Http\Controllers;

use App\Models\Project;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        return view('crm.projects.show');


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('crm.projects.create');

    }

}

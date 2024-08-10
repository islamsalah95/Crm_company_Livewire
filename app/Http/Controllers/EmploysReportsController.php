<?php

namespace App\Http\Controllers;



class EmploysReportsController extends Controller
{

    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        return view('crm.reports.show');


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('crm');

    }
}

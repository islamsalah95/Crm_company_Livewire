<?php

namespace App\Http\Controllers;

use App\Models\company;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorecompanyRequest;
use App\Http\Requests\UpdatecompanyRequest;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('crm.companies.show');

    }

    public function registerCompanies()
    {
        return view('crm.companies.registerCompanies');

    }

    public function notWorking()
    {
        return view('crm.companies.notWorking');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($country)
    {
        return view('crm.companies.create',['country'=>$country]);

    }


    public function createSetCompany()
    {

        $myCountries=Country::all();
       
        
        return view('crm.companies.setCompanyCreate',compact('myCountries'));

    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecompanyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('crm.companies.edit',['company'=>$company]);

    }




    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecompanyRequest $request, company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
    }
}

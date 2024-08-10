<?php
namespace App\Services;


use App\Models\Company;
use App\Traits\CurrentDateTrait;
use App\Http\Requests\StorecompanyRequest;


class CompanyService
{

    protected $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }

        /**
     * Display all resource.
     */
    public function companies($is_valid,$status,$company_name,$paginate=5)
    {
        return $this->company::
        where('is_valid', $is_valid)->
        where('status', $status)->
        where('company_name', 'like', '%' . $company_name. '%')->
        paginate($paginate);
    }


    public function block(Company  $company)
    {
        // status 0 غير معطلة
        if($company->status == 0){
            $company->status = 1;
        }
        else{
            $company->status = 0;
        }
        $company->save();
        return  $company;
    }

    public function activeNewCompany(Company  $company)
    {
            //  is_valid company 1 active 
            // is_valid company 0 inactive
        if($company->is_valid  == 0){
            $company->is_valid = 1;
            $company->save();
        }
        return  $company;
    }

        /**
     * Store a newly created resource in storage.
     */
    public function store(StorecompanyRequest $request)
    {

        $company = new Company;

        $company->company_name = $request['company_name'];
        $company->company_website = $request['company_website'];
        $company->company_email = $request['company_email'];
        $company->company_address = $request['company_address'];
        $company->telephone1 = $request['telephone1'];

        $company->company_currencysymbol = $request['company_currencysymbol'];
        $company->country = $request['country'];
        $company->state = $request['state'];
        $company->city = $request['city'];
        $company->timezone = $request['timezone'];

        $company->zip = $request['zip'];
        $company->logo = $request['logo'] ?? '';
        $company->create_date = CurrentDateTrait::getDate_Y_m_d_H_i_s();
        $company->save();
         return $company  ;
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return  $company ;
    }


        /**
     * Update the specified resource in storage.
     */
    public function update(StorecompanyRequest $request, Company $company)
    {


        $company->company_name = $request['company_name'];
        $company->company_website = $request['company_website'];
        $company->company_email = $request['company_email'];
        $company->company_address = $request['company_address'];
        $company->telephone1 = $request['telephone1'];

        $company->company_currencysymbol = $request['company_currencysymbol'];
        $company->country = $request['country'];
        $company->state = $request['state'];
        $company->city = $request['city'];
        $company->timezone = $request['timezone'];

        $company->zip = $request['zip'];
        $company->logo = $request['logo'] ?? '';
        $company->create_date = CurrentDateTrait::getDate_Y_m_d_H_i_s();
        $company->save();
        return $company  ;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {

        return  $company->delete() ;
    }


}

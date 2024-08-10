<?php

namespace App\Livewire\Company;
use App\Models\Title;
use App\Models\Company;
use App\Models\Country;
use App\Traits\WorldTrait;
use App\Models\Qualification;
use Livewire\WithFileUploads;
use App\Services\CompanyService;
use App\Traits\ImageUploadTrait;
use App\Http\Requests\StorecompanyRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Edit extends Component
{

    use WithFileUploads;


    public $search;
    // company
    public $company;
    public $company_name;
    public $company_website;
    public $company_email;
    public $company_address;
    public $telephone1;
    public $country;
    public $state;
    public $city;
    public $timezone;
    public $zip;
    public $currently_allowed_employee;
    public $company_currencysymbol;
    public $logo;
    protected function rules()
    {
        return [
            'company_name' => ['required', 'string', 'max:255'],
            'company_website' => ['required', 'string', 'max:255'],
            'company_email' =>$this->company_email == $this->company['company_email'] ? 'nullable': ['required', 'string', 'email', 'max:255','unique:companies,company_email'],
            'company_address' => ['required', 'string', 'max:255'],
            'telephone1' => ['required', 'numeric'],

            'company_currencysymbol' => ['required', 'exists:currencies,id'],
            'country' => ['required', 'exists:countries,id'],
            'state' =>['required', 'exists:states,id'],
            'city' => ['required', 'exists:cities,id'],
            'timezone' => ['required', 'exists:timezones,id'],

            'zip' => ['required', 'string', 'max:255'],
            'logo' => $this->logo && !is_string($this->logo) ? 'image|mimes:jpeg,png,jpg,gif|max:2048' : 'nullable',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function createInstanceCompanyService()
    {
            return new CompanyService(new Company );

    }

    public function submitForm()
    {

        $this->validate();
        
        $path= ImageUploadTrait::uploadImage($this->logo,'logos');

        $arrayFormCompany=[
            'company_name' => $this->company_name,
            'company_website' => $this->company_website,
            'company_email' =>  $this->company_email,
            'company_address' => $this->company_address,
            'telephone1' => $this->telephone1,

            'company_currencysymbol' =>  $this->company_currencysymbol,
            'country' => $this->country,
            'state' => $this->state,
            'city' => $this->city,
            'timezone' =>  $this->timezone,
            'logo' =>  $path,
            'zip' =>  $this->zip,
        ];

        $CompanyService=new CompanyService(new Company);
        $CompanyService->update(new StorecompanyRequest ($arrayFormCompany),$this->company);

        if (session()->has('editCompany') && Auth::user()->id ==session('editCompany.authUserId')) {
            session()->forget('editCompany');
        }

        session()->flash('message', 'company successfully update.');
    }


     public function countryChanged()
     {
           
        session([
            'editCompany'=>[
                            'authUserId' => Auth::user()->id,
                            'newCountryId' =>$this->country,
                           ]
        ]);

        $this->redirectRoute('companies.edit', ['company' => $this->company['id']]);

     }


public function mount(){

    if (session()->has('editCompany') && Auth::user()->id ==session('editCompany.authUserId')) {
        $this->country=session('editCompany.newCountryId');
    }else{
        $this->country=$this->company['country'];
    }

    $this->company_name=$this->company['company_name'];
    $this->company_website=$this->company['company_website'];
    $this->company_email=$this->company['company_email'];
    $this->company_address=$this->company['company_address'];
    $this->telephone1=$this->company['telephone1'];
    $this->state=$this->company['state'];
    $this->city=$this->company['city'];
    $this->timezone=$this->company['timezone'];
    $this->zip=$this->company['zip'];
    $this->company_currencysymbol=$this->company['company_currencysymbol'];
    $this->logo=$this->company['logo'];
}

    public function render()
    {

        $currency=WorldTrait::currency($this->country);
        $setCountry= WorldTrait::countriesInfo($this->country);

        $this->timezone=$setCountry[0]['timezones'][0]['id'] ;
        $this->company_currencysymbol= $currency[0]['id'] ;

        return view('livewire.company.edit', [
            'myCountries' => Country::get(),
            'currency' => $currency,
            'countryInfos' =>$setCountry,
            'jobs' => Title::all(),
            'qualifications' =>Qualification::all()
            ]);
    }
}

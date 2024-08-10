<?php

namespace App\Livewire\Company;

use App\Models\User;
use App\Models\Title;
use App\Models\Company;
use App\Models\Country;
use Livewire\Component;
use App\Traits\WorldTrait;
use App\Models\Qualification;
use App\Services\UserService;
use Livewire\WithFileUploads;
use App\Services\CompanyService;
use App\Traits\CurrentDateTrait;
use App\Traits\ImageUploadTrait;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\StorecompanyRequest;

class Create extends Component
{
    use WithFileUploads;

    public $show =0;
    public $photo;
    public $id;
    public $name;
    public $emp_surname;
    public $contact1;
    public $birthday;
    public $employee_national_number;
    public $city_id;
    public $title_id;
    public $qualification_id;
    public $email;
    public $password;
    public $emp_photo_file;
    public $search;
    // company
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
            'company_email' => ['required', 'string', 'email', 'max:255','unique:companies,company_email'],
            'company_address' => ['required', 'string', 'max:255'],
            'telephone1' => ['required', 'numeric'],

            'company_currencysymbol' => ['required', 'exists:currencies,id'],
            'country' => ['required', 'exists:countries,id'],
            'state' =>['required', 'exists:states,id'],
            'city' => ['required', 'exists:cities,id'],
            'timezone' => ['required', 'exists:timezones,id'],

            'zip' => ['required', 'string', 'max:255'],
            // 'currently_allowed_employee' => ['required', 'numeric'],


            'name' => ['required', 'string', 'max:255'],
            'emp_surname' => ['required', 'string', 'max:255'],
            'contact1' => ['required'],
            'birthday' => ['required', 'date'],
            'employee_national_number' => ['required', 'numeric'],
            'city_id' => ['required', 'exists:cities,id'],
            'title_id' => ['required', 'exists:titles,id'],
            'qualification_id' => ['required', 'exists:qualifications,id'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', Rules\Password::defaults()],

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

    public function save()
    {

        $this->validate();


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
            'logo' =>  "a.jpg",
            'zip' =>  $this->zip,
        ];

        $CompanyService=new CompanyService(new Company);
        $company=$CompanyService->store(new StorecompanyRequest ($arrayFormCompany));

        $company->addMedia($this->logo)->toMediaCollection('logos');

        if( $company->id){
            $arrayFormAdmin= [
                'name' => $this->name,
                'emp_name' => $this->name,
                'emp_surname' => $this->emp_surname,
                'contact1' => $this->contact1,
                'birthday' => $this->birthday,
                'employee_national_number' => $this->employee_national_number,

                'city_id' => $this->city_id,
                'title_id' => $this->title_id,
                'qualification_id' => $this->qualification_id,

                'email' => $this->email,
                'password' => $this->password,
                'status' => 1,
                'company_id' => $company->id,
                'department' => '5',
            ];
            $UserService=new UserService(new User);
           $user= $UserService->store(new StoreUserRequest ($arrayFormAdmin));
           $user->addMedia($this->emp_photo_file)->toMediaCollection('employs');
        }


        session()->flash('message', 'company successfully create.');

        $this->redirectRoute('login');

    }


     public function countryChanged()
     {

            $this->redirectRoute('companies.create', ['country' => $this->country]);

     }





     public function render()
    {


        $currency=WorldTrait::currency($this->country);
        $setCountry= WorldTrait::countriesInfo($this->country);
        $phoneCode= Country::findOrfail($this->country)->phone_code;

        $this->timezone=$setCountry[0]['timezones'][0]['id'] ;
        $this->company_currencysymbol= $currency[0]['id'] ;

        return view('livewire.company.create', [
            'myCountries' => Country::get(),
            'currency' => $currency,
            'countryInfos' =>$setCountry,
            'phoneCode' =>$phoneCode,
            'jobs' => Title::all(),
            'qualifications' =>Qualification::all()
            ]);
    }
}

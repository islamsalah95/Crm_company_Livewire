<?php

namespace App\Livewire\Employs;

use Livewire\Component;
use App\Models\User;
use App\Models\Title;
use App\Traits\WorldTrait;
use App\Models\Qualification;
use Livewire\WithFileUploads;
use App\Traits\CurrentDateTrait;
use App\Traits\ImageUploadTrait;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;

class CreateEmploys extends Component
{
    use WithFileUploads;

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
    public $myJob ;
    public $search;
    public $country=194;


    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'emp_surname' => ['required', 'string', 'max:255'],
            'contact1' => ['required'],
            'birthday' => ['required', 'date'],
            'employee_national_number' => ['required', 'numeric'],
            'city_id' => ['required', 'exists:cities,id'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', Rules\Password::defaults()],
            'emp_photo_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // max:2048 means maximum file size is 2 MB
            'country' => ['required', 'exists:countries,id'],
            'title_id' => ['required', 'exists:titles,id'],
            'qualification_id' => ['required', 'exists:qualifications,id'],

        ];
    }



    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveContact()
    {

        $this->validate();

      $formattedDate = CurrentDateTrait::getDate_Y_m_d_H_i_s();

        $emp=User::create([
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
            'password' => Hash::make($this->password),

            'company_id' => 1,
            'department' => '3',
            'privacy_check' => 1,
            'joining_date' =>    $formattedDate,
            'create_date' =>    $formattedDate,
        ]);

        $emp->addMedia($this->emp_photo_file)->toMediaCollection('employs');

        session()->flash('message', 'Admin successfully updated.');

        return redirect()->route('login');

    }

    #[On('country-change')]
    public function countryChanged($country)
    {
        $this->country=$country;

    }


    #[On('qualification-change')]
    public function qualificationChanged($qualification_id)
    {
        $this->qualification_id=$qualification_id;

    }

    #[On('job-change')]
    public function jobChanged($title_id)
    {
        $this->title_id=$title_id;

    }

    public function render()
    {
        $cities=WorldTrait::countriesInfo($this->country);

        return view('livewire.employs.create-employs', ['cities' => $cities[0]['cities']]);
    }


}

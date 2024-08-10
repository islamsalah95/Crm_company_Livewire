<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Title;
use Livewire\Component;
use App\Traits\WorldTrait;
use App\Models\Qualification;
use Livewire\WithFileUploads;
use App\Traits\CurrentDateTrait;
use App\Traits\ImageUploadTrait;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;

class CreateAdmins extends Component
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
            'title_id' => ['required', 'exists:titles,id'],
            'qualification_id' => ['required', 'exists:qualifications,id'],
            'email' => ['required', 'string', 'email', 'max:255', 'exists:users,email'],
            'password' => ['required', Rules\Password::defaults()],
            'emp_photo_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // max:2048 means maximum file size is 2 MB
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveContact()
    {

      $formattedDate = CurrentDateTrait::getDate_Y_m_d_H_i_s();
       $path= ImageUploadTrait::uploadImage($this->emp_photo_file,'profile');
       $this->emp_photo_file=$path;

      $newTitle_id=Title::firstWhere('job_ar',$this->search);
      $this->myJob=$this->search;

        User::create([
            'name' => $this->name,
            'emp_name' => $this->name,
            'emp_surname' => $this->emp_surname,
            'contact1' => $this->contact1,
            'birthday' => $this->birthday,
            'employee_national_number' => $this->employee_national_number,

            'city_id' => $this->city_id,
            'title_id' => $newTitle_id['id'],
            'qualification_id' => $this->qualification_id,

            'email' => $this->email,
            'password' => Hash::make($this->password),

            'company_id' => 1,
            'department' => 1,
            'privacy_check' => 1,
            'joining_date' =>    $formattedDate,
            'create_date' =>    $formattedDate,

            'emp_photo_file' =>  $path ,

        ]);

        session()->flash('message', 'Admin successfully updated.');

    }

    #[On('country-change')]
    public function countryChanged($country)
    {
        $this->country=$country;

    }

    public function render()
    {
        $cities=WorldTrait::countriesInfo($this->country);

        $qualifications = Qualification::all();

        $jobs = Title::where('job_ar', 'like', '%' . $this->search . '%')->get();


        return view('livewire.create-admins', ['cities' =>  $cities[0]['cities'], 'jobs' => $jobs, 'qualifications' => $qualifications]);
    }
}


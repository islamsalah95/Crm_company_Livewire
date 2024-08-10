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

class UpdateAdmins extends Component
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
            'password' => ['nullable', Rules\Password::defaults()],
            'emp_photo_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // max:2048 means maximum file size is 2 MB
        ];
    }



    public function mount($user)
    {


        $this->id = $user['id'];
        $this->name = $user['name'];
        $this->emp_surname = $user['emp_surname'];
        $this->contact1 = $user['contact1'];
        $this->birthday = $user['birthday'];
        $this->employee_national_number = $user['employee_national_number'];
        $this->city_id = $user['city_id'];
        $this->title_id = $user['title_id'];
        $this->qualification_id = $user['qualification_id'];
        $this->email = $user['email'];
        $this->password = $user['password'];
        $this->emp_photo_file = $user['emp_photo_file'];
        $this->myJob = $user->title->job_ar;

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

        User::where('id', $this->id)
            ->update([
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

            'company_id' => 1, // Assuming you have a default company ID
            'department' => 1, // Assuming you have a default department ID
            'privacy_check' => 1, // Assuming the privacy check is always checked
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


        return view('livewire.update-admins', [
            'cities' =>$cities[0]['cities'],
             'jobs' => $jobs,
             'qualifications' => $qualifications]
            );
    }
}

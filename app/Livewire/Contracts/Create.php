<?php

namespace App\Livewire\Contracts;

use App\Models\User;
use Livewire\Component;
use App\Models\Contract;
use App\Services\UserService;
use App\Services\ContractService;
use Illuminate\Support\Facades\Auth;
use Exception;

class Create extends Component
{

    public $user;

    public $start_date;
    public $end_date;
    public $hourly_rate;
    public $working_hours_per_day;
    public $working_hours_per_week;
    public $working_hours;
    public $EstLaborOfficeId;
    public $EstSequenceNumber;
    public $is_molTWC;
    public $errorMessage;

    public function mount($user)
    {

    $this->user=$user;


    }

    protected function rules()
    {
        return [
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'hourly_rate' => ['required', 'integer', 'min:25'],
            'working_hours_per_day' => ['required', 'integer', 'max:12'],
            'working_hours_per_week' => ['required', 'integer', 'max:24'],
            'working_hours' => ['required', 'integer', 'max:95'],
            'EstLaborOfficeId' => ['required', 'integer'],
            'EstSequenceNumber' => ['required', 'integer'],
            'is_molTWC' => ['required', 'integer', 'in:0,1'],
        ];
    }


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveContact()
    {
        $array=[
            'company_id' => $this->user->company_id,
            'user_id' => $this->user->id,

             'start_date' => $this->start_date,
             'end_date' => $this->end_date,
             'hourly_rate' => $this->hourly_rate,
             'working_hours_per_day' => $this->working_hours_per_day,
             'working_hours_per_week' => $this->working_hours_per_week,
             'working_hours' => $this->working_hours,
             'EstLaborOfficeId' => $this->EstLaborOfficeId,
             'EstSequenceNumber' => $this->EstSequenceNumber,
             'is_molTWC' => $this->is_molTWC,

            'job_title' =>$this->user->title->id ,
            'created_by' => Auth::user()->id,
            'status_id' => 1,
        ];



        try {
            $ContractService=new ContractService(new Contract);
            $ContractService->store($array);
            User::where('id',$this->user->id)->update(['status'=>1]);
        } catch (Exception $e) {
            $this->errorMessage = $e;
            User::where('id', $this->user->id)->update(['status' => 0]);
            return;
        }

        session()->flash('message', 'contact successfully created.');
        $this->redirectRoute('crm.employ.main');

    }

    public function render()
    {

        return view('livewire.contracts.create');
    }
}

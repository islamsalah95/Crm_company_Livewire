<?php

namespace App\Livewire\Projects;

use App\Models\User;
use App\Models\Company;
use App\Models\Project;
use Livewire\Component;
use App\Services\ProjectService;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{

    public $select = [];
    public $project_name;
    public $project_type='public';
    public $start_date;
    public $end_date;
    public $company;

    public function createInstanceProject()
    {
      return new ProjectService(new Project() );
    }
    public function AuthCompanyId()
    {
        if (session()->has('AuthCompanyId')) {
            return session('AuthCompanyId');
           }else{
            return Auth::user()->company_id;
            }

    }

    protected function rules()
    {
        return [
            'select' => 'nullable|array',
            'select.*' => 'exists:users,id',
            'project_name' => 'required|string|max:191',
            'project_type' => 'required|in:public,none',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function showAssign()
    {
        return $this->project_type == 'public' ? 1 : 0;
    }

    public function save()
    {
        // dump($this->select);

        $this->validate();

        $array=[
            'project_name' => $this->project_name,
            'project_type' => $this->project_type,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'company_id' => $this->AuthCompanyId(),
        ];
        $this->createInstanceProject()->store($array ,$this->select);

        session()->flash('message', 'contact successfully created.');
    }


    public function render()
    {

        $companyUsers=Company::findOrfail($this->AuthCompanyId());
      
        $showAssign = $this->showAssign();

        return view('livewire.projects.create',[
        'companyUsers'=>$companyUsers->users,
        'showAssign'=>$showAssign
        ]);

    }
}

<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use App\Models\Company;
use App\Models\Project;
use Livewire\Component;
use App\Services\TaskService;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{

    public $name;
    public $project_id;
    public $user_id= [] ;
    public $start_date;
    public $end_date;
    public $company;
    public $type='public';

    public function createInstanceTask()
    {
      return new TaskService(new Task() );
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
            'name' => 'required|string|max:191',
            'project_id' => 'required|exists:projects,id',

            'user_id' => 'nullable|array',
            'user_id.*' => 'exists:users,id',
            'type' => 'required|in:public,private',
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
        return $this->type == 'public' ? 1 : 0;
    }

    public function save()
    {

        $this->validate();

        $array=[
            'name' => $this->name,
            'project_id' => $this->project_id,
            'type' => $this->type,
            'company_id' => $this->AuthCompanyId(),
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'user_id'=>$this->user_id
        ];

        //  dump($array);

        $this->createInstanceTask()->store($array);

        session()->flash('message', 'contact successfully created.');
    }


    public function render()
    {

        $companyUsers=Company::findOrfail($this->AuthCompanyId());
        $companyProjects=Project::where('company_id',$this->AuthCompanyId())->get();

        $showAssign = $this->showAssign();



        return view('livewire.tasks.create',[
        'companyUsers'=>$companyUsers->users,
        'companyProjects'=>$companyProjects,
        'showAssign'=>$showAssign
        ]);

    }



}

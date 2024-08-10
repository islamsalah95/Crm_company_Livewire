<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Services\TaskService;
use Illuminate\Support\Facades\Auth;

class Show extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;
    public $paginate=2;
    #[On('company-changed')]

   public function createInstanceTask()
   {
     return new TaskService(new Task() );
   }

   public function tasks()
   {
    return  $this->createInstanceTask()->tasks($this->AuthCompanyId(),$this->search,$this->paginate);

   }

   public function AuthCompanyId()
   {
       if (session()->has('AuthCompanyId')) {
           return session('AuthCompanyId');
          }else{
           return Auth::user()->company_id;
           }

   }


   public function delete($task)
   {
    $this->createInstanceTask()->destroy($task['id']);
    session()->flash('message', 'Task  successfully deleted.');
    $this->tasks();
   }

    public function render()
    {


        return view('livewire.tasks.show',['tasks'=>$this->tasks()]);
    }

}

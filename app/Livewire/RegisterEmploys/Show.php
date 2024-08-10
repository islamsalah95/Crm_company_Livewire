<?php

namespace App\Livewire\RegisterEmploys;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Services\UserService;
use App\Http\Resources\UserResource;

class Show extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search='';
    public $select=5;

    #[On('company-changed')]

    public function createInstanceUserService()
    {
            return new UserService(new User );

    }

    public function registerEmploys()
    {

        return $this->createInstanceUserService()->getUsersDepartmentSearch('3',$this->search,$this->select,0);


    }


    public function changeStatus(User  $user)
    {


        $this->createInstanceUserService()->block($user);

        session()->flash('message', 'Admin change Status updated.');

        $this->registerEmploys();
    }

    public function delete(User  $user)
    {


        $this->createInstanceUserService()->destroy($user);

        session()->flash('message', 'Admin deleted  success.');

        $this->registerEmploys();
    }




    public function render()
    {
        return view('livewire.register-employs.show', ['registerEmploys'=> $this->registerEmploys() ]);
    }
}

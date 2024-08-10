<?php

namespace App\Livewire\Employs;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Services\UserService;

class ShowEmploys extends Component
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

    public function employs()
    {

        return  $this->createInstanceUserService()->getUsersDepartmentSearch('3',$this->search,$this->select,1);

    }


    public function changeStatus(User  $user)
    {


        $this->createInstanceUserService()->block($user);

        session()->flash('message', 'Admin change Status updated.');

        $this->employs();
    }

    public function delete(User  $user)
    {


        $this->createInstanceUserService()->destroy($user);

        session()->flash('message', 'Admin deleted  success.');

        $this->employs();
    }




    public function render()
    {
        return view('livewire.employs.show-employs', ['employs'=> $this->employs()]);
    }
}

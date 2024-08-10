<?php

namespace App\Livewire\Admins;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Services\UserService;

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

    public function admins()
    {

        return  $this->createInstanceUserService()->getUsersDepartmentSearch('5',$this->search,$this->select);

    }


    public function changeStatus(User  $user)
    {


        $this->createInstanceUserService()->block($user);

        session()->flash('message', 'Admin change Status updated.');

        $this->admins();
    }

    public function delete(User  $user)
    {


        $this->createInstanceUserService()->destroy($user);

        session()->flash('message', 'Admin deleted  success.');

        $this->admins();
    }

    public function exportPDF()
    {


    }


    public function render()
    {

        return view( 'livewire.admins.show' , ['admins'=> $this->admins()] );
    }



}

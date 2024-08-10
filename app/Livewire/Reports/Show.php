<?php

namespace App\Livewire\Reports;

use App\Models\User;
use Livewire\Component;
use App\Models\Contract;
use Livewire\WithPagination;
use App\Services\UserService;
use App\Services\ShiftService;
use App\Services\ContractService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class Show extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;
    public $paginate = 5;

    #[On('company-changed')]

    public function createShiftService()
    {
        return  new ShiftService();
    }

    public function createInstanceUserService()
    {
            return new UserService(new User );

    }


    public function createInstanceContractService()
    {
            return new ContractService(new Contract );

    }


    public function employs()
    {


        $data = $this->createInstanceUserService()->getUsersDepartmentSearch('3',$this->search,$this->paginate,1);
        return $data;

    }

    public function reports()
    {
        $users=$this->employs();
        $users->map(function ($user) {
         if($this->createInstanceContractService()->expiration($user->id)){
            $user['report'] = $this->createShiftService()->totalContractHours($user);
            }else{
             $user['report']='';
                 }
            return $user;
        });

        return $users;
    }

      public function render()
      {
          return view('livewire.reports.show',
          [
              'reports' => $this->reports()
          ]);
      }

}

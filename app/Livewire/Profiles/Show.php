<?php

namespace App\Livewire\Profiles;

use Livewire\Component;
use App\Models\Contract;
use Livewire\WithPagination;
use App\Services\ShiftService;
use App\Services\ContractService;
use Illuminate\Support\Facades\Auth;

class Show extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $authUser;

  public function createInstanceContractService()
  {
    return new ContractService(new Contract() );
  }

  public function createShiftService()
  {
      return  new ShiftService();
  }

  public  function calculateSalary(string $time, float $hourlyRate): float
  {
      list($hours, $minutes, $seconds) = explode(':', $time);
      $totalHours = $hours + ($minutes / 60) + ($seconds / 3600);
      return round($totalHours * $hourlyRate, 2);
    }


    public function render()
    {

      $totalContractHours = $this->createShiftService()->totalContractHours($this->authUser);

        return view('livewire.profiles.show',[
          'contract'=>$this->createInstanceContractService()->userContract($this->authUser->id),
          'totalContractHours'=>$totalContractHours,
          'totalContractHoursSalary'=>$this->calculateSalary($totalContractHours['sumTimesPerContract'],$this->authUser->title->salary)
        ]);
    }
}

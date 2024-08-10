<?php

namespace App\Livewire\Profiles;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\ShiftService;
use Illuminate\Support\Facades\Auth;

class ReportTabel extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $authUser;
    public $search;
    public $paginate = 5;
    public $startDate='';
    public $endDate='';
    public $select;

    public $startFrom;
    public $endFrom;

    public function mount(){
        $this->startFrom = Carbon::today()->format('Y-m-d');
        $this->endFrom = Carbon::today()->format('Y-m-d');
    }

    public function createShiftService()
    {
        return  new ShiftService();
    }

    public function changeStartAndEnd()
    {


        $this->startDate =  $this->startFrom;
        // $this->endDate   = $this->endFrom;
        $carbonDateEndFrom = Carbon::parse( $this->endFrom)->addDay();
        $this->endDate   = $carbonDateEndFrom->format('Y-m-d');

    }

    public function changeTime()
    {
        if($this->select == 'today'){
            $this->startDate=Carbon::today() ;
        }else if($this->select == 'weekly'){
            $this->startDate =Carbon::now()->startOfWeek(Carbon::SUNDAY)->format('Y-m-d');
            $this->endDate =  Carbon::now()->endOfWeek(Carbon::THURSDAY)->format('Y-m-d');
        }
        else if($this->select == 'monthly'){
            $this->startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
            $this->endDate   = Carbon::now()->endOfMonth()->format('Y-m-d');
        }
        else{
            $this->startDate = '';
            $this->endDate   = '';
        }
    }



    public function shifts()
    {
        return  $this->createShiftService()->shifts(
            $this->authUser,
            $this->search,
            $this->paginate,
            $this->startDate,
            $this->endDate
        );
    }

      public function render()
      {


          return view('livewire.profiles.report-tabel',
          [
              'shifts' => $this->shifts()
          ]);
      }

}

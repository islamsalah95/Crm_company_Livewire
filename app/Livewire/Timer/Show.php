<?php

namespace App\Livewire\Timer;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use App\Models\Shift;
use App\Models\Project;
use Livewire\Component;
use App\Models\Contract;
use App\Models\Location;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Services\TaskService;
use App\Services\ShiftService;
use App\Services\ProjectService;
use Illuminate\Support\Facades\Auth;

class Show extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $selectProject;
    public $selectTask;
    public $startTime;
    public $endTime;
    public $runningTime; // Store the running time
    public $total;
    public $demo = false;
    public $search;
    public $paginate = 5;
    public $startDateSearch;
    public $endDateSearch;
    #[On('shift-created')]

    public function createShiftService()
    {
        return  new ShiftService();
    }

    public function createProjectsService()
    {
        return  new ProjectService(new Project());
    }

    public function createTasksService()
    {
        return  new TaskService(new Task());
    }


    public function projects()
    {
        $privates = Auth::user()->projects;
        return    $this->createProjectsService()->projectsUser($privates);
    }


    public function tasks()
    {

        $privates = Auth::user()->projects;
        return    $this->createTasksService()->tasksUser($privates,$this->selectProject);

    }


    public function shifts()
    {

        return  $this->createShiftService()->shifts(
            Auth::user(),
            $this->search,
            $this->paginate,
            Carbon::today(),
        );
    }

    public function isStarted()
    {
        return  $this->createShiftService()->isStarted() ;
    }


    protected function rules()
    {
        return [
            'selectProject' => 'required|exists:projects,id',
            'selectTask' => 'required|exists:tasks,id',
        ];
    }


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }



    public function start()
    {
        $this->validate();


        $expiration = $this->createShiftService()->expiration(Auth::user()->id);
        $totalContractHours = $this->createShiftService()->totalContractHours(Auth::user());

        if (!$totalContractHours['isTotalHoursLessThanPerContract']) {
            session()->flash('error', 'Total Hours Less Than Per Contract.');
        } else if (!$totalContractHours['isTotalHoursLessThanPerDay']) {
            session()->flash('error', 'Total Hours Less Than Per day.');
        } else if (!$totalContractHours['isTotalHoursLessThanPerWeek']) {
            session()->flash('error', 'Total Hours Less Than Per week.');
        } else if (!$expiration) {
            session()->flash('error', 'contact expiration end.');
        } else {
            $this->startTime = UnixTimeStampSeconds();
            Shift::create([
                'check_in' => $this->startTime,
                'check_out' => null,
                'check_out_time' => null,
                'user_id' => Auth::user()->id,
                'company_id' => $this->createShiftService()->AuthCompanyId(),
                'project_id' => $this->selectProject,
                'task_id' => $this->selectTask,
                'created_at' => Carbon::now(),
            ]);
            $this->demo = true;
            session()->flash('message', 'shift start successfully.');
        }
    }

    public function end()
    {
        $this->endTime = UnixTimeStampSeconds();
        $last = Shift::where('check_out', null)->where('user_id', Auth::user()->id)->where('company_id', $this->createShiftService()->AuthCompanyId())->first();

        $last->check_out = $this->endTime;
        $last->updated_at = Carbon::now();
        $last->save();

        $timeDifference = calculateTimeDifference($last->check_in, $last->check_out);
        $this->total = $timeDifference;
        $this->demo = false;
        session()->flash('message', 'shift end successfully.');
        $this->dispatch('shift-created');
    }

    #[On('location-created')]

    public function handleNewLocation($location)
    {
        Location::create([
            'latitude'=>$location['lat'],
            'longitude'=>$location['lng'],
            'ip'=>$location['ip'],
            'user_id'=>Auth::user()->id,
        ]);
    }



    public function render()
    {
            if($this->isStarted()){
            $this->dispatch('timer');
            }

        return view('livewire.timer.show', [
            'projects' => $this->projects(),
            'tasks' => $this->tasks(),
            'isStarted' => $this->isStarted(),
            'demo' => $this->demo,
            'shifts' => $this->shifts()

        ]);
    }
}

//*contract not expired
//*contract working hours not finish per contract
//*contract working hours not finish per day
//*must chick working hours employ for contract and if pass for day set only maximum day working hours

//1-all projects company employ related this employ done
//2-all tasks related pacific project
//3-store record chick in (start)
//4-select last record chick in  and set checkout (end)

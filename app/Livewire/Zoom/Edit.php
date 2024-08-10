<?php
namespace App\Livewire\Zoom;
use DateTime;
use DateTimeZone;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Timezone;
use Livewire\WithPagination;
use App\Services\UserService;
use App\Services\ZoomService;
use App\Services\ZoomApiService;

class Edit extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $topic;
    public $start_time;
    public $duration;
    public $timezone;
    public $selectUsers = [];
    public $meeting;


    protected function rules()
    {
        return [
            'topic' => 'required|string|max:255',
            'start_time' => 'required|string',
            'duration' => 'required|integer',
            'timezone' => 'required|string',
        ];
    }

    private function convertToUTC($localTime, $timezone)
    {
        if (!timezone_open($timezone)) {
            throw new \InvalidArgumentException("Invalid timezone: $timezone");
        }

        $date = new DateTime($localTime, new DateTimeZone($timezone));
        $date->setTimezone(new DateTimeZone('UTC'));
        return $date->format('Y-m-d\TH:i:s\Z');
    }

    public function addTodo($todo)
    {
        if (in_array($todo, $this->selectUsers)) {
            $index = array_search($todo, $this->selectUsers);
            unset($this->selectUsers[$index]);
        } else {
            $this->selectUsers[] = $todo;
        }
    }

    public function getUsers()
    {
        $users=[];
        foreach ($this->meeting['users'] as $key => $value) {
            $users[]=$value['id'];
        }
        return  $users;
    }




    public function store()
    {

        $this->validate();


        // Convert local time to UTC
        $localTime = $this->start_time;
        $timezone  = $this->timezone;
        $utcTime = $this->convertToUTC($localTime,$timezone );

        try {
            $data = [
                'topic' => $this->topic,
                'type' => 2,
                'start_time' => $utcTime ,
                'duration' => $this->duration,
                'timezone' => $this->timezone,
            ];

            $ZoomApiService=new ZoomApiService();
            $ZoomApiService->updateMeeting($this->meeting['id'], $data );

            $ZoomService=new ZoomService();
            $ZoomService->updateMeeting($this->meeting['id'] , $data , $this->selectUsers);

            return redirect()->route('zoom.index')->with('success', 'Meeting updated successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function mount()
    {
        $this->topic = $this->meeting['topic'];
        $this->start_time = Carbon::parse($this->meeting['start_time'])->format('Y-m-d\TH:i');
        $this->duration = $this->meeting['duration'];
        $this->timezone = $this->meeting['timezone'];
        $this->selectUsers = $this->getUsers();
    }

    public function render()
    {



        $userService =new UserService();
        $users=$userService->usersCompany();
        $timezones=Timezone::all();

        return view('livewire.zoom.edit',[
            'users'    =>$users,
            'timezones'=>$timezones
        ]);
    }
}


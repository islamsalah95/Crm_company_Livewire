<?php

namespace App\Livewire\Zoom;

use DateTime;
use DateTimeZone;
use App\Models\User;
use Livewire\Component;
use App\Models\Timezone;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Services\UserService;
use App\Services\ZoomService;
use App\Services\ZoomApiService;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $topic;
    public $start_time;
    public $duration;
    public $timezone;
    public $status=1;
    public $selectUsers = [];


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

    public function AuthCompanyId()
    {
        if (session()->has('AuthCompanyId')) {
            return session('AuthCompanyId');
           }else{
            return Auth::user()->company_id;
            }

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

            $ZoomApiService = new ZoomApiService ();
            $meeting = $ZoomApiService->createMeeting($data);
            $meeting['company_id']=$this->AuthCompanyId();
            $meeting['status']=$this->status;
            $zoomService = new ZoomService ();
            $zoomService->createMeeting($meeting,$this->selectUsers);

            return redirect()->route('zoom.index')->with('success', 'Meeting created successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    #[On('company-changed')]


    public function render()
    {
        $userService =new UserService();
        $users=$userService->usersCompany();

        $timezones=Timezone::all();

        return view('livewire.zoom.create',['users'=>$users ,'timezones'=>$timezones]);
    }
}

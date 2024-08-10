<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use App\Models\User;
use App\Models\Zoom;
use GuzzleHttp\Client;
use App\Models\Timezone;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\ZoomService;
use App\Services\ZoomApiService;
use App\Http\Requests\StoreZoomRequest;
use App\Http\Requests\UpdateZoomRequest;

class ZoomController extends Controller
{
    protected $zoomApiService;
    protected $zoomService;
    protected $userService;

    public function __construct(ZoomApiService $zoomApiService ,ZoomService $zoomService ,UserService $userService)
    {
        $this->zoomApiService = $zoomApiService;
        $this->zoomService = $zoomService;
        $this->userService = $userService;

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

    public function access_tocken(Request $request)
    {
        try {
            $this->zoomApiService->getAccessToken($request->query('code'));
            return redirect()->route('zoom.index');
        } catch (\Throwable $th) {
            return redirect()->route('zoom.index')->with('error', 'Failed to obtain access token');
        }
    }

    public function index()
    {

       return $this->zoomApiService->index();

    }


    public function view($zoom)
    {
       $meeting = Zoom::with('users')->findOrFail($zoom);
       return view('crm.zoom.view',['zoom'=>$meeting]);

    }

    public function create()
    {



        return view('crm.zoom.create');
    }

    public function store(StoreZoomRequest $request)
    {
        // Convert local time to UTC
        $localTime = $request->input('start_time');
        $timezone = $request->input('timezone');
        $utcTime = $this->convertToUTC($localTime,$timezone );

        try {
            $data = [
                'topic' => $request->topic,
                'type' => 2,
                'start_time' => $utcTime ,
                'duration' => $request->duration,
                'timezone' => $request->timezone,
            ];

            $meeting = $this->zoomApiService->createMeeting($data);
            $this->zoomService->createMeeting($meeting,$request->users);
            return redirect()->route('zoom.index')->with('success', 'Meeting created successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit($meetingId){
        $meeting=$this->zoomService->getMeeting($meetingId);
        return view('crm.zoom.edit',['meeting' => $meeting]);
    }


    public function update($meetingId,UpdateZoomRequest $request){

        // Convert local time to UTC
        $localTime = $request->input('start_time');
        $timezone = $request->input('timezone');
        $utcTime = $this->convertToUTC($localTime,$timezone );

        try {
            $data = [
                'topic' => $request->topic,
                'start_time' => $utcTime ,
                'duration' => $request->duration,
                'timezone' => $request->timezone,
            ];

            $this->zoomApiService->updateMeeting($meetingId, $data );
            $this->zoomService->updateMeeting($meetingId , $data , $request->users);
            return redirect()->route('zoom.index')->with('success', 'Meeting updated successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function delete($meetingId)
    {
        try {
            $this->zoomApiService->deleteMeeting($meetingId);
            return redirect()->route('zoom.index')->with('success', 'Meeting deleted successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }


    public function zoomUsers()
    {


        $publicUsers = $this->zoomService->zoomPublicUsers();
        $privateUsers = $this->zoomService->zoomPrivateUsers();

        $mergedUsers = $publicUsers->merge($privateUsers);

        return view('crm.zoom.users', [
            'meetings' => $mergedUsers,
        ]);

    }
}




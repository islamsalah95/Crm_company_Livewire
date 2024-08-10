<?php

namespace App\Services;

use App\Models\Zoom;
use Illuminate\Support\Facades\Auth;

class ZoomService {


    public function getMeetings() {
        return Zoom::with('users')->get();
    }

    public function createMeeting($data,$users) {

        $zoom = Zoom::create($data);
        $zoom->users()->attach($users);

    }

    public function getMeeting( $meetingId ) {
       return Zoom::with('users')->where('id',$meetingId)->first();
    }

    public function updateMeeting( $meetingId, $data ,$users ) {
        $zoom = Zoom::find($meetingId);
        $zoom->update($data);
        $zoom->users()->detach();
        $zoom->users()->attach($users);
    }

    public function deleteMeeting( $meetingId ) {
        Zoom::where('id',$meetingId)->delete();
    }


    public function AuthCompanyId()
    {
        if (session()->has('AuthCompanyId')) {
            return session('AuthCompanyId');
        } else {
            return Auth::user()->company_id;
        }
    }


    public function zoomPublicUsers()
    {
        return Zoom::where('company_id',$this->AuthCompanyId())->where('status',1)->get();

    }

    public function zoomPrivateUsers()
    {
        return Auth::user()->zooms;
    }
}

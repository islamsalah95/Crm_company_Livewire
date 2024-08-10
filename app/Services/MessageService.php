<?php

namespace App\Services;

use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreMessageRequest;




class MessageService
{


    public function AuthCompanyId()
    {
        if (session()->has('AuthCompanyId')) {
            return session('AuthCompanyId');
        } else {
            return Auth::user()->company_id;
        }
    }


    public function messages($me,$contact)
    {

        return Message::where('company_id', $this->AuthCompanyId())
        ->where(function ($query) use ($me, $contact) {
            $query->where('from_user_id', $me)->where('to_user_id', $contact)
                ->orWhere(function ($query) use ($me, $contact) {
                    $query->where('from_user_id', $contact)->where('to_user_id', $me);
                });
        })->get();

    }



    public function store(StoreMessageRequest $request)
    {
        $message=new Message();
        $message->message=$request->message;
        $message->from_user_id=$request->from_user_id;
        $message->to_user_id=$request->to_user_id;
        $message->company_id =$this->AuthCompanyId();
        $message->save();
        return  $message;
    }
}

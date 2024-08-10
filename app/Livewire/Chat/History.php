<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Services\MessageService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreMessageRequest;

class History extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';


    public $contact;
    public $myMessage;
    public $file;
    public $showNewOrderNotification = false;
    public $showEmploys = true;


    #[On('company-changed')]
    #[On('choese-contact')]
    #[On('message-sent')]
    #[On('echo:chat,PodcastChat')]




    public function createInstanceMessageService()
    {
            return new MessageService( );

    }

    public function getListeners()
    {
        return [
            "echo:chat,PodcastChat" => 'notifyNewOrder',
        ];
    }

    public function notifyNewOrder()
    {
        // dd('islam');
        $this->showNewOrderNotification = true;
    }

    public function getMessages()
    {
        if (session()->has('cat_with')) {
            $this->contact=session('cat_with')['id'];
            return  $this->createInstanceMessageService()->messages(Auth::user()->id,$this->contact);
           }else{
            return  [];
            }

    }

    public function render()
    {

        return view('livewire.chat.history',[
            'messages'=>$this-> getMessages()
        ]);
    }
}

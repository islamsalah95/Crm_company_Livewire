<?php

namespace App\Livewire\Chat;

use Pusher\Pusher;
use Livewire\Component;
use App\Events\PodcastChat;
use Livewire\WithPagination;
use App\Services\MessageService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreMessageRequest;
use Illuminate\Support\Facades\Event;

class SendMessage extends Component {
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $contact;
    public $message=[];
    public $file;



    public function createInstanceMessageService() {
        return new MessageService();

    }

    protected function rules() {
        return [
            'message' => 'required|string|max:191',
            'file' => 'nullable|file|max:2048',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function save() {

        $this->validate();

        $array = [
            'message'=> $this->message,
            'from_user_id'=>Auth::user()->id,
            'to_user_id'=> $this->contact,
        ];


        $this->createInstanceMessageService()->store(new StoreMessageRequest( $array ) );

        // Event::dispatch(new PodcastChat($array));


    }

    public function render() {

        if ( session()->has( 'cat_with') ) {
            $this->contact = session('cat_with')[ 'id' ];
        } else {
            return  [];
        }
        return view( 'livewire.chat.send-message',['contact'=>$this->contact] );
    }
}

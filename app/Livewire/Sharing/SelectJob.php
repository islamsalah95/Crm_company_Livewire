<?php

namespace App\Livewire\Sharing;

use App\Models\Title;
use Livewire\Component;

class SelectJob extends Component
{
    public $title_id;


    protected function rules()
    {
        return [
            'title_id' => ['required', 'exists:titles,id'],
        ];
    }


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function  jobChanged(){

        $this->dispatch('job-change', title_id: $this->title_id);
    }

    public function render()
    {
        return view('livewire.sharing.select-job',[
            'jobs' => Title::all(),
        ]);
    }


}

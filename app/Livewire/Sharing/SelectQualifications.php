<?php

namespace App\Livewire\Sharing;

use Livewire\Component;
use App\Models\Qualification;

class SelectQualifications extends Component
{

    public $qualification_id;


    protected function rules()
    {
        return [
            'qualification_id' => ['required', 'exists:qualifications,id'],
        ];
    }


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function  qualificationChanged(){

        $this->dispatch('qualification-change', qualification_id: $this->qualification_id);
    }

    public function render()
    {
        return view('livewire.sharing.select-qualifications',[
            'qualifications' =>Qualification::all()
        ]);
    }
}

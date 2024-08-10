<?php

namespace App\Livewire\Sharing;

use App\Models\Country;
use Livewire\Component;

class SelectCountry extends Component
{

    public $select;

    protected function rules()
    {
        return [
            'select' => ['required', 'exists:countries,id'],
        ];
    }


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function  countryChanged(){

        $this->dispatch('country-change', country: $this->select);
    }

    public function render()
    {
        return view('livewire.sharing.select-country',[
            'countries' => Country::all(),
        ]);
    }
}

<?php

namespace App\Livewire\Company;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;

class CompanySelect extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $select;

    public function mount()
    {
        if(session('AuthCompanyId')){
            $this->select=session('AuthCompanyId');
        }

    }

    public function change()
    {
        session(['AuthCompanyId' => $this->select]);
        session()->forget('cat_with');
        $this->dispatch('company-changed');

    }

    public function render()
    {

        return view('livewire.company.company-select',['companies'=>Company::all()]);
    }
}

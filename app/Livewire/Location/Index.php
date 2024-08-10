<?php

namespace App\Livewire\Location;

use Livewire\Component;
use App\Models\Location;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function delete($id)
    {
        $location = Location::find($id);
        $location->delete();
        session()->flash('message', 'Location Deleted Successfully.');
    }

    #[On('company-changed')]

    public function AuthCompanyId()
    {
        if (session()->has('AuthCompanyId')) {
            return session('AuthCompanyId');
           }else{
            return Auth::user()->company_id;
            }

    }


    public function render()
    {


        return view('livewire.location.index',['locations'=>
        Location::whereHas('user', function ($query) {
            $query->where('company_id', $this->AuthCompanyId());
        })->paginate(10)]);

    }
}

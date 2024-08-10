<?php

namespace App\Livewire\Chat;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class Contact extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;



    #[On('company-changed')]

    public function createInstanceUserService()
    {
            return new UserService(new User );

    }

    public function employs()
    {
        $employs=$this->createInstanceUserService()->getUsersDepartmentWithoutPagination(3,$this->search);
        return  $employs;

    }

    public function choese($employ)
    {
       session()->put('cat_with',User::find($employ['id']));
       $this->dispatch('choese-contact');

    }

    public function render()
    {


        return view('livewire.chat.contact',[
            'employs'=>$this->employs()
        ]);
    }
}

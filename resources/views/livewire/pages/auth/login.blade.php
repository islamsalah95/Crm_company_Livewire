<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Contract;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {



        $this->validate();


        $authUser=User::where('email',$this->form->email)->first();
        $contractUser=true;


        if($authUser && $authUser->department == 3 ){
           $isExist=Contract::where('user_id',$authUser->id)->exists();
             if(!$isExist){
                $contractUser=false;
             }
        }


        if ($authUser->status == 0 ) {
            $this->redirectRoute('error', ['error' => 'Unauthorized access. Waiting for admin approval.']);
        }
        else if($contractUser==false) {
            $this->redirectRoute('error', ['error' => 'Unauthorized access. Contract Expire call Admin.']);
        }
        else{

        $this->form->authenticate();
        Session::regenerate();

        if( Auth::user()->department ==3){
            $this->redirectRoute('crm.employ.main');
        }
        else{
            $this->redirectRoute('crmCompany');
        }
            }
    }
}; ?>

<form wire:submit.prevent="login" class="max-w-md mx-auto p-6 bg-white rounded-lg shadow-md">

    <!-- Email Address -->
    <div class="mb-4">
        <x-input-label for="email" :value="__('Email')" style="margin-right: 29px;" class="block text-gray-200 text-sm font-bold mb-2" />
        <x-text-input wire:model="form.email" id="email" class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" type="email" name="email" required autofocus autocomplete="username" />
        <x-input-error :messages="$errors->get('form.email')" class="mt-2 text-red-600" />
    </div>

    <!-- Password -->
    <div class="mb-4">
        <x-input-label for="password" :value="__('Password')" class="block text-gray-700 text-sm font-bold mb-2" />
        <x-text-input wire:model="form.password" id="password" class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" type="password" name="password" required autocomplete="current-password" />
        <x-input-error :messages="$errors->get('form.password')" class="mt-2 text-red-600" />
    </div>

    <!-- Remember Me -->
    <div class="mb-4 flex items-center">
        <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
        <label for="remember" class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</label>
    </div>

    <!-- Actions -->
    <div class="flex items-center justify-between">
        @if (Route::has('password.request'))
            <a class="text-sm text-gray-600 hover:text-gray-900 underline focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}" wire:navigate>
                {{ __('Forgot your password?') }}
            </a>
        @endif

        <x-primary-button style="background: cornflowerblue;" class="ml-3 bg-red hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            {{ __('Log in') }}
        </x-primary-button>
    </div>
</form>





@extends('layouts.crm')
@section('title')
Employ Profile
@endsection
@section('Content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">{{ translate('Profile')}}/</span>{{ translate('Show')}}</h4>

    @livewire('profiles.show',['authUser'=>$user])

@endsection

@extends('layouts.crm')
@section('title')
contracts create
@endsection
@section('Content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">{{ translate('Users/Employ')}}/</span>{{ translate('Create Contract')}}</h4>
<x-alert />


<div class="card">
    @livewire('contracts.create',['user'=>$user])
    
</div>

@endsection




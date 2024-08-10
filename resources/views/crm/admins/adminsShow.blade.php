@extends('layouts.crm')
@section('title')
Admins
@endsection
@section('Content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">{{ translate('Users')}}/</span>{{ translate('Admins')}}</h4>
<x-alert />


<div class="card">
    @livewire('admins.show')
</div>


@endsection

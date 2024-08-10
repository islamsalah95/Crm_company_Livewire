@extends('layouts.crm')
@section('title')
CRM Employ
@endsection
@section('Content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">{{ translate('CRM Employ')}}/</span>{{ translate('Start Working')}}</h4>
    @livewire('timer.show')
@endsection

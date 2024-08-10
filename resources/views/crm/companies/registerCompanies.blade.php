@extends('layouts.crm')
@section('title')
Company Register
@endsection
@section('Content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">{{ translate('Companies')}}/{{ translate('Register')}}</span>{{ translate('Show')}}</h4>
<div class="card">
    @livewire('company.show',['is_valid'=>'0','status'=>'1'])
</div>
@endsection




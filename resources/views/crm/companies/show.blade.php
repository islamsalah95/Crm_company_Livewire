@extends('layouts.crm')
@section('title')
Company Show
@endsection

@section('Content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">{{ translate('Companies') }}/</span>{{ translate('Show') }}</h4>
<div class="card">
    @livewire('company.show',['is_valid'=>1,'status'=>'1'])
</div>
@endsection




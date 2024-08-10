@extends('layouts.crm')

@section('title')
Meeting Edit
@endsection

@section('Content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">{{ translate('Meeting') }}/</span>{{ translate('Edit') }}</h4>
@livewire('zoom.edit',['meeting'=>$meeting])
@endsection

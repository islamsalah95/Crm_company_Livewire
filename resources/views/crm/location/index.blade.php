@extends('layouts.crm')
@section('title')
Location Show
@endsection

@section('Content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">{{ translate('Location') }}/</span>{{ translate('Show') }}</h4>
<div class="card">
    @livewire('location.index')
</div>
@endsection




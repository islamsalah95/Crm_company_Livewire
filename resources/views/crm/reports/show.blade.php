@extends('layouts.crm')
@section('title')
Employs Reports
@endsection
@section('Content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">{{ translate('Reports')}}/</span>{{ translate('Show')}}</h4>
<div class="card">
    @livewire('reports.show')
</div>
@endsection

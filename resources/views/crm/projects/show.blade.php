@extends('layouts.crm')
@section('title')
Projects Show
@endsection
@section('Content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">{{ translate('Projects')}}/</span>{{ translate('Show')}}</h4>
<div class="card">
    @livewire('projects.show')
</div>
@endsection

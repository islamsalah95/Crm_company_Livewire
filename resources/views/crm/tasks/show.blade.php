@extends('layouts.crm')
@section('title')
Tasks Show
@endsection
@section('Content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">{{ translate('Tasks')}}/</span>{{ translate('Show')}}</h4>
<div class="card">
    @livewire('tasks.show')
</div>
@endsection

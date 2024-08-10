@extends('layouts.crm')
@section('title')
show employs
@endsection
@section('Content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">{{ translate('Users')}}/</span>{{ translate('Employ')}}</h4>
<x-alert />


<div class="card">
    @livewire('employs.show-employs')
</div>




{{-- {{ $admins->links() }} --}}
@endsection

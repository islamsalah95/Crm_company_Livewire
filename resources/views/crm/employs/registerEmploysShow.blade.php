@extends('layouts.crm')
@section('title')
register employs
@endsection
@section('Content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">{{ translate('Users')}}/</span>{{ translate('Register Employ')}}</h4>
<x-alert />


<div class="card">
    @livewire('register-employs.show')
</div>




{{-- {{ $admins->links() }} --}}
@endsection

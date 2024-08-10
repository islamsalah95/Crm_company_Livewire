@extends('layouts.crm')
@section('title')
zoom Show
@endsection

@section('Content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">{{ translate('zoom') }}/</span>{{ translate('Show') }}</h4>

<div class="card mb-4">
    <div class="card-header">
        <h4 class="card-title">Zoom Meeting Details</h4>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md-4">
                <strong>ID:</strong>
            </div>
            <div class="col-md-8">
                {{ $zoom->id }}
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <strong>Host Email:</strong>
            </div>
            <div class="col-md-8">
                {{ $zoom->host_email }}
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <strong>Topic:</strong>
            </div>
            <div class="col-md-8">
                {{ $zoom->topic }}
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <strong>Duration:</strong>
            </div>
            <div class="col-md-8">
                {{ $zoom->duration }} minutes
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <strong>Timezone:</strong>
            </div>
            <div class="col-md-8">
                {{ $zoom->timezone }}
            </div>
        </div>
        @if($zoom->password)
        <div class="row mb-3">
            <div class="col-md-4">
                <strong>Password:</strong>
            </div>
            <div class="col-md-8">
                {{ $zoom->password }}
            </div>
        </div>
        @endif
        <div class="row mb-3">
            <div class="col-md-4">
                <strong>Created At:</strong>
            </div>
            <div class="col-md-8">
                {{ $zoom->created_at }}
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <strong>Updated At:</strong>
            </div>
            <div class="col-md-8">
                {{ $zoom->updated_at }}
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <strong>Start Time:</strong>
            </div>
            <div class="col-md-8">
                {{ $zoom->start_time }}
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <strong>Start URL:</strong>
            </div>
            <div class="col-md-8">
                <a href="{{ $zoom->start_url }}" target="_blank">{{ $zoom->start_url }}</a>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <strong>Join URL:</strong>
            </div>
            <div class="col-md-8">
                <a href="{{ $zoom->join_url }}" target="_blank">{{ $zoom->join_url }}</a>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <strong>Assign Users</strong>
            </div>
            <div class="col-md-8">
                <ul>
              @foreach ($zoom->users as $item)
                <li>
               Name: {{ $item['name']  }} - Email : {{ $item['email'] }}
                </li>
              @endforeach
            </ul>

            </div>
        </div>

    </div>
</div>


@endsection




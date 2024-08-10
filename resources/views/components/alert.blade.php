@if (Session::has('success'))
<div class="alert alert-success">
    {{ Session::get('success') }}
</div>
@endif

<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
</div>

@if (Session::has('error'))
<div class="alert alert-success">
    {{ Session::get('error') }}
</div>
@endif



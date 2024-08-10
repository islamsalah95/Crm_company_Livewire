@extends('layouts.crm')

@section('Content')

    <!-- Error -->
    <div class="container-xxl container-p-y">
      <div class="misc-wrapper">
        <h2 class="mb-1 mt-4">Page Not Found :</h2>
        <p class="mb-4 mx-2">{{ $error }}</p>
        <a href="{{ route('login') }}" class="btn btn-primary mb-4">Back to login</a>

        <div class="mt-4">
          <img
            src="../../assets/img/illustrations/page-misc-error.png"
            alt="page-misc-error"
            width="225"
            class="img-fluid" />
        </div>
      </div>
    </div>
    <!-- /Error -->

@endsection




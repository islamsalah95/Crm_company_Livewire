@extends('layouts.crm')
@section('title')
Location Show
@endsection
@push('css')
<style>

    #map {
      height: 100%;
    }


    html,
    body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
  </style>
  @endpush

@section('Content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">{{ translate('Location') }}/</span>{{ translate('Show') }}</h4>
{{--  <div class="leaflet-map" id="userLocation"></div>  --}}

<div class="leaflet-map" id="layerControl"></div>


@endsection



@section('links')

<!-- Favicon -->
<link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico" />

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
  href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
  rel="stylesheet" />

<!-- Icons -->
<link rel="stylesheet" href="../../assets/vendor/fonts/fontawesome.css" />
<link rel="stylesheet" href="../../assets/vendor/fonts/tabler-icons.css" />
<link rel="stylesheet" href="../../assets/vendor/fonts/flag-icons.css" />

<!-- Core CSS -->
<link rel="stylesheet" href="../../assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
<link rel="stylesheet" href="../../assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
<link rel="stylesheet" href="../../assets/css/demo.css" />

<!-- Vendors CSS -->
<link rel="stylesheet" href="../../assets/vendor/libs/node-waves/node-waves.css" />
<link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
<link rel="stylesheet" href="../../assets/vendor/libs/typeahead-js/typeahead.css" />
<link rel="stylesheet" href="../../assets/vendor/libs/leaflet/leaflet.css" />
@endsection


@section('scriptsHead')
<!-- Helpers -->
<script src="../../assets/vendor/js/helpers.js"></script>
<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
<!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
<script src="../../assets/vendor/js/template-customizer.js"></script>
<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
<script src="../../assets/js/config.js"></script>
@endsection


@section('scripts')
<script src="../../assets/vendor/libs/jquery/jquery.js"></script>
<script src="../../assets/vendor/libs/popper/popper.js"></script>
<script src="../../assets/vendor/js/bootstrap.js"></script>
<script src="../../assets/vendor/libs/node-waves/node-waves.js"></script>
<script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="../../assets/vendor/libs/hammer/hammer.js"></script>
<script src="../../assets/vendor/libs/i18n/i18n.js"></script>
<script src="../../assets/vendor/libs/typeahead-js/typeahead.js"></script>
<script src="../../assets/vendor/js/menu.js"></script>

<!-- endbuild -->

<!-- Vendors JS -->
<script src="../../assets/vendor/libs/leaflet/leaflet.js"></script>

<!-- Main JS -->
<script src="../../assets/js/main.js"></script>

<!-- Page JS -->

@endsection
@push('js')
     <script>
        const loca = @json($location);
        console.log(loca);

        const littleton = L.marker([loca.latitude, loca.longitude]).bindPopup('This is Littleton, CO.'),
        denver = L.marker([39.74, -104.99]).bindPopup('This is Denver, CO.'),
        aurora = L.marker([39.73, -104.8]).bindPopup('This is Aurora, CO.'),
        golden = L.marker([39.77, -105.23]).bindPopup('This is Golden, CO.');
      const cities = L.layerGroup([littleton, denver, aurora, golden]);
      const street = L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {
          attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>',
          maxZoom: 18
        }),
        watercolor = L.tileLayer('http://tile.stamen.com/watercolor/{z}/{x}/{y}.jpg', {
          attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>',
          maxZoom: 18
        });
      const layerControl = L.map('layerControl', {
        center: [loca.latitude, loca.longitude],
        zoom: 10,
        layers: [street, cities]
      });
      const baseMaps = {
        Street: street,
        Watercolor: watercolor
      };
      const overlayMaps = {
        Cities: cities
      };
      L.control.layers(baseMaps, overlayMaps).addTo(layerControl);
      L.tileLayer('https://c.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>',
        maxZoom: 18
      }).addTo(layerControl);
    </script>
@endpush
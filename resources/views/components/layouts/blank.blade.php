<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <?php $dir='/gp/public/';?>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Adds MIS</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{$dir}}plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{$dir}}dist/css/adminlte.min.css">
  @livewireStyles
  @stack('messtyles') 
  </head>
  <body>
     
<div id="map"></div>
<div style="padding:30px">
{{$slot}}</div>
       @livewire('lamodal')
@livewireScripts
   <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    
  @stack('messcripts') 
  </body>
  </html>
{{-- Шаблон BLADE
@php
    dd(Auth::user()->name);
@endphp
--}}
@extends('layouts.header.head')

@section('head')

<!-- menublock -->
@include('layouts.header.menublock')
<!-- menublock /- -->

<!-- body.carousel -->
@include('layouts.body.carousel')
<!-- body.carousel /- -->

<!-- body.category -->
@include('layouts.body.category')
<!-- body.category /- -->

<!-- body.featureproduct -->
@include('layouts.body.featureproduct')
<!-- body.featureproduct /- -->

<!-- body.latestfromourblog -->
@include('layouts.body.latestfromourblog')
<!-- body.latestfromourblog /- -->

<!-- body.contactformdetails -->
{{--@include('layouts.body.contactformdetails')--}}
<!-- body.contactformdetails /- -->

@include('layouts.footer.footer')

@endsection

{{----}}

@extends('layouts.app')

@section('title', 'PulpCo - Sustaining Nature, Crafting Paper')

@section('content')
    @include('components.hero')
    @include('components.our_company')
    @include('components.products')
    @include('components.sustainability')
    @include('components.news')
    @include('components.biodiversity')
    @include('components.portals')
@endsection
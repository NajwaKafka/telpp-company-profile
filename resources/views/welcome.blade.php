@extends('layouts.app')

@section('title', 'PulpCo - Sustaining Nature, Crafting Paper')

@section('content')
    <div class="reveal-hidden">
        @include('components.hero')
    </div>
    <div class="reveal-hidden">
        @include('components.our_company')
    </div>
    <div class="reveal-hidden">
        @include('components.products')
    </div>
    <div class="reveal-hidden">
        @include('components.news')
    </div>
@endsection
@extends('layouts.app')
@section('title', 'PulpCo - Sustaining Nature, Crafting Paper')

@section('content')
  @include('components.news.news', ['data' => $data])
@endsection
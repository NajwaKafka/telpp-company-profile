@extends('layouts.app')

@section('content')

<h2 class="mb-4">New Release</h2>

@isset($category)
    <h4>Category: {{ $category->name }}</h4>
@endisset

@foreach($news as $item)
    <div class="card mb-3 p-3">
        <h5>{{ $item->title }}</h5>
        <p>{{ $item->content }}</p>
    </div>
@endforeach

@endsection
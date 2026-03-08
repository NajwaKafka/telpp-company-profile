@extends('layouts.app')

@section('content')

<div class="text-center mb-5">
    <h2 class="fw-bold">Our Company</h2>
    <p class="text-muted">Learn more about who we are</p>
</div>

<div class="row">
@foreach($data as $item)
    <div class="col-md-6 mb-4">
        <div class="card p-4">
            <h4 class="fw-bold text-primary">{{ $item->title }}</h4>
            <p class="text-muted mt-3">{{ $item->description }}</p>
        </div>
    </div>
@endforeach
</div>

@endsection
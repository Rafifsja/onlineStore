@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="card">
    <div class="card-header">
        Purchase Complete!
    </div>
    <div class="card-body">
        <p>Thank you for your purchase!</p>
        <p>Order ID: {{ $viewData["order"]->getId() }}</p>
        <p>Total: ${{ $viewData["order"]->getTotal() }}</p>
        <a href="{{ route('home.index') }}" class="btn bg-primary text-white">Go to Home</a>
    </div>
</div>
@endsection
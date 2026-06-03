@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="card mb-3">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="{{ asset('/storage/'.$viewData["product"]->getImage()) }}" class="img-fluid rounded-start">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">
                    {{ $viewData["product"]->getName() }} (${{ $viewData["product"]->getPrice() }})
                </h5>
                <p class="card-text">{{ $viewData["product"]->getDescription() }}</p>
                @auth
                <form method="POST" action="{{ route('cart.add', ['id' => $viewData['product']->getId()]) }}">
                    @csrf
                    <div class="row">
                        <div class="col-3">
                            <input type="number" name="quantity" value="1" min="1" class="form-control">
                        </div>
                        <div class="col-3">
                            <button type="submit" class="btn bg-primary text-white">Add to Cart</button>
                        </div>
                    </div>
                </form>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection
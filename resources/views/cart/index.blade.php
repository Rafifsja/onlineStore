@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="card">
    <div class="card-header">
        Shopping Cart
    </div>
    <div class="card-body">
        @if(empty($viewData["products"]))
        <p>Your cart is empty.</p>
        @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0 @endphp
                @foreach ($viewData["products"] as $product)
                @php $total += $product["price"] * $product["quantity"] @endphp
                <tr>
                    <td>
                        <img src="{{ asset('/storage/'.$product["image"]) }}" width="60">
                    </td>
                    <td>{{ $product["name"] }}</td>
                    <td>${{ $product["price"] }}</td>
                    <td>{{ $product["quantity"] }}</td>
                    <td>${{ $product["price"] * $product["quantity"] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <p><strong>Total: ${{ $total }}</strong></p>
        <a href="{{ route('cart.purchase') }}" class="btn btn-success">Purchase</a>
        <a href="{{ route('cart.delete') }}" class="btn btn-danger">Clear Cart</a>
        @endif
    </div>
</div>
@endsection
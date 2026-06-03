@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="card">
    <div class="card-header">
        My Orders
    </div>
    <div class="card-body">
        @forelse($viewData["orders"] as $order)
        <div class="card mb-3">
            <div class="card-header">
                Order ID: {{ $order->getId() }} |
                Total: ${{ $order->getTotal() }} |
                Date: {{ $order->getCreatedAt() }}
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product->getName() }}</td>
                            <td>${{ $item->getPrice() }}</td>
                            <td>{{ $item->getQuantity() }}</td>
                            <td>${{ $item->getPrice() * $item->getQuantity() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @empty
        <p>You have no orders yet.</p>
        @endforelse
    </div>
</div>
@endsection
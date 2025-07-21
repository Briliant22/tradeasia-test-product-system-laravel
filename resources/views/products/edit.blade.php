@extends('layouts.app')

@section('content')
    <div class="container py-4 bg-dark text-light">
        <h1>Edit Product</h1>
        <a href="{{ route('products.index') }}" class="btn btn-secondary my-3">← Back</a>

        @include('products.form', ['action' => route('products.update', $product), 'method' => 'PUT', 'product' => $product])
    </div>
@endsection

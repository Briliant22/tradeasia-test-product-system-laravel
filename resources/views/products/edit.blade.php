@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Product</h1>
        <a href="{{ route('products.index') }}" class="btn btn-secondary mb-3">← Back</a>

        @include('products.form', ['action' => route('products.update', $product), 'method' => 'PUT', 'product' => $product])
    </div>
@endsection
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add New Product</h1>
        <a href="{{ route('products.index') }}" class="btn btn-secondary mb-3">← Back</a>

        @include('products.form', ['action' => route('products.store'), 'method' => 'POST', 'product' => null])
    </div>
@endsection

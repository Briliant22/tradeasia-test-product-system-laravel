@extends('layouts.app')

@section('content')
    @php
        $lang = request()->get('lang', 'en');

        $labels = [
            'en' => [
                'name' => 'Name',
                'hs_code' => 'HS Code',
                'cas_number' => 'CAS Number',
                'description' => 'Description',
                'application' => 'Application',
                'meta_title' => 'Meta Title',
                'meta_keywords' => 'Meta Keywords',
                'meta_description' => 'Meta Description',
                'actions' => 'Actions',
            ],
            'id' => [
                'name' => 'Nama',
                'hs_code' => 'Kode HS',
                'cas_number' => 'Nomor CAS',
                'description' => 'Deskripsi',
                'application' => 'Aplikasi',
                'meta_title' => 'Judul Meta',
                'meta_keywords' => 'Kata Kunci Meta',
                'meta_description' => 'Deskripsi Meta',
                'actions' => 'Aksi',
            ]
        ];
    @endphp

    <div class="container py-4 bg-dark text-light">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="display-5 fw-bold">
                Product List ({{ strtoupper($lang) }})
            </h1>

            <div class="d-flex gap-2">
                <a href="{{ route('products.create') }}" class="btn btn-success">
                    + Add New Product
                </a>

                <a href="{{ route('products.index', ['lang' => $lang === 'en' ? 'id' : 'en']) }}"
                    class="btn btn-outline-secondary">
                    Switch to {{ $lang === 'en' ? 'Bahasa Indonesia' : 'English' }}
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover text-{{ $lang === 'en' ? 'dark' : 'light' }}">
                <thead class="table-dark">
                    <tr>
                        <th>{{ $labels[$lang]['name'] }}</th>
                        <th>{{ $labels[$lang]['hs_code'] }}</th>
                        <th>{{ $labels[$lang]['cas_number'] }}</th>
                        <th>{{ $labels[$lang]['description'] }}</th>
                        <th>{{ $labels[$lang]['application'] }}</th>
                        <th>{{ $labels[$lang]['meta_title'] }}</th>
                        <th>{{ $labels[$lang]['meta_keywords'] }}</th>
                        <th>{{ $labels[$lang]['meta_description'] }}</th>
                        <th>{{ $labels[$lang]['actions'] }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>{{ $product->name[$lang] ?? '-' }}</td>
                            <td>{{ $product->hs_code }}</td>
                            <td>{{ $product->cas_number }}</td>
                            <td>{{ $product->description[$lang] ?? '-' }}</td>
                            <td>{{ $product->application[$lang] ?? '-' }}</td>
                            <td>{{ $product->meta_title[$lang] ?? '-' }}</td>
                            <td>{{ $product->meta_keyword[$lang] ?? '-' }}</td>
                            <td>{{ $product->meta_description[$lang] ?? '-' }}</td>
                            <td>
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning mb-1">Edit</a>

                                <form action="{{ route('products.destroy', $product) }}" method="POST"
                                    style="display:inline-block;" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

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
                'edit' => 'Edit',
                'delete' => 'Delete',
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
                'edit' => 'Edit',
                'delete' => 'Hapus',
            ]
        ];
    @endphp

    <div class="container-fluid py-4 bg-dark text-light">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="display-5 fw-bold">
                Product List
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
                        <th>{{ $labels[$lang]['meta_title'] }}</th>
                        <th>{{ $labels[$lang]['meta_keywords'] }}</th>
                        <th>Detail</th>
                        <th>{{ $labels[$lang]['edit'] }}</th>
                        <th>{{ $labels[$lang]['delete'] }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>{{ $product->name[$lang] ?? '-' }}</td>
                            <td>{{ $product->hs_code }}</td>
                            <td>{{ $product->cas_number }}</td>
                            <td>{{ $product->meta_title[$lang] ?? '-' }}</td>
                            <td>{{ $product->meta_keyword[$lang] ?? '-' }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                    data-bs-target="#detailModal{{ $product->id }}">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </td>
                            <td>
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning mb-1">Edit</a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger"
                                    onclick="showDeleteModal({{ $product->id }})" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Detail Modal -->
                        <div class="modal fade" id="detailModal{{ $product->id }}" tabindex="-1"
                            aria-labelledby="detailModalLabel{{ $product->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content bg-dark text-light">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="detailModalLabel{{ $product->id }}">Product Detail</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @if($product->image)
                                            <div class="d-flex justify-content-center mb-4">
                                                <img src="{{ asset('storage/' . $product->image) }}"
                                                    class="img-thumbnail"
                                                    style="max-width: 400px; width: 100%; height: auto;">
                                            </div>
                                        @endif
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item bg-dark text-light">
                                                <strong>{{ $labels[$lang]['name'] }}:</strong>
                                                {{ $product->name[$lang] ?? '-' }}</li>
                                            <li class="list-group-item bg-dark text-light">
                                                <strong>{{ $labels[$lang]['hs_code'] }}:</strong> {{ $product->hs_code }}</li>
                                            <li class="list-group-item bg-dark text-light">
                                                <strong>{{ $labels[$lang]['cas_number'] }}:</strong> {{ $product->cas_number }}
                                            </li>
                                            <li class="list-group-item bg-dark text-light">
                                                <strong>{{ $labels[$lang]['description'] }}:</strong>
                                                {{ $product->description[$lang] ?? '-' }}</li>
                                            <li class="list-group-item bg-dark text-light">
                                                <strong>{{ $labels[$lang]['application'] }}:</strong>
                                                {{ $product->application[$lang] ?? '-' }}</li>
                                            <li class="list-group-item bg-dark text-light">
                                                <strong>{{ $labels[$lang]['meta_title'] }}:</strong>
                                                {{ $product->meta_title[$lang] ?? '-' }}</li>
                                            <li class="list-group-item bg-dark text-light">
                                                <strong>{{ $labels[$lang]['meta_keywords'] }}:</strong>
                                                {{ $product->meta_keyword[$lang] ?? '-' }}</li>
                                            <li class="list-group-item bg-dark text-light">
                                                <strong>{{ $labels[$lang]['meta_description'] }}:</strong>
                                                {{ $product->meta_description[$lang] ?? '-' }}</li>
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @empty
                        <tr>
                            <td colspan="10" class="text-center">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content bg-dark text-light">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this product?
                    </div>
                    <div class="modal-footer">
                        <form id="deleteForm" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Yes, Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDeleteModal(productId) {
            const form = document.getElementById('deleteForm');
            const action = "{{ url('products') }}/" + productId;
            form.action = action;

            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        }
    </script>

@endsection

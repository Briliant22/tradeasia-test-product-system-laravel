<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($method === 'PUT')
        @method('PUT')
    @endif

    <!-- Name EN -->
    <div class="mb-3">
        <label>Name (EN)</label>
        <input type="text" name="name[en]" class="form-control @error('name.en') is-invalid @enderror"
            value="{{ old('name.en', $product->name['en'] ?? '') }}" required>
        @error('name.en')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Name ID -->
    <div class="mb-3">
        <label>Name (ID)</label>
        <input type="text" name="name[id]" class="form-control @error('name.id') is-invalid @enderror"
            value="{{ old('name.id', $product->name['id'] ?? '') }}" required>
        @error('name.id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- HS Code -->
    <div class="mb-3">
        <label>HS Code</label>
        <input type="text" name="hs_code" class="form-control @error('hs_code') is-invalid @enderror"
            value="{{ old('hs_code', $product->hs_code ?? '') }}" required>
        @error('hs_code')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- CAS Number -->
    <div class="mb-3">
        <label>CAS Number</label>
        <input type="text" name="cas_number" class="form-control @error('cas_number') is-invalid @enderror"
            value="{{ old('cas_number', $product->cas_number ?? '') }}" required>
        @error('cas_number')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Image -->
    <div class="mb-3">
        <label>Image</label>
        @if(isset($product) && $product->image)
            <div>
                <img src="{{ asset('storage/' . $product->image) }}" width="150" class="mb-2">
            </div>
        @endif
        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
        @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Description EN -->
    <div class="mb-3">
        <label>Description (EN)</label>
        <textarea name="description[en]" class="form-control @error('description.en') is-invalid @enderror"
            required>{{ old('description.en', $product->description['en'] ?? '') }}</textarea>
        @error('description.en')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Description ID -->
    <div class="mb-3">
        <label>Description (ID)</label>
        <textarea name="description[id]" class="form-control @error('description.id') is-invalid @enderror"
            required>{{ old('description.id', $product->description['id'] ?? '') }}</textarea>
        @error('description.id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Application EN -->
    <div class="mb-3">
        <label>Application (EN)</label>
        <textarea name="application[en]" class="form-control @error('application.en') is-invalid @enderror"
            required>{{ old('application.en', $product->application['en'] ?? '') }}</textarea>
        @error('application.en')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Application ID -->
    <div class="mb-3">
        <label>Application (ID)</label>
        <textarea name="application[id]" class="form-control @error('application.id') is-invalid @enderror"
            required>{{ old('application.id', $product->application['id'] ?? '') }}</textarea>
        @error('application.id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Meta Title EN -->
    <div class="mb-3">
        <label>Meta Title (EN)</label>
        <input type="text" name="meta_title[en]" class="form-control @error('meta_title.en') is-invalid @enderror"
            value="{{ old('meta_title.en', $product->meta_title['en'] ?? '') }}">
        @error('meta_title.en')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Meta Title ID -->
    <div class="mb-3">
        <label>Meta Title (ID)</label>
        <input type="text" name="meta_title[id]" class="form-control @error('meta_title.id') is-invalid @enderror"
            value="{{ old('meta_title.id', $product->meta_title['id'] ?? '') }}">
        @error('meta_title.id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Meta Keyword EN -->
    <div class="mb-3">
        <label>Meta Keyword (EN)</label>
        <input type="text" name="meta_keyword[en]" class="form-control @error('meta_keyword.en') is-invalid @enderror"
            value="{{ old('meta_keyword.en', $product->meta_keyword['en'] ?? '') }}">
        @error('meta_keyword.en')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Meta Keyword ID -->
    <div class="mb-3">
        <label>Meta Keyword (ID)</label>
        <input type="text" name="meta_keyword[id]" class="form-control @error('meta_keyword.id') is-invalid @enderror"
            value="{{ old('meta_keyword.id', $product->meta_keyword['id'] ?? '') }}">
        @error('meta_keyword.id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Meta Description EN -->
    <div class="mb-3">
        <label>Meta Description (EN)</label>
        <textarea name="meta_description[en]"
            class="form-control @error('meta_description.en') is-invalid @enderror">{{ old('meta_description.en', $product->meta_description['en'] ?? '') }}</textarea>
        @error('meta_description.en')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Meta Description ID -->
    <div class="mb-3">
        <label>Meta Description (ID)</label>
        <textarea name="meta_description[id]"
            class="form-control @error('meta_description.id') is-invalid @enderror">{{ old('meta_description.id', $product->meta_description['id'] ?? '') }}</textarea>
        @error('meta_description.id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button class="btn btn-success" type="submit">Save</button>
</form>
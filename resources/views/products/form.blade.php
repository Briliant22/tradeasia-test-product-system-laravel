<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($method === 'PUT')
        @method('PUT')
    @endif

    <div class="mb-3">
        <label>Name (EN)</label>
        <input type="text" name="name[en]" class="form-control" value="{{ old('name.en', $product->name['en'] ?? '') }}"
            required>
    </div>

    <div class="mb-3">
        <label>Name (ID)</label>
        <input type="text" name="name[id]" class="form-control" value="{{ old('name.id', $product->name['id'] ?? '') }}"
            required>
    </div>

    <div class="mb-3">
        <label>HS Code</label>
        <input type="text" name="hs_code" class="form-control" value="{{ old('hs_code', $product->hs_code ?? '') }}"
            required>
    </div>

    <div class="mb-3">
        <label>CAS Number</label>
        <input type="text" name="cas_number" class="form-control"
            value="{{ old('cas_number', $product->cas_number ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label>Image</label>
        @if(isset($product) && $product->image)
            <div>
                <img src="{{ asset('storage/' . $product->image) }}" width="150" class="mb-2">
            </div>
        @endif
        <input type="file" name="image" class="form-control">
    </div>

    <div class="mb-3">
        <label>Description (EN)</label>
        <textarea name="description[en]" class="form-control"
            required>{{ old('description.en', $product->description['en'] ?? '') }}</textarea>
    </div>

    <div class="mb-3">
        <label>Description (ID)</label>
        <textarea name="description[id]" class="form-control"
            required>{{ old('description.id', $product->description['id'] ?? '') }}</textarea>
    </div>

    <div class="mb-3">
        <label>Application (EN)</label>
        <textarea name="application[en]" class="form-control"
            required>{{ old('application.en', $product->application['en'] ?? '') }}</textarea>
    </div>

    <div class="mb-3">
        <label>Application (ID)</label>
        <textarea name="application[id]" class="form-control"
            required>{{ old('application.id', $product->application['id'] ?? '') }}</textarea>
    </div>

    <div class="mb-3">
        <label>Meta Title (EN)</label>
        <input type="text" name="meta_title[en]" class="form-control"
            value="{{ old('meta_title.en', $product->meta_title['en'] ?? '') }}">
    </div>

    <div class="mb-3">
        <label>Meta Title (ID)</label>
        <input type="text" name="meta_title[id]" class="form-control"
            value="{{ old('meta_title.id', $product->meta_title['id'] ?? '') }}">
    </div>

    <div class="mb-3">
        <label>Meta Keyword (EN)</label>
        <input type="text" name="meta_keyword[en]" class="form-control"
            value="{{ old('meta_keyword.en', $product->meta_keyword['en'] ?? '') }}">
    </div>

    <div class="mb-3">
        <label>Meta Keyword (ID)</label>
        <input type="text" name="meta_keyword[id]" class="form-control"
            value="{{ old('meta_keyword.id', $product->meta_keyword['id'] ?? '') }}">
    </div>

    <div class="mb-3">
        <label>Meta Description (EN)</label>
        <textarea name="meta_description[en]"
            class="form-control">{{ old('meta_description.en', $product->meta_description['en'] ?? '') }}</textarea>
    </div>

    <div class="mb-3">
        <label>Meta Description (ID)</label>
        <textarea name="meta_description[id]"
            class="form-control">{{ old('meta_description.id', $product->meta_description['id'] ?? '') }}</textarea>
    </div>

    <button class="btn btn-success" type="submit">Save</button>
</form>
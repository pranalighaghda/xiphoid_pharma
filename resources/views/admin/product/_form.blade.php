<form class="form-horizontal"
    action="{{ isset($product->id)
        ? route('admin.products.update', ['product_id' => $product->id])
        : route('admin.products.store') }}"
    enctype="multipart/form-data" method="post">

    @csrf
    @if (isset($product->id))
        @method('POST') {{-- adjust to PUT if needed --}}
    @endif

    <div class="pl-lg-4">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label class="form-control-label" for="category_id">Category</label>
                    <select class="form-control" name="category_id" id="category_id">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-div">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="form-control-label" for="name">Name</label>
                    <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}"
                        class="form-control" id="name" placeholder="Name">
                    @error('name')
                        <div class="invalid-div">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="form-control-label" for="composition">Composition</label>
                    <input type="text" name="composition" value="{{ old('composition', $product->composition ?? '') }}"
                        class="form-control" id="composition" placeholder="Composition">
                    @error('composition')
                        <div class="invalid-div">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="form-control-label" for="dosage_form">Dosage Form</label>
                    <input type="text" name="dosage_form" value="{{ old('dosage_form', $product->dosage_form ?? '') }}"
                        class="form-control" id="dosage_form" placeholder="Dosage Form">
                    @error('dosage_form')
                        <div class="invalid-div">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="form-control-label" for="pack_type">Pack Type</label>
                    <input type="text" name="pack_type" value="{{ old('pack_type', $product->pack_type ?? '') }}"
                        class="form-control" id="pack_type" placeholder="Pack Type">
                    @error('pack_type')
                        <div class="invalid-div">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="form-control-label" for="pack_style">Pack Style</label>
                    <input type="text" name="pack_style" value="{{ old('pack_style', $product->pack_style ?? '') }}"
                        class="form-control" id="pack_style" placeholder="Pack Style">
                    @error('pack_style')
                        <div class="invalid-div">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="form-control-label" for="strength">Strength</label>
                    <input type="text" name="strength" value="{{ old('strength', $product->strength ?? '') }}"
                        class="form-control" id="strength" placeholder="Strength">
                    @error('strength')
                        <div class="invalid-div">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Media Upload --}}
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label class="form-control-label" for="media">Media</label>
                    <div class="custom-file">
                        <input type="file" name="media" class="custom-file-input" id="media"
                            onchange="previewImage(event)">
                        <label class="custom-file-label" for="media">Select file</label>
                    </div>
                    @error('media')
                        <div class="invalid-div">{{ $message }}</div>
                    @enderror

                    <div class="mt-3 position-relative" id="media-preview-wrapper"
                        style="{{ !empty($product->media_url) ? 'display: block !important;' : 'display: none;' }}">
                        <img id="media-preview" src="{{ $product->media_url ?? '' }}" alt="Selected Media"
                            style="max-height: 200px;">
                        @if (!empty($product->media_id))
                            <button type="button" class="btn btn-sm btn-danger position-absolute"
                                style="top: 0; right: 0;"
                                onclick="deleteMedia({{ $product->media_id }}, '{{ url('admin/media') }}')">✖</button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="form-control-label" for="status">Status</label>
                    <select class="form-control" name="status" id="status">
                        <option value="1" {{ old('status', $product->status ?? 0) == 1 ? 'selected' : '' }}>Active
                        </option>
                        <option value="0" {{ old('status', $product->status ?? 0) == 0 ? 'selected' : '' }}>Inactive
                        </option>
                    </select>
                </div>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary mt-4">Save</button>
        </div>
    </div>
</form>

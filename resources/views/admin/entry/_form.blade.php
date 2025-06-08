<form class="form-horizontal"
    action="{{ isset($entry->id)
        ? route('admin.pages.sections.entries.update', [
            'page_id' => $page->id,
            'section_id' => $section->id,
            'entry_id' => $entry->id,
        ])
        : route('admin.pages.sections.entries.store', ['page_id' => $page->id, 'section_id' => $section->id]) }}"
    enctype="multipart/form-data" method="post">

    @csrf
    @if (isset($entry->id))
        @method('POST') {{-- adjust to PUT if needed --}}
    @endif

    <div class="pl-lg-4">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label class="form-control-label" for="title">Title</label>
                    <input type="text" name="title" value="{{ old('title', $entry->title ?? '') }}"
                        class="form-control" id="title" placeholder="Title">
                    @error('title')
                        <div class="invalid-div">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="form-control-label" for="small_desc">Small Description</label>
                    <input type="text" name="small_desc" value="{{ old('small_desc', $entry->small_desc ?? '') }}"
                        class="form-control" id="small_desc" placeholder="Small Description">
                    @error('small_desc')
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
                        style="{{ !empty($entry->media_url) ? 'display: block !important;' : 'display: none;' }}">
                        <img id="media-preview" src="{{ $entry->media_url ?? '' }}" alt="Selected Media"
                            style="max-height: 200px;">
                        @if (!empty($entry->media_id))
                            <button type="button" class="btn btn-sm btn-danger position-absolute"
                                style="top: 0; right: 0;"
                                onclick="deleteMedia({{ $entry->media_id }}, '{{ url('admin/media') }}')">✖</button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="form-control-label" for="status">Status</label>
                    <select class="form-control select2" name="status" id="status">
                        <option value="1" {{ old('status', $entry->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status', $entry->status ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="text-right">
            <button type="submit" class="btn btn-primary mt-4">Save</button>
        </div>
    </div>
</form>

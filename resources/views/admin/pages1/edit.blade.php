@extends('layouts.app')
@section('content')
    @include('layouts.top-header', [
        'title' => 'Edit',
        'breadcrumbs' => [
            [
                'label' => 'Pages',
                'route' => 'admin.pages.index',
            ]
        ],
    ])



    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="ml-3">Edit Page</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('admin.pages.update', ['page_id' => $item->id]) }}"
                            enctype="multipart/form-data" method="post">
                            @csrf

                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="title">Title</label>
                                            <input type="text" name="title" value="{{ old('title', $item->title) }}"
                                                class="form-control" title="title" id="title" placeholder="title">
                                            @error('title')
                                                <div class="invalid-div">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">

                                        <div class="form-group">
                                            <label class="form-control-label" for="small_desc">Small Description</label>
                                            <input type="text" name="small_desc"
                                                value="{{ old('small_desc', $item->small_desc) }}" class="form-control"
                                                title="small_desc" id="small_desc" placeholder="Small Description">
                                            @error('small_desc')
                                                <div class="invalid-div">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">

                                        <div class="form-group">
                                            <label class="form-control-label" for="media">Media</label>
                                            <div class="custom-file">
                                                <input type="file" name="media" class="custom-file-input"
                                                    id="media" onchange="previewImage(event)">
                                                <label class="custom-file-label" for="media">Select file</label>
                                            </div>
                                            @error('media')
                                                <div class="invalid-div">{{ $message }}</div>
                                            @enderror

                                            <div class="mt-3 position-relative" id="media-preview-wrapper"
                                                style="{{ $item->media_url ? 'display: block !important;' : 'display: none;' }}">


                                                <img id="media-preview" src="{{ $item->media_url }}" alt="Selected Media"
                                                    style="max-height: 200px;">
                                                <button type="button" class="btn btn-sm btn-danger position-absolute"
                                                    style="top: 0; right: 0;"
                                                    onclick="deleteMedia({{ $item->media_id }}, '{{ url('admin/media') }}')">
                                                    ✖
                                                </button>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="status">Status</label>
                                            <select class="form-control select2" name="status" id="status">
                                                <option value="1" {{ old('status', $item->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ old('status', $item->status ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                @include('admin.includes.meta_info')

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary mt-4">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

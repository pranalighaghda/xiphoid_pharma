@extends('layouts.app')
@section('content')
    @include('layouts.top-header', [
        'title' => 'Homepage Banner',
    ])

    <div class="container-fluid mt--6 mb-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <span class="h3"> Homepage Banner</span>

                        <a class="btn btn-primary float-right p-2 text-white"
                            href="{{ route('admin.homepage-banner.reorder') }}"><i
                                class="fas fa-sort mr-1"></i> Reorder
                        </a>
                        <a class="btn btn-primary float-right p-2 mr-2 text-white"
                            href="{{ route('admin.homepage-banner.create') }}"><i
                                class="fas fa-plus mr-1"></i>Add
                            New</a>
                    </div>
                    <!-- table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush table-hover" id="dataTable">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort">#</th>
                                    <th scope="col" class="sort">Title</th>
                                    <th scope="col" class="sort">Small Description</th>
                                    <th scope="col" class="sort">Status</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @forelse ($banners as $key => $banner)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $banner->title }}</td>
                                        <td>{{ $banner->small_desc }}</td>
                                        <td>
                                            @if ($banner->status)
                                                <span class="badge badge-pill badge-success">Active</span>
                                            @else
                                                <span class="badge badge-pill badge-warning">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="table-actions">
                                            <a class="btn btn-info"
                                                href="{{ route('admin.homepage-banner.edit', ['banner_id' => $banner->id]) }}"
                                                data-toggle="tooltip" title="Edit Banner">
                                                <i class="fas fa-user-edit"></i>
                                            </a>
                                            <a class="btn btn-danger text-white delete-button"
                                                data-href="{{ route('admin.homepage-banner.delete', ['banner_id' => $banner->id]) }}"
                                                data-toggle="tooltip" title="Delete Banner">
                                                <i class="fas fa-trash"></i>
                                            </a>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <th colspan="5" class="text-center">No Banners</th>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

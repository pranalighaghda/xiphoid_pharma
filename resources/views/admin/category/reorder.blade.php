@extends('layouts.app')
@section('content')
    @include('layouts.top-header', [
        'title' => 'Reorder Categories',
        'breadcrumbs' => [
            [
                'label' => 'Categories',
                'route' => 'admin.categories.index',
            ],
        ],
    ])

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="ml-3">Reorder Categories</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="sortable-list list-group"
                            data-href="{{ route('admin.categories.update-order') }}">
                            @foreach ($categories as $category)
                                <li class="list-group-item d-flex justify-content-between align-items-center"
                                    data-id="{{ $category->id }}">
                                    <div>
                                        <strong>{{ $category->title }}</strong>
                                        @if ($category->status)
                                            <span class="badge badge-pill badge-success ml-2">Active</span>
                                        @else
                                            <span class="badge badge-pill badge-warning ml-2">Inactive</span>
                                        @endif
                                    </div>
                                    <i class="fas fa-arrows-alt handle" style="cursor: move;"></i>
                                </li>
                            @endforeach

                        </ul>
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div>
                                <a href="{{ route('admin.categories.index') }}"
                                    class="btn btn-success">
                                    <i class="ni ni-bold-left"></i> Go Back
                                </a>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary save-order-btn">
                                    <i class="ni ni-check-bold"></i> Save Order
                                </button>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

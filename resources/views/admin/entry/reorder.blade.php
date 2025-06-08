@extends('layouts.app')
@section('content')
    @include('layouts.top-header', [
        'title' => 'Reorder',
        'breadcrumbs' => [
            [
                'label' => 'Pages',
                'route' => 'admin.pages.index',
            ],
            [
                'label' => 'Sections',
                'route' => 'admin.pages.sections.index',
                'params' => ['page_id' => $page->id],
            ],
            [
                'label' => 'Entries',
                'route' => 'admin.pages.sections.entries.index',
                'params' => ['page_id' => $page->id, 'section_id' => $section->id],
            ],
        ],
    ])

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="ml-3">Reorder Entries</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="sortable-list list-group"
                            data-href="{{ route('admin.pages.sections.entries.update-order', ['page_id' => $page->id, 'section_id' => $section->id]) }}">
                            @foreach ($entries as $entry)
                                <li class="list-group-item d-flex justify-content-between align-items-center"
                                    data-id="{{ $entry->id }}">
                                    <div>
                                        <strong>{{ $entry->title }}</strong>
                                        @if ($entry->status)
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
                                <a href="{{ route('admin.pages.sections.entries.index', ['page_id' => $page->id, 'section_id' => $section->id]) }}"
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

@extends('layouts.app')
@section('content')
    @include('layouts.top-header', [
        'title' => 'Entries',
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
        ],
    ])

    <div class="container-fluid mt--6 mb-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <span class="h3"> {{ $section->title }} -> Entries</span>

                        <a class="btn btn-primary float-right p-2 text-white"
                            href="{{ route('admin.pages.sections.entries.reorder', ['page_id' => $page->id, 'section_id' => $section->id]) }}"><i
                                class="fas fa-sort mr-1"></i> Reorder
                        </a>
                        <a class="btn btn-primary float-right p-2 mr-2 text-white"
                            href="{{ route('admin.pages.sections.entries.create', ['page_id' => $page->id, 'section_id' => $section->id]) }}"><i
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
                                    <th scope="col" class="sort">Status</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @forelse ($entries as $key => $entry)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $entry->title }}</td>
                                        <td>
                                            @if ($entry->status)
                                                <span class="badge badge-pill badge-success">Active</span>
                                            @else
                                                <span class="badge badge-pill badge-warning">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="table-actions">
                                            <a class="btn btn-info"
                                                href="{{ route('admin.pages.sections.entries.edit', ['page_id' => $page->id, 'section_id' => $section->id, 'entry_id' => $entry->id]) }}"
                                                data-toggle="tooltip" title="Edit Entry">
                                                <i class="fas fa-user-edit"></i>
                                            </a>
                                            <a class="btn btn-danger text-white delete-button"
                                                data-href="{{ route('admin.pages.sections.entries.delete', ['page_id' => $page->id, 'section_id' => $section->id, 'entry_id' => $entry->id]) }}"
                                                data-toggle="tooltip" title="Delete Entry">
                                                <i class="fas fa-trash"></i>
                                            </a>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <th colspan="4" class="text-center">No Entries</th>
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

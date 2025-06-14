@extends('layouts.app')

@section('content')
    @include('layouts.top-header', [
        'title' => 'Sections',
        'breadcrumbs' => [
            [
                'label' => 'Pages',
                'route' => 'admin.pages.index',
            ],
        ],
    ])

    <div class="container-fluid mt--6 mb-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <span class="h3">{{ $page->title }} Sections</span>
                    </div>

                    <!-- Table -->
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
                                @forelse ($sections as $section)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $section->title }}</td>
                                        <td>
                                            @if ($section->status)
                                                <span class="badge badge-pill badge-success">Active</span>
                                            @else
                                                <span class="badge badge-pill badge-warning">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="table-actions">
                                            @if ($section->is_entries)
                                                <a class="btn btn-warning"
                                                    href="{{ route('admin.pages.sections.entries.index', ['page_id' => $page->id, 'section_id' => $section->id]) }}"
                                                    data-toggle="tooltip" title="View Entries">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            @endif

                                            <a class="btn btn-info"
                                                href="{{ route('admin.pages.sections.edit', ['page_id' => $page->id, 'section_id' => $section->id]) }}"
                                                data-toggle="tooltip" title="Edit Section">
                                                <i class="fas fa-user-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No Sections</td>
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

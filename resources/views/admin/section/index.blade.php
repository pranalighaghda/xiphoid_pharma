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
                        <span class="h3"> {{ $page->title }} Sections</span>
                    </div>
                    <!-- table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort">#</th>
                                    <th scope="col" class="sort">Title</th>
                                    <th scope="col" class="sort">Status</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @if (count($sections) != 0)
                                    @foreach ($sections as $key => $section)
                                        <tr>
                                            <th>{{ $sections->firstItem() + $key }}</th>
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
                                                    <a class="btn-white btn shadow-none p-0 m-0 table-action text-warning bg-white"
                                                        href="{{ route('admin.pages.sections.entries.index', ['page_id' => $page->id, 'section_id' => $section->id]) }}"
                                                        data-toggle="tooltip" data-original-title="View Entries">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @endif
                                                <a class="btn-white btn shadow-none p-0 m-0 table-action text-info bg-white"
                                                    href="{{ route('admin.pages.sections.edit', ['page_id' => $page->id, 'section_id' => $section->id]) }}"
                                                    data-toggle="tooltip" data-original-title="Edit Page">
                                                    <i class="fas fa-user-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <th colspan="10" class="text-center">No Sections</th>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="float-right mr-4 mb-1">
                            {{ $sections->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

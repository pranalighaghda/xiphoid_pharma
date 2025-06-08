@extends('layouts.app')
@section('content')
    @include('layouts.top-header', [
        'title' => __('Pages'),
        'class' => 'col-lg-7',
    ])

    <div class="container-fluid mt--6 mb-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <span class="h3">Pages</span>
                    </div>
                    <!-- table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush table-hover" id="dataTable">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort">#</th>
                                    <th scope="col" class="sort">Title</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @forelse ($pages as $key => $page)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $page->title }}</td>
                                        <td class="table-actions">
                                            @if ($page->is_sections)
                                                <a class="btn btn-warning"
                                                    href="{{ route('admin.pages.sections.index', ['page_id' => $page->id]) }}"
                                                    data-toggle="tooltip" title="View Sections">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            @endif
                                            <a class="btn btn-info"
                                                href="{{ route('admin.pages.edit', ['page_id' => $page->id]) }}"
                                                data-toggle="tooltip" title="Edit Page">
                                                <i class="fas fa-user-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No Pages</td>
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

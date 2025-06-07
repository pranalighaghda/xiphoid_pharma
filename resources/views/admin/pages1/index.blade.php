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
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort">#</th>
                                    <th scope="col" class="sort">Title</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @if (count($pages) != 0)
                                    @foreach ($pages as $key => $page)
                                        <tr>
                                            <th>{{ $pages->firstItem() + $key }}</th>
                                            <td>{{ $page->title }}</td>
                                            <td class="table-actions">
                                                @if ($page->is_sections)
                                                    <a class="btn-white btn shadow-none p-0 m-0 table-action text-warning bg-white"
                                                        href="{{ route('admin.pages.sections.index', ['page_id' => $page->id]) }}"
                                                        data-toggle="tooltip" data-original-title="View Sections">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @endif
                                                <a class="btn-white btn shadow-none p-0 m-0 table-action text-info bg-white"
                                                        href="{{ route('admin.pages.edit', ['page_id' => $page->id]) }}"
                                                    data-toggle="tooltip" data-original-title="Edit Page">
                                                    <i class="fas fa-user-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <th colspan="3" class="text-center">No Pages</th>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="float-right mr-4 mb-1">
                            {{ $pages->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

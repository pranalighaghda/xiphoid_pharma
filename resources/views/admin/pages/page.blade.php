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
                        <button class="btn btn-primary addbtn float-right p-2 add_banner" id="add_banner"><i
                                class="fas fa-plus mr-1"></i>Add New</button>
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
                                                <button
                                                    class="btn-white btn shadow-none p-0 m-0 table-action text-warning bg-white"
                                                    data-toggle="tooltip" data-original-title="View Page">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button
                                                    class="btn-white btn shadow-none p-0 m-0 table-action text-info bg-white"
                                                    data-toggle="tooltip" data-original-title="Edit Page">
                                                    <i class="fas fa-user-edit"></i>
                                                </button>
                                                <button
                                                    class="btn-white btn shadow-none p-0 m-0 table-action text-danger bg-white"
                                                    data-toggle="tooltip" data-original-title="Delete Page">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <th colspan="10" class="text-center">No Pages</th>
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

        {{-- @include('admin.banner.create')
    @include('admin.banner.show')
    @include('admin.banner.edit') --}}
    @endsection

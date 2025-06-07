@extends('layouts.app')
@section('content')


    @include('layouts.top-header', [
        'title' => 'Sections',
        'headerData' => 'Pages',
        'url' => 'admin/pages',
        'class' => 'col-lg-7',
    ])

    <div class="container-fluid mt--6 mb-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <span class="h3"> {{ $section->title }} -> Entries</span>
                        <a class="btn btn-primary float-right p-2"><i class="fas fa-plus mr-1"></i>Add
                            New</a>
                        <a class="btn btn-primary float-right p-2 mr-2"><i class="fas fa-plus mr-1"></i> Reorder
                        </a>
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
                                @if (count($entries) != 0)
                                    @foreach ($entries as $key => $entry)
                                        <tr>
                                            <th>{{ $entries->firstItem() + $key }}</th>
                                            <td>{{ $entry->title }}</td>
                                            <td>
                                                @if ($entry->status)
                                                    <span class="badge badge-pill badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-pill badge-warning">Inactive</span>
                                                @endif
                                            </td>
                                            <td class="table-actions">
                                                <a class="btn-white btn shadow-none p-0 m-0 table-action text-info bg-white"
                                                    data-toggle="tooltip" data-original-title="Edit Entry">
                                                    <i class="fas fa-user-edit"></i>
                                                </a>
                                                <a class="btn-white btn shadow-none p-0 m-0 table-action text-danger bg-white"
                                                    data-toggle="tooltip" data-original-title="Delete Entry">
                                                    <i class="fas fa-trash"></i>
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
                            {{ $entries->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

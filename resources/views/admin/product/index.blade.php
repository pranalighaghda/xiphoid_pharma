@extends('layouts.app')
@section('content')
    @include('layouts.top-header', [
        'title' => 'Products',
    ])

    <div class="container-fluid mt--6 mb-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <span class="h3"> Products</span>

                        <a class="btn btn-primary float-right p-2 text-white"
                            href="{{ route('admin.products.reorder') }}"><i
                                class="fas fa-sort mr-1"></i> Reorder
                        </a>
                        <a class="btn btn-primary float-right p-2 mr-2 text-white"
                            href="{{ route('admin.products.create') }}"><i
                                class="fas fa-plus mr-1"></i>Add
                            New</a>
                    </div>
                    <!-- table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush table-hover" id="dataTable">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort">#</th>
                                    <th scope="col" class="sort">Category</th>
                                    <th scope="col" class="sort">Name</th>
                                    <th scope="col" class="sort">Status</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @forelse ($products as $key => $product)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $product->category->title }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>
                                            @if ($product->status)
                                                <span class="badge badge-pill badge-success">Active</span>
                                            @else
                                                <span class="badge badge-pill badge-warning">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="table-actions">
                                            <a class="btn btn-info"
                                                href="{{ route('admin.products.edit', ['product_id' => $product->id]) }}"
                                                data-toggle="tooltip" title="Edit Product">
                                                <i class="fas fa-user-edit"></i>
                                            </a>
                                            <a class="btn btn-danger text-white delete-button"
                                                data-href="{{ route('admin.products.delete', ['product_id' => $product->id]) }}"
                                                data-toggle="tooltip" title="Delete Product">
                                                <i class="fas fa-trash"></i>
                                            </a>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No Products</td>
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

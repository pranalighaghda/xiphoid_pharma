@extends('layouts.app')
@section('content')
    @include('layouts.top-header', [
        'title' => 'Create Product',
        'breadcrumbs' => [
            [
                'label' => 'Products',
                'route' => 'admin.products.index',
            ],
        ],
    ])

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="ml-3">Create Product</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('admin.product._form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

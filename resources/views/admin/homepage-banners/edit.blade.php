@extends('layouts.app')
@section('content')
    @include('layouts.top-header', [
        'title' => 'Edit Homepage Banners',
        'breadcrumbs' => [
            [
                'label' => 'Homepage Banners',
                'route' => 'admin.homepage-banners.index',
            ],
        ],
    ])

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="ml-3">Edit Homepage Banners</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('admin.homepage-banners._form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

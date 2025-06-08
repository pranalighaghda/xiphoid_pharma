@extends('layouts.app')
@section('content')
    @include('layouts.top-header', [
        'title' => 'Create',
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
            [
                'label' => 'Entries',
                'route' => 'admin.pages.sections.entries.index',
                'params' => ['page_id' => $page->id, 'section_id' => $section->id],
            ],
        ],
    ])

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="ml-3">Create Entry</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('admin.entry._form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

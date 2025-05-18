@extends('admin.layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('admin.layouts.navbars.auth.topnav', ['title' => 'Pages'])

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 shadow">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">📄 Pages Table</h6>
                        <a href="#" class="btn btn-sm btn-success">+ Add New Page</a>
                    </div>

                    <div class="card-body px-4 pt-2 pb-2">
                        <div class="table-responsive">
                            <table class="table table-hover align-items-center mb-0" id="data-table">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="text-secondary text-xs font-weight-bolder ps-2">#</th>
                                        <th class="text-secondary text-xs font-weight-bolder ps-2">Title</th>
                                        <th class="text-secondary text-xs font-weight-bolder ps-2 text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pages as $index => $page)
                                        <tr>
                                            <td class="ps-3 text-sm">{{ $index + 1 }}</td>
                                            <td class="text-sm">
                                                <span class="text-dark font-weight-bold">{{ $page->title }}</span>
                                            </td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-sm btn-outline-primary px-3">
                                                    <i class="fas fa-edit me-1"></i> Edit
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted py-4">No pages found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.layouts.footers.auth.footer')
    </div>
@endsection

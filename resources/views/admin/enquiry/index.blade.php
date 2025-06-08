@extends('layouts.app')
@section('content')
    @include('layouts.top-header', [
        'title' => 'Enquiries',
    ])

    <div class="container-fluid mt--6 mb-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <span class="h3"> Enquiries</span>
                    </div>
                    <!-- table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush table-hover" id="dataTable">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort">#</th>
                                    <th scope="col" class="sort">Name</th>
                                    <th scope="col" class="sort">Email</th>
                                    <th scope="col" class="sort">Phone</th>
                                    <th scope="col" class="sort">Subject</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @forelse ($enquiries as $key => $enquiry)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $enquiry->name }}</td>
                                        <td>{{ $enquiry->email }}</td>
                                        <td>{{ $enquiry->phone_no }}</td>
                                        <td>{{ $enquiry->subject }}</td>
                                        <td class="table-actions">
                                            <a class="btn btn-warning btn-view text-white"
                                                data-href="{{ route('admin.enquiries.show', ['enquiry_id' => $enquiry->id]) }}"
                                                data-toggle="tooltip" title="View Enquiry">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a class="btn btn-danger text-white delete-button"
                                                data-href="{{ route('admin.enquiries.delete', ['enquiry_id' => $enquiry->id]) }}"
                                                data-toggle="tooltip" title="Delete Enquiry">
                                                <i class="fas fa-trash"></i>
                                            </a>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No Enquiries</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.enquiry._model')
@endsection

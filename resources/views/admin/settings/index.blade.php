@extends('layouts.app')
@section('content')
    @include('layouts.top-header', [
        'title' => 'Settings',
    ])


    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="ml-3">Edit Settings</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.settings.update') }}" method="POST">
                            @csrf
                            @foreach ($settings as $setting)
                                <div class="form-group mb-3">
                                    <label>{{ $setting->title }} @if ($setting->is_required)
                                            <span class="text-danger">*</span>
                                        @endif
                                    </label>

                                    @if ($setting->field_type === 'textarea')
                                        <textarea class="form-control" name="settings[{{ $setting->id }}]" rows="3"
                                            @if ($setting->is_required) required @endif>{{ old("settings.{$setting->id}", $setting->value) }}</textarea>
                                    @else
                                        <input type="{{ $setting->field_type }}" class="form-control"
                                            name="settings[{{ $setting->id }}]"
                                            value="{{ old("settings.{$setting->id}", $setting->value) }}"
                                            @if ($setting->is_required) required @endif>
                                    @endif
                                </div>
                            @endforeach

                            <div class="text-right">
                                <button type="submit" class="btn btn-primary mt-4">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

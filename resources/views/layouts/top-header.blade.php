<div class="header pt-7"
    style="background-image: url('https://bbdu.ac.in/wp-content/uploads/2020/06/pharmacy-post-banner-background.jpg'); background-size: cover; background-position: center center;">
    <span class="mask bg-gradient-dark opacity-7"></span>
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4 pb-7">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item text-white">
                                <a href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-home text-theme"></i>
                                </a>
                            </li>

                            @if (isset($breadcrumbs) && is_array($breadcrumbs))
                                @foreach ($breadcrumbs as $breadcrumb)
                                    <li class="breadcrumb-item text-white">
                                        @if (isset($breadcrumb['route']) && Route::has($breadcrumb['route']))
                                            <a href="{{ route($breadcrumb['route'], $breadcrumb['params'] ?? []) }}"
                                                class="text-theme">{{ $breadcrumb['label'] }}</a>
                                        @else
                                            <span class="text-white">{{ $breadcrumb['label'] }}</span>
                                        @endif
                                    </li>
                                @endforeach
                            @endif

                            <li class="breadcrumb-item active text-white" aria-current="page">{{ $title }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

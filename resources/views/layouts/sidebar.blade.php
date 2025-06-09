<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
            aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Brand -->
        <a class="navbar-brand p-0" href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('images/logo.png') }}" class="navbar-brand-img sidebar-logo" alt="...">
        </a>


        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder"
                                src="{{ asset('images/user.jpg') }}">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome!</h6>
                    </div>

                    <a href="{{ route('admin.profile') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>My profile</span>
                    </a>
                    <div class="dropdown-divider"></div>

                    <a href="{{ route('logout') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a class="navbar-brand pt-0" href="{{ route('admin.dashboard') }}">
                            <img src="{{ asset('images/logo.png') }}" class="navbar-brand-img" alt="...">
                        </a>
                    </div>
                </div>
            </div>


            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}"
                        href="{{ route('admin.dashboard') }}">
                        <i class="ni ni-tv-2 text-teal"></i>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/pages*') ? 'active' : '' }}"
                        href="{{ route('admin.pages.index') }}">
                        <i class="ni ni-single-copy-04 text-blue"></i>
                        <span class="nav-link-text">Pages</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/homepage-banners*') ? 'active' : '' }}"
                        href="{{ route('admin.homepage-banners.index') }}">
                        <i class="ni ni-image text-green"></i>
                        <span class="nav-link-text">Homepage Banners</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/categories*') ? 'active' : '' }}"
                        href="{{ route('admin.categories.index') }}">
                        <i class="ni ni-tag text-red"></i>
                        <span class="nav-link-text">Categories</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/products*') ? 'active' : '' }}"
                        href="{{ route('admin.products.index') }}">
                        <i class="ni ni-bag-17 text-orange"></i>
                        <span class="nav-link-text">Products</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/enquiries*') ? 'active' : '' }}"
                        href="{{ route('admin.enquiries.index') }}">
                        <i class="ni ni-email-83 text-yellow"></i>
                        <span class="nav-link-text">Enquiries</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/settings') ? 'active' : '' }}"
                        href="{{ route('admin.settings.index') }}">
                        <i class="ni ni-settings text-purple"></i>
                        <span class="nav-link-text">Settings</span>
                    </a>
                </li>
            </ul>

        </div>
    </div>
</nav>

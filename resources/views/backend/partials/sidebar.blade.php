@php
    $systemSetting = App\Models\SystemSetting::first();
@endphp

<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            @if(Auth::user()->role == 'Super Admin')
                <a class="header-brand1" href="{{ route('dashboard') }}">
                    <img src="{{ asset($systemSetting->logo ?? 'frontend/images/default/food_junction.png') }}"
                        class="header-brand-img desktop-logo" alt="logo">
                    <img src="{{ asset($systemSetting->logo ?? 'frontend/images/default/food_junction.png') }}"
                        class="header-brand-img toggle-logo" alt="logo">
                    <img src="{{ asset($systemSetting->logo ?? 'frontend/images/default/food_junction.png') }}"
                        class="header-brand-img light-logo" alt="logo">
                    <img src="{{ asset($systemSetting->logo ?? 'frontend/images/default/food_junction.png') }}"
                        class="header-brand-img light-logo1" alt="logo">
                </a>
            @elseif(Auth::user()->role == 'Admin')
                <a class="header-brand1" href="{{ route('admin.dashboard') }}">
                    <img src="{{ asset($systemSetting->logo ?? 'frontend/images/default/food_junction.png') }}"
                         class="header-brand-img desktop-logo" alt="logo">
                    <img src="{{ asset($systemSetting->logo ?? 'frontend/images/default/food_junction.png') }}"
                         class="header-brand-img toggle-logo" alt="logo">
                    <img src="{{ asset($systemSetting->logo ?? 'frontend/images/default/food_junction.png') }}"
                         class="header-brand-img light-logo" alt="logo">
                    <img src="{{ asset($systemSetting->logo ?? 'frontend/images/default/food_junction.png') }}"
                         class="header-brand-img light-logo1" alt="logo">
                </a>
            @endif
        </div>

        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg>
            </div>

            <ul class="side-menu">
                <li class="slide">
                    @if(Auth::user()->role == 'Super Admin')
                        <a class="side-menu__item has-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" data-bs-toggle="slide" href="{{ route('dashboard') }}">
                            <i class="side-menu__icon fe fe-home"></i>
                            <span class="side-menu__label">Dashboard</span>
                        </a>
                    @elseif(Auth::user()->role == 'Admin')
                        <a class="side-menu__item has-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" data-bs-toggle="slide" href="{{ route('admin.dashboard') }}">
                            <i class="side-menu__icon fe fe-home"></i>
                            <span class="side-menu__label">Dashboard</span>
                        </a>
                    @endif
                </li>

                <li class="slide {{ request()->routeIs('user.*') ? 'active is-expanded' : '' }}">
                    <a class="side-menu__item has-link {{ request()->routeIs('user.*') ? 'active' : '' }}" data-bs-toggle="slide" href="{{ route('user.index') }}">
                        <i class="side-menu__icon fe fe-users"></i>
                        <span class="side-menu__label">User Management</span>
                    </a>
                </li>

                <li class="slide {{ request()->routeIs('categories.*', 'delivery-zones.*', 'products.*', 'orders.*') ? 'active is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                        <i class="side-menu__icon fe fe-shopping-cart"></i>
                        <span class="side-menu__label">Shop Management</span><i class="angle fa fa-angle-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li><a href="{{ route('categories.index') }}" class="slide-item {{ request()->routeIs('categories.*') ? 'active' : '' }}">Categories</a></li>
                        <li><a href="{{ route('delivery-zones.index') }}" class="slide-item {{ request()->routeIs('delivery-zones.*') ? 'active' : '' }}">Delivery Zones</a></li>
                        <li><a href="{{ route('products.index') }}" class="slide-item {{ request()->routeIs('products.*') ? 'active' : '' }}">Products</a></li>
                        <li><a href="{{ route('orders.index') }}" class="slide-item {{ request()->routeIs('orders.*') ? 'active' : '' }}">Orders</a></li>
                    </ul>
                </li>

                <li class="slide {{ request()->routeIs('coupons.*', 'offers.*') ? 'active is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                        <i class="side-menu__icon fe fe-percent"></i>
                        <span class="side-menu__label">Marketing</span><i class="angle fa fa-angle-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li><a href="{{ route('coupons.index') }}" class="slide-item {{ request()->routeIs('coupons.*') ? 'active' : '' }}">Coupons</a></li>
                        <li><a href="{{ route('offers.index') }}" class="slide-item {{ request()->routeIs('offers.*') ? 'active' : '' }}">Offers</a></li>
                    </ul>
                </li>

                <li class="slide {{ request()->routeIs('cms.*', 'blogs.*', 'blog.comments.*', 'videos.*', 'faqs.*') ? 'active is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                        <i class="side-menu__icon fe fe-file-text"></i>
                        <span class="side-menu__label">CMS</span><i class="angle fa fa-angle-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li><a href="{{ route('cms.home-banner.index') }}" class="slide-item {{ request()->routeIs('cms.home-banner.*') ? 'active' : '' }}">Home Banners</a></li>
                        <li><a href="{{ route('cms.home-bottom-banner.edit') }}" class="slide-item {{ request()->routeIs('cms.home-bottom-banner.*') ? 'active' : '' }}">Bottom Banner</a></li>
                        <li><a href="{{ route('blogs.index') }}" class="slide-item {{ request()->routeIs('blogs.*') ? 'active' : '' }}">Blogs</a></li>
                        <li><a href="{{ route('blog.comments.index') }}" class="slide-item {{ request()->routeIs('blog.comments.*') ? 'active' : '' }}">Blog Comments</a></li>
                        <li><a href="{{ route('videos.index') }}" class="slide-item {{ request()->routeIs('videos.*') ? 'active' : '' }}">Videos</a></li>
                        <li><a href="{{ route('faqs.index') }}" class="slide-item {{ request()->routeIs('faqs.*') ? 'active' : '' }}">FAQs</a></li>
                    </ul>
                </li>

                <li class="slide {{ request()->routeIs('contact.*') ? 'active is-expanded' : '' }}">
                    <a class="side-menu__item has-link {{ request()->routeIs('contact.*') ? 'active' : '' }}" data-bs-toggle="slide" href="{{ route('contact.index') }}">
                        <i class="side-menu__icon fe fe-mail"></i>
                        <span class="side-menu__label">Contact Messages</span>
                    </a>
                </li>

                <hr>
                <li class="slide {{ request()->is('admin/settings*') || request()->routeIs('profile.setting', 'system.index') ? 'active is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                        <i class="side-menu__icon fe fe-settings"></i>
                        <span class="side-menu__label">Settings</span><i class="angle fa fa-angle-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li><a href="{{ route('profile.setting') }}" class="slide-item {{ request()->routeIs('profile.setting') ? 'active' : '' }}">Profile Settings</a></li>
                        <li><a href="{{ route('system.index') }}" class="slide-item {{ request()->routeIs('system.index') ? 'active' : '' }}">System Settings</a></li>
                        <li><a href="{{ route('settings.dynamic_page.index') }}" class="slide-item {{ request()->is('admin/settings/dynamic-page*') ? 'active' : '' }}">Dynamic Pages</a></li>
                        <li><a href="{{ route('scripts.index') }}" class="slide-item {{ request()->routeIs('scripts.*') ? 'active' : '' }}">Script Settings</a></li>
                    </ul>
                </li>
            </ul>

            <div class="slide-right" id="slide-right">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg>
            </div>
        </div>
    </div>
</div>

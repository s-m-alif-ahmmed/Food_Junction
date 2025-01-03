<?php
$categories = \App\Models\Category::where('status', 'active')->latest()->get()
?>

<div class="container d-lg-block d-md-none d-sm-none d-none">
    <div class="row">
        <ul class="navbar-nav navbar categories">
            <li class="nav-item">
                <a href="{{ route('products') }}" class="nav-link">
                    All Categories
                </a>
            </li>
            @foreach($categories as $category)
                <li class="nav-item">
                    <a href="{{ route('category.products', $category->category_slug) }}" class="nav-link">
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

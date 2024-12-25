<?php
$categories = \App\Models\Category::where('status', 'active')->latest()->get()
?>

<div class="container">
    <div class="row">
        <ul class="navbar-nav navbar categories">
            <li class="nav-item">
                <a href="" class="nav-link">
                    All Categories
                </a>
            </li>
            @foreach($categories as $category)
                <li class="nav-item">
                    <a href="" class="nav-link">
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

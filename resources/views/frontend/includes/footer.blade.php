<section class="py-5 border-bottom border-top" id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img class="img-fluid footer-logo mx-sm-auto mb-2 mt-0" src="{{ asset('/frontend/images/brands/food_junction.png') }}" alt="">
                <p class="text-justify fsw-semibold text-sm-center">
                    ঐতিহ্য, সততা, সুস্বাদ
                </p>
            </div>

            <div class="col-md-2">
                <p class="fw-bold fs-20">Quick Links</p>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about-us') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('videos') }}">Videos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blogs') }}">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('faq') }}">FAQ</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-2">
                <p class="fw-bold fs-20">Company</p>
                <ul class="navbar-nav">
                    @php
                        $dynamic_pages = \App\Models\DynamicPage::query()->where('status','active')->latest()->get();
                    @endphp
                    @foreach($dynamic_pages as $page)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.dynamic.page', $page->page_slug) }}">{{ $page->page_title }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-4">
                <p class="fw-bold fs-20">
                    Contact
                </p>
                <p>
                    <i class="fa fa-phone"></i>
                    01607022072
                </p>
                <p>
                    <i class="fa-solid fa-location-dot"></i>
                    উত্তরা, ঢাকা, বাংলাদেশ
                </p>
                <div class="social-icon">
                    <ul class="navbar-nav flex-row footer-social-icon">
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.facebook.com/FoodJunctionDhaka24" target="_blank">
                                <i class="fa-brands fa-facebook" style=""></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://api.whatsapp.com/send?phone=01607022072" target="_blank">
                                <i class="fa-brands fa-whatsapp" ></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="" target="_blank">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="" target="_blank">
                                <i class="fa-brands fa-youtube"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="" target="_blank">
                                <i class="fa-brands fa-x-twitter"></i>
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <p class="fs-16">All <i class="fa-regular fa-copyright"></i> copyrights reserved by <a class="text-decoration-none text-black" href="https://www.facebook.com/FoodJunctionDhaka24">Food Function</a>. Design & Developed by
                    <a class="text-decoration-none text-black" href="https://www.facebook.com/Netbindubd">Net Bindu</a>.</p>
            </div>
        </div>
    </div>
</section>

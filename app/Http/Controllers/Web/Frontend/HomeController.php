<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\DynamicPage;
use Illuminate\View\View;

class HomeController extends Controller {
    /**
     * Display the welcome page.
     *
     * @return View
     */
    public function index(): View {
        return view('frontend.pages.index');
    }

    public function contact(): View {
        return view('frontend.pages.contact');
    }

    public function sweets(): View {
        return view('frontend.pages.product');
    }

    public function detail(): View {
        return view('frontend.pages.detail');
    }

    public function dynamicPage($page_slug): View {
        $dynamic_page = DynamicPage::where('page_slug', $page_slug)->first();

        // Check if the page exists, otherwise return a 404
        if (!$dynamic_page) {
            abort(404); // Or you can return a custom view for the error
        }

        return view('frontend.pages.dynamic_page', [
            'dynamic_page' => $dynamic_page,
        ]);
    }


}

<?php

namespace App\Http\Controllers\Web\Backend\Cms;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\HomeBottomBanner;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class HomeBottomBannerController extends Controller
{
    /**
     * Show the form for editing the specified faq content.
     *
     * @param int $id
     * @return View
     */
    public function edit(): View {
        $data = HomeBottomBanner::find(1);
        return view('backend.layouts.cms.home-bottom-banner.edit', compact('data'));
    }

    /**
     * Update the specified sweet content in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse {
        try {
            $validator = Validator::make($request->all(), [
                'title'    => 'required|string|max:50',
                'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data             = HomeBottomBanner::findOrFail(1);
            $data->title      = $request->title;
            // Handle file upload if a new image is provided
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

                // Delete existing image if it exists
                if ($data->image && file_exists(public_path($data->image))) {
                    Helper::fileDelete(public_path($data->image));
                }

                // Upload the new image
                $imagePath = Helper::fileUpload($image, 'cms/home-bottom-banner', $imageName);

                if ($imagePath === null) {
                    throw new Exception('Failed to upload image.');
                }

                $data->image = $imagePath;
            }
            $data->update();

            return redirect()->route('cms.home-bottom-banner.edit')->with('t-success', 'Home Bottom Banner Updated Successfully.');

        } catch (Exception) {
            return redirect()->route('cms.home-bottom-banner.edit')->with('t-success', 'Home Bottom Banner failed to update');
        }
    }

}

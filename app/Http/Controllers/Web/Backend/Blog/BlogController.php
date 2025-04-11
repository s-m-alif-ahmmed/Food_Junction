<?php

namespace App\Http\Controllers\Web\Backend\Blog;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class BlogController extends Controller
{
    /**
     * Display a listing of product content.
     *
     * @param Request $request
     * @return View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request): View | JsonResponse {
        if ($request->ajax()) {
            $data = Blog::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($data) {
                    $name = $data->name;
                    return $name;
                })
                ->addColumn('status', function ($data) {
                    $backgroundColor  = $data->status == "active" ? '#4CAF50' : '#ccc';
                    $sliderTranslateX = $data->status == "active" ? '26px' : '2px';
                    $sliderStyles     = "position: absolute; top: 2px; left: 2px; width: 20px; height: 20px; background-color: white; border-radius: 50%; transition: transform 0.3s ease; transform: translateX($sliderTranslateX);";

                    $status = '<div class="form-check form-switch" style="margin-left:40px; position: relative; width: 50px; height: 24px; background-color: ' . $backgroundColor . '; border-radius: 12px; transition: background-color 0.3s ease; cursor: pointer;">';
                    $status .= '<input onclick="showStatusChangeAlert(' . $data->id . ')" type="checkbox" class="form-check-input" id="customSwitch' . $data->id . '" getAreaid="' . $data->id . '" name="status" style="position: absolute; width: 100%; height: 100%; opacity: 0; z-index: 2; cursor: pointer;">';
                    $status .= '<span style="' . $sliderStyles . '"></span>';
                    $status .= '<label for="customSwitch' . $data->id . '" class="form-check-label" style="margin-left: 10px;"></label>';
                    $status .= '</div>';

                    return $status;
                })
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                <a href="' . route('products.show', ['id' => $data->id]) . '" type="button" class="btn btn-secondary fs-14 text-white edit-icn" title="Edit">
                                    <i class="fe fe-eye"></i>
                                </a>
                                <a href="' . route('products.edit', ['id' => $data->id]) . '" type="button" class="btn btn-primary fs-14 text-white edit-icn" title="Edit">
                                    <i class="fe fe-edit"></i>
                                </a>
                                <a href="#" type="button" onclick="showDeleteConfirm(' . $data->id . ')" class="btn btn-danger fs-14 text-white delete-icn" title="Delete">
                                    <i class="fe fe-trash"></i>
                                </a>
                            </div>';
                })
                ->rawColumns(['name', 'status', 'action'])
                ->make();
        }
        return view('backend.layouts.blog.index');
    }

    /**
     * Show the form for creating a new product content.
     *
     * @return View
     */
    public function create(): View {
        return view('backend.layouts.blog.create');
    }

    /**
     * Store a newly created product content in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse {
        try {
            $validator = Validator::make($request->all(), [
                'meta_title'        => 'required|string',
                'meta_description'  => 'required|string',
                'meta_keywords'     => 'required|string',
                'category_id'       => 'required',
                'name'              => 'required|string|max:100',
                'description'       => 'required|string',
                'image'             => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 200KB
                'price'             => 'required',
                'discount_price'    => 'nullable',
                'product_type'      => 'nullable',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data                       = new Blog();
            $data->meta_title           = $request->meta_title;
            $data->meta_description     = $request->meta_description;
            $data->meta_keywords        = $request->meta_keywords;
            $data->category_id          = $request->category_id;
            $data->name                 = $request->name;
            $data->description          = $request->description;
            $data->price                = $request->price;
            $data->discount_price       = $request->discount_price;
            $data->product_type         = $request->product_type;
            $data->product_slug         = Str::slug($request->name);

            // Handle file upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = Helper::fileUpload($image, 'products', $imageName);

                if ($imagePath === null) {
                    throw new Exception('Failed to upload image.');
                }

                $data->image = $imagePath;
            }
            $data->save();

            return redirect()->route('products.index')->with('t-success', 'Created successfully');
        } catch (Exception) {
            return redirect()->route('products.index')->with('t-success', 'Product failed created.');
        }
    }

    public function show(int $id): View {
        $data = Blog::find($id);
        return view('backend.layouts.product.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified product content.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View {
        $data = Blog::find($id);
        return view('backend.layouts.product.edit', compact('data','categories'));
    }

    /**
     * Update the specified sweet content in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse {
        try {
            $validator = Validator::make($request->all(), [
                'meta_title'        => 'required|string',
                'meta_description'  => 'required|string',
                'meta_keywords'     => 'required|string',
                'category_id'       => 'required',
                'name'              => 'required|string|max:100',
                'description'       => 'required|string',
                'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 200KB
                'price'             => 'required',
                'discount_price'    => 'nullable',
                'product_type'      => 'nullable',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data                       = Blog::findOrFail($id);
            $data->meta_title           = $request->meta_title;
            $data->meta_description     = $request->meta_description;
            $data->meta_keywords        = $request->meta_keywords;
            $data->category_id          = $request->category_id;
            $data->name                 = $request->name;
            $data->description          = $request->description;
            $data->price                = $request->price;
            $data->discount_price       = $request->discount_price;
            $data->product_type         = $request->product_type;
            $data->product_slug         = Str::slug($request->name);

            // Handle file upload if a new image is provided
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

                // Delete existing image if it exists
                if ($data->image && file_exists(public_path($data->image))) {
                    Helper::fileDelete(public_path($data->image));
                }

                // Upload the new image
                $imagePath = Helper::fileUpload($image, 'products', $imageName);

                if ($imagePath === null) {
                    throw new Exception('Failed to upload image.');
                }

                $data->image = $imagePath;
            }

            $data->update();

            return redirect()->route('products.index')->with('t-success', 'Product Updated Successfully.');

        } catch (Exception) {
            return redirect()->route('products.index')->with('t-success', 'Product failed to update');
        }
    }

    /**
     * Change the status of the specified product content.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function status(int $id): JsonResponse {
        $data = Blog::findOrFail($id);
        if ($data->status == 'active') {
            $data->status = 'inactive';
            $data->save();

            return response()->json([
                'success' => false,
                'message' => 'Unpublished Successfully.',
                'data'    => $data,
            ]);
        } else {
            $data->status = 'active';
            $data->save();

            return response()->json([
                'success' => true,
                'message' => 'Published Successfully.',
                'data'    => $data,
            ]);
        }
    }

    /**
     * Remove the specified Product content from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse {
        try {
            $data = Blog::findOrFail($id);
            $data->delete();

            return response()->json([
                'success' => true,
                'message' => 'Product deleted successfully.',
            ]);
        } catch (Exception) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete the Product.',
            ]);
        }
    }
}

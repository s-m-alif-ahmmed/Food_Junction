<?php

namespace App\Http\Controllers\Web\Backend\Product;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\DeliveryZone;
use App\Models\Offer;
use App\Models\Product;
use App\Models\ProductVariant;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
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
            $data = Product::with(['category', 'variants'])->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('category', function ($data) {
                    return $data->category->name ?? '--';
                })
                ->addColumn('price', function ($data) {
                    return $data->variants->first()->price ?? 0;
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
                                <a href="' . route('products.show', ['id' => $data->id]) . '" type="button" class="btn btn-secondary fs-14 text-white edit-icn" title="View Detail">
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
        return view('backend.layouts.product.index');
    }

    /**
     * Show the form for creating a new product content.
     *
     * @return View
     */
    public function create(): View {
        $categories    = Category::all();
        $deliveryZones = DeliveryZone::where('status', 'active')->orderBy('name')->get();
        return view('backend.layouts.product.create', compact('categories', 'deliveryZones'));
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
                'meta_title'        => 'nullable|string',
                'meta_description'  => 'nullable|string',
                'meta_keywords'     => 'nullable|string',
                'category_id'       => 'required',
                'name'              => 'required|string|max:100',
                'description'       => 'required|string',
                'image'             => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'pricing_type'      => 'required|in:quantity,weight',
                'variant_quantity'  => 'required|array',
                'variant_quantity.*'=> 'required|numeric|min:1',
                'variant_unit_type' => 'required|array',
                'variant_price'     => 'required|array',
                'variant_price.*'   => 'required|numeric|min:0',
                'variant_discount_price' => 'nullable|array',
                'delivery_zone_ids' => 'nullable|array',
                'delivery_zone_ids.*' => 'exists:delivery_zones,id',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data                       = new Product();
            $data->meta_title           = $request->meta_title;
            $data->meta_description     = $request->meta_description;
            $data->meta_keywords        = $request->meta_keywords;
            $data->category_id          = $request->category_id;
            $data->name                 = $request->name;
            $data->description          = $request->description;
            $data->type                 = $request->pricing_type == 'weight' ? 'gram' : 'pcs';
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

            // Sync Delivery Zones
            $data->deliveryZones()->sync($request->input('delivery_zone_ids', []));

            // Handle Product Variants
            if ($request->has('variant_quantity')) {
                foreach ($request->variant_quantity as $index => $qty) {
                    ProductVariant::create([
                        'product_id' => $data->id,
                        'variant_type' => $data->type,
                        'quantity' => $qty,
                        'unit' => $request->variant_unit_type[$index] ?? ($data->type == 'gram' ? 'gm' : 'pc'),
                        'price' => $request->variant_price[$index] ?? 0,
                        'sale_price' => $request->variant_discount_price[$index] ?? null,
                        'stock' => 100, // Default stock for now
                        'status' => 'Active',
                    ]);
                }
            }

            return redirect()->route('products.index')->with('t-success', 'Created successfully');
        } catch (Exception $e) {
            return redirect()->route('products.index')->with('t-error', 'Product failed to create: ' . $e->getMessage());
        }
    }

    public function show(int $id): View {
        $data = Product::with(['category', 'variants'])->findOrFail($id);
        return view('backend.layouts.product.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified product content.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View {
        $categories    = Category::all();
        $deliveryZones = DeliveryZone::where('status', 'active')->orderBy('name')->get();
        $data          = Product::with(['variants', 'deliveryZones'])->findOrFail($id);
        return view('backend.layouts.product.edit', compact('data', 'categories', 'deliveryZones'));
    }

    /**
     * Update the specified product content in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse {
        try {
            $validator = Validator::make($request->all(), [
                'meta_title'        => 'nullable|string',
                'meta_description'  => 'nullable|string',
                'meta_keywords'     => 'nullable|string',
                'category_id'       => 'required',
                'name'              => 'required|string|max:100',
                'description'       => 'required|string',
                'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'pricing_type'      => 'required|in:quantity,weight',
                'variant_quantity'  => 'required|array',
                'variant_quantity.*'=> 'required|numeric|min:1',
                'variant_unit_type' => 'required|array',
                'variant_price'     => 'required|array',
                'variant_price.*'   => 'required|numeric|min:0',
                'variant_discount_price' => 'nullable|array',
                'delivery_zone_ids' => 'nullable|array',
                'delivery_zone_ids.*' => 'exists:delivery_zones,id',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data                       = Product::findOrFail($id);
            $data->meta_title           = $request->meta_title;
            $data->meta_description     = $request->meta_description;
            $data->meta_keywords        = $request->meta_keywords;
            $data->category_id          = $request->category_id;
            $data->name                 = $request->name;
            $data->description          = $request->description;
            $data->type                 = $request->pricing_type == 'weight' ? 'gram' : 'pcs';
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

            $data->save();

            // Sync Delivery Zones
            $data->deliveryZones()->sync($request->input('delivery_zone_ids', []));

            // Handle Product Variants
            $data->variants()->delete(); // Remove old variants
            if ($request->has('variant_quantity')) {
                foreach ($request->variant_quantity as $index => $qty) {
                    ProductVariant::create([
                        'product_id' => $data->id,
                        'variant_type' => $data->type,
                        'quantity' => $qty,
                        'unit' => $request->variant_unit_type[$index] ?? ($data->type == 'gram' ? 'gm' : 'pc'),
                        'price' => $request->variant_price[$index] ?? 0,
                        'sale_price' => $request->variant_discount_price[$index] ?? null,
                        'stock' => 100, // Default stock for now
                        'status' => 'Active',
                    ]);
                }
            }

            return redirect()->route('products.index')->with('t-success', 'Product Updated Successfully.');

        } catch (Exception $e) {
            return redirect()->route('products.index')->with('t-error', 'Product failed to update: ' . $e->getMessage());
        }
    }

    /**
     * Change the status of the specified product content.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function status(int $id): JsonResponse {
        $data = Product::findOrFail($id);
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
            $data = Product::findOrFail($id);
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

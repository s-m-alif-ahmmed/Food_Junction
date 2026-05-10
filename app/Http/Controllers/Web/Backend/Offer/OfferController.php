<?php

namespace App\Http\Controllers\Web\Backend\Offer;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Helpers\Helper;
use App\Models\Offer;
use App\Models\OfferCondition;
use App\Models\OfferReward;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;
use Exception;

class OfferController extends Controller
{
    /**
     * Display a listing of offers.
     *
     * @param Request $request
     * @return View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request): View | JsonResponse {
        if ($request->ajax()) {
            $data = Offer::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', fn($data) => e(
                    Str::limit($data->name ?? '', 25, '...')
                ))
                ->addColumn('offer_type', function ($data) {
                    return ucfirst(str_replace('_', ' ', $data->offer_type));
                })
                ->addColumn('start_date', function ($data) {
                    return $data->start_date
                        ? Carbon::parse($data->start_date)
                            ->timezone('Asia/Dhaka') // GMT+6
                            ->format('d M Y, h:i A')
                        : '';
                })
                ->addColumn('end_date', function ($data) {
                    return $data->end_date
                        ? Carbon::parse($data->end_date)
                            ->timezone('Asia/Dhaka') // GMT+6
                            ->format('d M Y, h:i A')
                        : '';
                })
                ->addColumn('location_scope', function ($data) {
                    return e(Str::ucfirst($data->location_scope ?? ''));
                })
                ->addColumn('status', function ($data) {
                    $backgroundColor  = $data->is_active ? '#4CAF50' : '#ccc';
                    $sliderTranslateX = $data->is_active ? '26px' : '2px';
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
                                <a href="' . route('offers.show', ['id' => $data->id]) . '" type="button" class="btn btn-secondary fs-14 text-white edit-icn" title="View">
                                    <i class="fe fe-eye"></i>
                                </a>
                                <a href="' . route('offers.edit', ['id' => $data->id]) . '" type="button" class="btn btn-primary fs-14 text-white edit-icn" title="Edit">
                                    <i class="fe fe-edit"></i>
                                </a>
                                <a href="#" type="button" onclick="showDeleteConfirm(' . $data->id . ')" class="btn btn-danger fs-14 text-white delete-icn" title="Delete">
                                    <i class="fe fe-trash"></i>
                                </a>
                            </div>';
                })
                ->rawColumns(['name', 'offer_type', 'location_scope', 'start_date', 'end_date', 'status', 'action'])
                ->make();
        }
        return view('backend.layouts.offer.index');
    }

    /**
     * Show the form for creating a new offer.
     *
     * @return View
     */
    public function create(): View {
        $products = Product::where('status', 'active')->get();
        return view('backend.layouts.offer.create', compact('products'));
    }

    /**
     * Store a newly created offer in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse {
        try {
            $validator = Validator::make($request->all(), [
                'name'              => 'required|string|max:255',
                'description'       => 'nullable|string',
                'priority'          => 'nullable|integer',
                'offer_type'        => 'required|in:free_delivery,discount,free_product',
                'discount_type'     => 'nullable|in:fixed,percent',
                'discount_value'    => 'nullable|numeric',
                'reward_product_id' => 'required_if:offer_type,free_product|nullable|exists:products,id',
                'reward_quantity'   => 'required_if:offer_type,free_product|nullable|integer|min:1',
                'applies_to'        => 'required|in:cart,product',
                'location_scope'    => 'required|in:dhaka,outside,all',
                'start_date'        => 'nullable|date',
                'end_date'          => 'nullable|date|after_or_equal:start_date',
                'min_cart_total'    => 'nullable|numeric|min:0',
                'product_ids'       => 'nullable|array',
                'product_ids.*'     => 'exists:products,id'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $offer = new Offer();
            $offer->name = $request->name;
            $offer->description = $request->description;
            $offer->is_active = $request->has('is_active') ? true : false;
            $offer->priority = $request->priority ?? 0;
            $offer->offer_type = $request->offer_type;
            $offer->discount_type = $request->discount_type;
            $offer->discount_value = $request->discount_value;
            $offer->applies_to = $request->applies_to;
            $offer->location_scope = $request->location_scope;
            $offer->coupon_enabled = $request->has('coupon_enabled') ? true : false;
            $offer->start_date = $request->start_date;
            $offer->end_date = $request->end_date;

            $offer->save();

            // Create Rewards
            if ($request->offer_type == 'free_delivery') {
                OfferReward::create([
                    'offer_id' => $offer->id,
                    'reward_type' => $request->location_scope == 'all' ? 'free_delivery_country' : 'free_delivery_inside_dhaka',
                ]);
            } elseif ($request->offer_type == 'free_product') {
                OfferReward::create([
                    'offer_id' => $offer->id,
                    'reward_type' => 'free_product',
                    'product_id' => $request->reward_product_id,
                    'quantity' => $request->reward_quantity,
                ]);
            } else {
                OfferReward::create([
                    'offer_id' => $offer->id,
                    'reward_type' => $request->discount_type == 'percent' ? 'discount_percent' : 'discount_amount',
                    'discount_value' => $request->discount_value,
                ]);
            }

            // Create Conditions
            if ($request->applies_to == 'product' && $request->has('product_ids')) {
                foreach ($request->product_ids as $p_id) {
                    OfferCondition::create([
                        'offer_id' => $offer->id,
                        'condition_type' => 'product_id',
                        'value' => $p_id
                    ]);
                }
            } elseif ($request->applies_to == 'cart') {
                if ($request->filled('min_cart_total') && $request->min_cart_total > 0) {
                    OfferCondition::create([
                        'offer_id' => $offer->id,
                        'condition_type' => 'cart_total',
                        'value' => $request->min_cart_total
                    ]);
                }
            }

            return redirect()->route('offers.index')->with('t-success', 'Offer Created successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Offer creation failed: ' . $e->getMessage())->withInput();
        }
    }

    public function show(int $id): View {
        $data = Offer::with(['conditions', 'rewards'])->find($id);
        return view('backend.layouts.offer.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified offer.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View {
        $data = Offer::with(['conditions', 'rewards'])->find($id);
        $products = Product::where('status', 'active')->get();
        return view('backend.layouts.offer.edit', compact('data', 'products'));
    }

    /**
     * Update the specified offer in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse {
        try {
            $validator = Validator::make($request->all(), [
                'name'              => 'required|string|max:255',
                'description'       => 'nullable|string',
                'priority'          => 'nullable|integer',
                'offer_type'        => 'required|in:free_delivery,discount,free_product',
                'discount_type'     => 'nullable|in:fixed,percent',
                'discount_value'    => 'nullable|numeric',
                'reward_product_id' => 'required_if:offer_type,free_product|nullable|exists:products,id',
                'reward_quantity'   => 'required_if:offer_type,free_product|nullable|integer|min:1',
                'applies_to'        => 'required|in:cart,product',
                'location_scope'    => 'required|in:dhaka,outside,all',
                'start_date'        => 'nullable|date',
                'end_date'          => 'nullable|date|after_or_equal:start_date',
                'min_cart_total'    => 'nullable|numeric|min:0',
                'product_ids'       => 'nullable|array',
                'product_ids.*'     => 'exists:products,id'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $offer = Offer::findOrFail($id);
            $offer->name = $request->name;
            $offer->description = $request->description;
            $offer->is_active = $request->has('is_active') ? true : false;
            $offer->priority = $request->priority ?? 0;
            $offer->offer_type = $request->offer_type;
            $offer->discount_type = $request->discount_type;
            $offer->discount_value = $request->discount_value;
            $offer->applies_to = $request->applies_to;
            $offer->location_scope = $request->location_scope;
            $offer->coupon_enabled = $request->has('coupon_enabled') ? true : false;
            $offer->start_date = $request->start_date;
            $offer->end_date = $request->end_date;

            $offer->update();

            // Handle Rewards
            $offer->rewards()->delete();
            if ($request->offer_type == 'free_delivery') {
                OfferReward::create([
                    'offer_id' => $offer->id,
                    'reward_type' => $request->location_scope == 'all' ? 'free_delivery_country' : 'free_delivery_inside_dhaka',
                ]);
            } elseif ($request->offer_type == 'free_product') {
                OfferReward::create([
                    'offer_id' => $offer->id,
                    'reward_type' => 'free_product',
                    'product_id' => $request->reward_product_id,
                    'quantity' => $request->reward_quantity,
                ]);
            } else {
                OfferReward::create([
                    'offer_id' => $offer->id,
                    'reward_type' => $request->discount_type == 'percent' ? 'discount_percent' : 'discount_amount',
                    'discount_value' => $request->discount_value,
                ]);
            }

            // Handle Conditions
            $offer->conditions()->delete();
            if ($request->applies_to == 'product' && $request->has('product_ids')) {
                foreach ($request->product_ids as $p_id) {
                    OfferCondition::create([
                        'offer_id' => $offer->id,
                        'condition_type' => 'product_id',
                        'value' => $p_id
                    ]);
                }
            } elseif ($request->applies_to == 'cart') {
                if ($request->filled('min_cart_total') && $request->min_cart_total > 0) {
                    OfferCondition::create([
                        'offer_id' => $offer->id,
                        'condition_type' => 'cart_total',
                        'value' => $request->min_cart_total
                    ]);
                }
            }

            return redirect()->route('offers.index')->with('t-success', 'Offer Updated Successfully.');

        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Offer failed to update: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Change the status of the specified offer.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function status(int $id): JsonResponse {
        $data = Offer::findOrFail($id);
        if ($data->is_active) {
            $data->is_active = false;
            $data->save();

            return response()->json([
                'success' => false,
                'message' => 'Offer deactivated successfully.',
                'data'    => $data,
            ]);
        } else {
            $data->is_active = true;
            $data->save();

            return response()->json([
                'success' => true,
                'message' => 'Offer activated successfully.',
                'data'    => $data,
            ]);
        }
    }

    /**
     * Remove the specified offer from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse {
        try {
            $data = Offer::findOrFail($id);
            $data->rewards()->delete(); // remove rewards
            $data->conditions()->delete(); // remove conditions
            $data->delete();

            return response()->json([
                'success' => true,
                'message' => 'Offer deleted successfully.',
            ]);
        } catch (Exception) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete the Offer.',
            ]);
        }
    }
}

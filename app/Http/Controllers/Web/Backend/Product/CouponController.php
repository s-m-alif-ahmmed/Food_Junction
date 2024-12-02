<?php

namespace App\Http\Controllers\Web\Backend\Product;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class CouponController extends Controller
{
    /**
     * Display a listing of coupon content.
     *
     * @param Request $request
     * @return View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request): View | JsonResponse {
        if ($request->ajax()) {
            $data = Coupon::latest()->get();
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
                                <a href="' . route('coupons.show', ['id' => $data->id]) . '" type="button" class="btn btn-secondary fs-14 text-white edit-icn" title="Edit">
                                    <i class="fe fe-eye"></i>
                                </a>
                                <a href="' . route('coupons.edit', ['id' => $data->id]) . '" type="button" class="btn btn-primary fs-14 text-white edit-icn" title="Edit">
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
        return view('backend.layouts.coupon.index');
    }

    /**
     * Show the form for creating a new sweet content.
     *
     * @return View
     */
    public function create(): View {
        return view('backend.layouts.coupon.create');
    }

    /**
     * Store a newly created coupon content in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse {
        try {
            $validator = Validator::make($request->all(), [
                'code'              => 'required|string|max:20',
                'name'              => 'required|string|max:100',
                'max_uses'          => 'required',
                'max_uses_user'     => 'nullable',
                'type'              => 'required',
                'discount_amount'   => 'required',
                'min_amount'        => 'required', // Max 200KB
                'starts_at'         => 'required',
                'expires_at'        => 'required',
                'discount_price'    => 'required',
                'status'            => 'nullable',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data                       = new Coupon();
            $data->code                 = $request->code;
            $data->name                 = $request->name;
            $data->max_uses             = $request->max_uses;
            $data->max_uses_user        = $request->max_uses_user;
            $data->type                 = $request->type;
            $data->discount_amount      = $request->discount_amount;
            $data->min_amount           = $request->min_amount;
            $data->starts_at            = $request->starts_at;
            $data->expires_at           = $request->expires_at;
            $data->status               = $request->status;
            $data->save();

            return redirect()->route('coupons.index')->with('t-success', 'Updated successfully');
        } catch (Exception) {
            return redirect()->route('coupons.index')->with('t-success', 'Coupon failed created.');
        }
    }

    public function show(int $id): View {
        $data = Coupon::find($id);
        return view('backend.layouts.coupon.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified coupon content.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View {
        $data = Coupon::find($id);
        return view('backend.layouts.coupon.edit', compact('data'));
    }

    /**
     * Update the specified coupon content in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse {
        try {
            $validator = Validator::make($request->all(), [
                'code'              => 'required|string|max:20',
                'name'              => 'required|string|max:100',
                'max_uses'          => 'required',
                'max_uses_user'     => 'nullable',
                'type'              => 'required',
                'discount_amount'   => 'required',
                'min_amount'        => 'required', // Max 200KB
                'starts_at'         => 'required',
                'expires_at'        => 'required',
                'discount_price'    => 'required',
                'status'            => 'nullable',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data                       = Coupon::findOrFail($id);
            $data->code                 = $request->code;
            $data->name                 = $request->name;
            $data->max_uses             = $request->max_uses;
            $data->max_uses_user        = $request->max_uses_user;
            $data->type                 = $request->type;
            $data->discount_amount      = $request->discount_amount;
            $data->min_amount           = $request->min_amount;
            $data->starts_at            = $request->starts_at;
            $data->expires_at           = $request->expires_at;
            $data->status               = $request->status;
            $data->update();

            return redirect()->route('coupons.index')->with('t-success', 'Coupon Updated Successfully.');

        } catch (Exception) {
            return redirect()->route('coupons.index')->with('t-success', 'Coupon failed to update');
        }
    }

    /**
     * Change the status of the specified coupon content.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function status(int $id): JsonResponse {
        $data = Coupon::findOrFail($id);
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
     * Remove the specified coupon content from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse {
        try {
            $data = Coupon::findOrFail($id);
            $data->delete();

            return response()->json([
                'success' => true,
                'message' => 'Coupon deleted successfully.',
            ]);
        } catch (Exception) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete the Coupon.',
            ]);
        }
    }
}

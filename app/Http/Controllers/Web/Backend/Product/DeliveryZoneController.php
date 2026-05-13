<?php

namespace App\Http\Controllers\Web\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\DeliveryZone;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class DeliveryZoneController extends Controller
{
    /**
     * Display a listing of all delivery zones.
     */
    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax()) {
            $data = DeliveryZone::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
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
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group btn-group-sm">'
                         . '<a href="'.route('delivery-zones.edit', $row->id).'" class="btn btn-primary fs-14 text-white" title="Edit"><i class="fe fe-edit"></i></a>'
                         . '<a href="#" onclick="showDeleteConfirm('.$row->id.')" class="btn btn-danger fs-14 text-white" title="Delete"><i class="fe fe-trash"></i></a>'
                         . '</div>';
                })
                ->rawColumns(['status', 'action'])
                ->make();
        }

        return view('backend.layouts.delivery-zone.index');
    }

    /**
     * Show the form for creating a new delivery zone.
     */
    public function create(): View
    {
        return view('backend.layouts.delivery-zone.create');
    }

    /**
     * Store a newly created delivery zone.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'name'            => 'required|string|max:100|unique:delivery_zones,name',
                'delivery_charge' => 'required|numeric|min:0',
                'status'          => 'required|in:active,inactive',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DeliveryZone::create([
                'name'            => $request->name,
                'slug'            => Str::slug($request->name),
                'delivery_charge' => $request->delivery_charge,
                'status'          => $request->status,
            ]);

            return redirect()->route('delivery-zones.index')->with('t-success', 'Delivery Zone created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Failed to create: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for editing a delivery zone.
     */
    public function edit(int $id): View
    {
        $data = DeliveryZone::findOrFail($id);
        return view('backend.layouts.delivery-zone.edit', compact('data'));
    }

    /**
     * Update the specified delivery zone.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'name'            => 'required|string|max:100|unique:delivery_zones,name,' . $id,
                'delivery_charge' => 'required|numeric|min:0',
                'status'          => 'required|in:active,inactive',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $zone = DeliveryZone::findOrFail($id);
            $zone->update([
                'name'            => $request->name,
                'slug'            => Str::slug($request->name),
                'delivery_charge' => $request->delivery_charge,
                'status'          => $request->status,
            ]);

            return redirect()->route('delivery-zones.index')->with('t-success', 'Delivery Zone updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Failed to update: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Toggle the status of a delivery zone.
     */
    public function status(int $id): JsonResponse
    {
        $zone = DeliveryZone::findOrFail($id);
        $zone->status = $zone->status === 'active' ? 'inactive' : 'active';
        $zone->save();

        return response()->json([
            'success' => $zone->status === 'active',
            'message' => $zone->status === 'active' ? 'Activated successfully.' : 'Deactivated successfully.',
            'data'    => $zone,
        ]);
    }

    /**
     * Delete a delivery zone.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $zone = DeliveryZone::findOrFail($id);
            $zone->products()->detach(); // remove pivot rows first
            $zone->delete();

            return response()->json(['success' => true, 'message' => 'Delivery Zone deleted successfully.']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete: ' . $e->getMessage()]);
        }
    }
}

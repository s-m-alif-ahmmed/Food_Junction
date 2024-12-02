<?php

namespace App\Http\Controllers\Web\Backend\Order;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of dynamic page content.
     *
     * @param Request $request
     * @return View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request): View | JsonResponse {
        if ($request->ajax()) {
            $data = Order::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('created_at', function ($data) {
                    $created_at = $data->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia');
                    return $created_at;
                })
                ->addColumn('tracking_id', function ($data) {
                    $tracking_id = $data->tracking_id;
                    return $tracking_id;
                })
                ->addColumn('name', function ($data) {
                    $name = $data->name;
                    return $name;
                })
                ->addColumn('email', function ($data) {
                    $email = $data->email;
                    return $email;
                })
                ->addColumn('number', function ($data) {
                    $number = $data->number;
                    return $number;
                })
                ->addColumn('order_total', function ($data) {
                    $order_total = $data->order_total;
                    return $order_total;
                })
                ->addColumn('status', function ($data) {
                    $status = $data->status;
                    return $status;
                })
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                <a href="' . route('orders.show', ['id' => $data->id]) . '" type="button" class="btn btn-secondary fs-14 text-white edit-icn" title="Edit">
                                    <i class="fe fe-eye"></i>
                                </a>
                                <a href="#" type="button" onclick="showDeleteConfirm(' . $data->id . ')" class="btn btn-danger fs-14 text-white delete-icn" title="Delete">
                                    <i class="fe fe-trash"></i>
                                </a>
                            </div>';
                })
                ->rawColumns(['name', 'status', 'action'])
                ->make();
        }
        return view('backend.layouts.order.index');
    }

    public function show(int $id): View {
        $data = Order::find($id);
        return view('backend.layouts.order.detail', compact('data'));
    }

    public function sweets(int $id): View {
        $data = Order::find($id);
        $order_data = OrderDetail::where('order_id', $order->id)->latest()->get();
        return view('backend.layouts.order.order-sweets', compact('data','order_data'));
    }

    public function invoice(int $id): View {
        $data = Order::find($id);
        return view('backend.layouts.order.invoice', compact('data'));
    }

    /**
     * Change the status of the specified sweet content.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function status(int $id): JsonResponse {
        $data = Order::findOrFail($id);
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

//    public function changeOrderStatus(Request $request, $id)
//    {
//        try {
//            $order = Order::findOrFail($id);
//            $status = $request->input('status');
//            $order->update(['status' => $status]);
//
//            return back()->with('message', 'Order status changed successfully.');
//        } catch (\Exception $e) {
//            return view('error_pages.error');
//        }
//    }
//<td>
//<form action="{{ route('change.status.order', $order->id) }}" method="POST">
//@csrf
//<select name="status" onchange="this.form.submit()" class="form-control">
//<option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
//                                            <option value="Complete" {{ $order->status == 'Complete' ? 'selected' : '' }}>Complete</option>
//                                            <option value="Return" {{ $order->status == 'Return' ? 'selected' : '' }}>Return</option>
//                                            <option value="Canceled" {{ $order->status == 'Canceled' ? 'selected' : '' }}>Canceled</option>
//                                        </select>
//                                    </form>
//                                </td>

    /**
     * Remove the specified Sweet content from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse {
        try {
            $data = Order::findOrFail($id);
            $data->delete();

            return response()->json([
                'success' => true,
                'message' => 'Sweet deleted successfully.',
            ]);
        } catch (Exception) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete the Sweet.',
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers\Web\Backend\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of all orders via DataTables.
     */
    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax()) {
            $data = Order::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('created_at', fn($row) =>
                    $row->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia')
                )
                ->addColumn('tracking_id', fn($row) => $row->tracking_id)
                ->addColumn('name',        fn($row) => e($row->name))
                ->addColumn('number',      fn($row) => $row->number)
                ->addColumn('delivery_zone', fn($row) =>
                    $row->delivery_zone
                        ? '<span class="badge ' . ($row->delivery_zone === 'dhaka' ? 'bg-info' : 'bg-secondary') . '">'
                            . ucfirst($row->delivery_zone) . '</span>'
                        : '<span class="badge bg-light text-dark">—</span>'
                )
                ->addColumn('final_total', fn($row) =>
                    '<strong>Tk ' . number_format($row->final_total, 2) . '</strong>'
                )
                ->addColumn('status', function ($row) {
                    $statuses = [
                        'pending'  => 'warning',
                        'complete' => 'success',
                        'return'   => 'secondary',
                        'canceled' => 'danger',
                    ];
                    $options = '';
                    foreach ($statuses as $value => $color) {
                        $selected = $row->status === $value ? 'selected' : '';
                        $options .= "<option value=\"{$value}\" {$selected}>" . ucfirst($value) . "</option>";
                    }
                    return '<select name="status"
                                    data-id="' . $row->id . '"
                                    data-previous-status="' . $row->status . '"
                                    onchange="showStatusChangeAlert(' . $row->id . ', this.value)"
                                    class="form-select form-select-sm status-select">
                                ' . $options . '
                            </select>';
                })
                ->addColumn('action', fn($row) =>
                    '<div class="btn-group btn-group-sm" role="group">
                        <a href="' . route('orders.show', $row->id) . '"
                           class="btn btn-secondary text-white" title="View">
                            <i class="fe fe-eye"></i>
                        </a>
                        <a href="' . route('orders.invoice', $row->id) . '"
                           class="btn btn-info text-white" title="Invoice">
                            <i class="fe fe-file-text"></i>
                        </a>
                        <button type="button"
                                onclick="showDeleteConfirm(' . $row->id . ')"
                                class="btn btn-danger text-white" title="Delete">
                            <i class="fe fe-trash"></i>
                        </button>
                    </div>'
                )
                ->rawColumns(['delivery_zone', 'final_total', 'status', 'action'])
                ->make();
        }

        return view('backend.layouts.order.index');
    }

    /**
     * Show order detail page.
     */
    public function show(int $id): View
    {
        $data = Order::with(['items.product', 'coupon', 'user'])->findOrFail($id);
        return view('backend.layouts.order.detail', compact('data'));
    }

    /**
     * Show order products page.
     */
    public function products(int $id): View
    {
        $data       = Order::with('user')->findOrFail($id);
        $order_data = OrderDetail::with('product')->where('order_id', $id)->latest()->get();
        return view('backend.layouts.order.order-products', compact('data', 'order_data'));
    }

    /**
     * Show invoice page.
     */
    public function invoice(int $id): View
    {
        $data       = Order::with(['user', 'coupon'])->findOrFail($id);
        $order_data = OrderDetail::with('product')->where('order_id', $id)->latest()->get();
        return view('backend.layouts.order.invoice', compact('data', 'order_data'));
    }

    /**
     * Update order status via AJAX.
     */
    public function status(Request $request, int $id): JsonResponse
    {
        $request->validate([
            'status' => 'required|in:pending,complete,return,canceled',
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Order status updated to ' . ucfirst($request->status) . '.',
            'data'    => $order,
        ]);
    }

    /**
     * Delete an order (soft delete).
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $order = Order::findOrFail($id);
            $order->delete();

            return response()->json([
                'success' => true,
                'message' => 'Order deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete the order.',
            ]);
        }
    }
}

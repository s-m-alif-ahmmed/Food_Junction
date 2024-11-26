<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class ContactController extends Controller
{

    public function contact(): View {
        return view('frontend.pages.contact');
    }

    public function store(Request $request): RedirectResponse {
        try {
            $validator = Validator::make($request->all(), [
                'name'      => 'nullable|string|max:100',
                'email'     => 'required|email|max:100',
                'number'    => 'required|string|min:10|max:14',
                'subject'   => 'nullable|string',
                'message'   => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            Contact::create($request->only(['name', 'email', 'number', 'subject', 'message']));

            return redirect()->route('contact')->with('t-success', 'Message sent successfully.');
        } catch (\Exception $e) {
            return redirect()->route('contact')->with('t-error', 'Message sending failed!');
        }
    }

    /**
     * Display a listing of all users.
     *
     * @param Request $request
     * @return JsonResponse|View
     */
    public function index(Request $request): JsonResponse | View {
        if ($request->ajax()) {
            $data = Contact::whereNull('deleted_at')
                ->latest()
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('email', function ($data) {
                    $email = $data->email;
                    return $email;
                })
                ->addColumn('subject', function ($data) {
                    $subject = $data->subject;
                    return $subject;
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
                                 <a href="' . route('contact.show', ['id' => $data->id]) . '" type="button" class="btn btn-primary fs-14 text-white edit-icn" title="Edit">
                                    <i class="fe fe-eye"></i>
                                </a>
                                <a href="#" type="button" onclick="showDeleteConfirm(' . $data->id . ')" class="btn btn-danger fs-14 text-white delete-icn" title="Delete">
                                    <i class="fe fe-trash"></i>
                                </a>
                            </div>';
                })
                ->rawColumns(['email','subject', 'status', 'action'])
                ->make();
        }
        return view('backend.layouts.contact.index');
    }

    public function show(int $id): View {
        $data = Contact::find($id);
        return view('backend.layouts.contact.detail', compact('data'));
    }


    /**
     * Change the status of the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function status(int $id): JsonResponse {
        $data = Contact::findOrFail($id);
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
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse {
        $data = Contact::findOrFail($id);
        $data->delete();
        return response()->json([
            't-success' => true,
            'message'   => 'Deleted successfully.',
        ]);
    }

}

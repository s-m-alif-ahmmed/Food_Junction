<?php

namespace App\Http\Controllers\Web\Backend\Settings;

use App\Http\Controllers\Controller;
use App\Models\ScriptSetting;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class ScriptController extends Controller
{
    /**
     * Display a listing of the script settings.
     *
     * @param Request $request
     * @return View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request): View | JsonResponse {
        if ($request->ajax()) {
            $data = ScriptSetting::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('place', function ($data) {
                    return ucfirst($data->place);
                })
                ->addColumn('status', function ($data) {
                    $backgroundColor  = $data->status == "active" ? '#4CAF50' : '#ccc';
                    $sliderTranslateX = $data->status == "active" ? '26px' : '2px';
                    $sliderStyles     = "position: absolute; top: 2px; left: 2px; width: 20px; height: 20px; background-color: white; border-radius: 50%; transition: transform 0.3s ease; transform: translateX($sliderTranslateX);";

                    $status = '<div class="form-check form-switch" style="margin-left:40px; position: relative; width: 50px; height: 24px; background-color: ' . $backgroundColor . '; border-radius: 12px; transition: background-color 0.3s ease; cursor: pointer;">';
                    $status .= '<input onclick="showStatusChangeAlert(' . $data->id . ')" type="checkbox" class="form-check-input" id="customSwitch' . $data->id . '" name="status" style="position: absolute; width: 100%; height: 100%; opacity: 0; z-index: 2; cursor: pointer;">';
                    $status .= '<span style="' . $sliderStyles . '"></span>';
                    $status .= '</div>';

                    return $status;
                })
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group btn-group-sm" role="group">
                                <a href="' . route('scripts.edit', ['id' => $data->id]) . '" class="btn btn-primary fs-14 text-white edit-icn" title="Edit">
                                    <i class="fe fe-edit"></i>
                                </a>
                                <a href="#" onclick="showDeleteConfirm(' . $data->id . ')" class="btn btn-danger fs-14 text-white delete-icn" title="Delete">
                                    <i class="fe fe-trash"></i>
                                </a>
                            </div>';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('backend.layouts.settings.scripts.index');
    }

    /**
     * Show the form for creating a new script setting.
     *
     * @return View
     */
    public function create(): View {
        return view('backend.layouts.settings.scripts.create');
    }

    /**
     * Store a newly created script setting in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse {
        $request->validate([
            'name' => 'required|string|max:255',
            'place' => 'required|in:header,footer',
            'script' => 'nullable|string',
        ]);

        try {
            ScriptSetting::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'place' => $request->place,
                'script' => $request->script,
                'status' => 'active',
            ]);

            return redirect()->route('scripts.index')->with('t-success', 'Script added successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Failed to add script: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified script setting.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View {
        $data = ScriptSetting::findOrFail($id);
        return view('backend.layouts.settings.scripts.edit', compact('data'));
    }

    /**
     * Update the specified script setting in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse {
        $request->validate([
            'name' => 'required|string|max:255',
            'place' => 'required|in:header,footer',
            'script' => 'nullable|string',
        ]);

        try {
            $data = ScriptSetting::findOrFail($id);
            $data->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'place' => $request->place,
                'script' => $request->script,
            ]);

            return redirect()->route('scripts.index')->with('t-success', 'Script updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Failed to update script: ' . $e->getMessage());
        }
    }

    /**
     * Change the status of the specified script setting.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function status(int $id): JsonResponse {
        $data = ScriptSetting::findOrFail($id);
        $data->status = $data->status == 'active' ? 'inactive' : 'active';
        $data->save();

        return response()->json([
            'success' => true,
            'message' => 'Status changed successfully.',
            'data' => $data,
        ]);
    }

    /**
     * Remove the specified script setting from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse {
        try {
            $data = ScriptSetting::findOrFail($id);
            $data->delete();

            return response()->json([
                'success' => true,
                'message' => 'Script deleted successfully.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete script.',
            ]);
        }
    }
}


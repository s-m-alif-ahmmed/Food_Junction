<?php

namespace App\Http\Controllers\Web\Backend\Product;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of category content.
     *
     * @param Request $request
     * @return View|JsonResponse
     * @throws Exception
     */
    public function index(Request $request): View | JsonResponse {
        if ($request->ajax()) {
            $data = Category::latest()->get();
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
                                <a href="' . route('categories.show', ['id' => $data->id]) . '" type="button" class="btn btn-secondary fs-14 text-white edit-icn" title="Edit">
                                    <i class="fe fe-eye"></i>
                                </a>
                                <a href="' . route('categories.edit', ['id' => $data->id]) . '" type="button" class="btn btn-primary fs-14 text-white edit-icn" title="Edit">
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
        return view('backend.layouts.category.index');
    }

    /**
     * Show the form for creating a new category content.
     *
     * @return View
     */
    public function create(): View {
        return view('backend.layouts.category.create');
    }

    /**
     * Store a newly created category content in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse {
        try {
            $validator = Validator::make($request->all(), [
                'meta_title'        => 'required|string',
                'meta_description'  => 'required|string|min:160|max:255',
                'meta_keywords'     => 'required|string',
                'name'              => 'required|string|max:100',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data                       = new Category();
            $data->meta_title           = $request->meta_title;
            $data->meta_description     = $request->meta_description;
            $data->meta_keywords        = $request->meta_keywords;
            $data->name                 = $request->name;
            $data->category_slug         = Str::slug($request->name);
            $data->save();

            return redirect()->route('categories.index')->with('t-success', 'Updated successfully');
        } catch (Exception) {
            return redirect()->route('categories.index')->with('t-success', 'Category failed created.');
        }
    }

    public function show(int $id): View {
        $data = Category::find($id);
        return view('backend.layouts.category.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified category content.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View {
        $data = Category::find($id);
        return view('backend.layouts.category.edit', compact('data'));
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
                'meta_description'  => 'required|string|min:160|max:255',
                'meta_keywords'     => 'required|string',
                'name'              => 'required|string|max:100',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data                       = Category::findOrFail($id);
            $data->meta_title           = $request->meta_title;
            $data->meta_description     = $request->meta_description;
            $data->meta_keywords        = $request->meta_keywords;
            $data->name                 = $request->name;
            $data->category_slug         = Str::slug($request->name);
            $data->update();

            return redirect()->route('categories.index')->with('t-success', 'Category Updated Successfully.');

        } catch (Exception) {
            return redirect()->route('categories.index')->with('t-success', 'Category failed to update');
        }
    }

    /**
     * Change the status of the specified category content.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function status(int $id): JsonResponse {
        $data = Category::findOrFail($id);
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
     * Remove the specified category content from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse {
        try {
            $data = Category::findOrFail($id);
            $data->delete();

            return response()->json([
                'success' => true,
                'message' => 'Category deleted successfully.',
            ]);
        } catch (Exception) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete the Category.',
            ]);
        }
    }
}

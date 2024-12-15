<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;
use Wavey\Sweetalert\Sweetalert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Category::all();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('count_product', function($row){
                            return count($row->products);
                    })
                    ->rawColumns(['count_product'])
                    ->make(true);
        }

        return view('admin.category.index');

        // $categories = Category::all();
        // return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create'); // Return a view for adding a new category
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate and store the new category
        $validatedData = $request->validate([
            'name' => 'required|unique:categories,name|max:255|min:3',
        ]);

        Category::create($validatedData);

        Sweetalert::success('Category added successfully!', 'Success');
        return redirect()->route('categories.index')->with('success', 'Category added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $Category)
    {
        try {
            // Find the category by ID
            $category = $Category;
            // Return the category details as a JSON response
            return response()->json([
                'id' => $category->id,
                'name' => $category->name,
                'count_product' => $category->products->count(),
                'products' => $category->products,
            ], 200);
        } catch (\Exception $e) {
            // Return an error response if the category is not found
            return response()->json([
                'message' => 'Category not found.',
            ], 404);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255|min:3|unique:categories,name,' . $category->id,
        ]);

        $category->update($validatedData);

        Sweetalert::success('Category updated successfully!', 'Success');
        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();

            return response()->json([
                'success' => true,
                'message' => 'Category deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete category.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

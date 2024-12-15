<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Wavey\Sweetalert\Sweetalert;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::all();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('category_name', function($row){
                        return $row->category->name;
                    })
                    ->addColumn('price', function($row){
                        return "$".$row->price;
                    })
                    ->rawColumns(['category_name','price'])
                    ->make(true);
        }

        return view('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('admin.products.create',compact('categories')); // Return a view for adding a new category
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate and store the new category
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
        ]);

        Product::create([
            'name' => $request->name,
            'category_id' => $request->category,
            'price' => $request->price,
        ]);

        Sweetalert::success('Product added successfully!', 'Success');
        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        try {
            // Find the product by ID
            $product = $product;
            // Return the product details as a JSON response
            return response()->json([
                'id' => $product->id,
                'name' => $product->name,
                'category' => $product->category->name,
                'price' => $product->price,
            ], 200);
        } catch (\Exception $e) {
            // Return an error response if the Product is not found
            return response()->json([
                'message' => 'Product not found.',
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::get();
        return view('admin.products.edit', compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // Validate input data
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
        ]);

        $product->update([
            'name' => $request->name,
            'category_id' => $request->category,
            'price' => $request->price,
        ]);

        Sweetalert::success('Product updated successfully!', 'Success');
        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();

            return response()->json([
                'success' => true,
                'message' => 'Product deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete Product.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

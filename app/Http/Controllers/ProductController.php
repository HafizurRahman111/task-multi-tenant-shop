<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Services\MenuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        $items = $user->role === 'admin'
            ? Product::all()
            : Product::where('tenant_id', $request->tenant_id ?? $user->tenant_id)
                ->where('created_by', $user->id)
                ->get();

        $routes = [
            'create' => $user->role === 'admin' ? 'admin.products.create' : 'merchant.products.create',
            'view' => $user->role === 'admin' ? 'admin.products.show' : 'merchant.products.show',
            'edit' => $user->role === 'admin' ? 'admin.products.edit' : 'merchant.products.edit',
            'delete' => $user->role === 'admin' ? 'admin.products.destroy' : 'merchant.products.destroy',
        ];

        $menuOptions = $this->menuService->getMenuOptions();

        return view('products.index', compact('items', 'menuOptions', 'routes', 'user'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        $categories = $user->role === 'admin'
            ? Category::with('store')->get()
            : Category::where('tenant_id', $user->tenant_id)->with('store')->get();

        $routes = [
            'index' => $user->role === 'admin' ? 'admin.products.index' : 'merchant.products.index',
            'store' => $user->role === 'admin' ? 'admin.products.store' : 'merchant.products.store',
        ];

        $menuOptions = $this->menuService->getMenuOptions();

        return view('products.create', compact('menuOptions', 'routes', 'user', 'categories'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'product_name' => 'required|string|max:250',
            'description' => 'required|string|max:500',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $imagePath = null;
        $imageName = null;
        if ($request->hasFile('image')) {
            $directoryPath = 'assets/images/products/';

            $imageName = 'p_' . time() . '.' . $request->file('image')->getClientOriginalExtension();

            $request->file('image')->move(public_path($directoryPath), $imageName);
            // $imagePath = $directoryPath . $imageName;
        }

        $sku = Product::generateSKU($request->category_id, $request->product_name);

        Product::create([
            'tenant_id' => $user->tenant_id,
            'category_id' => $request->category_id,
            'sku' => $sku,
            'name' => $request->product_name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imageName,
            'created_by' => auth()->id()
        ]);

        return redirect()->route($user->role . '.products.index')->with('success', 'Product created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $user = auth()->user();
        $categories = $user->role === 'admin'
            ? Category::with('store')->get()
            : Category::where('tenant_id', $user->tenant_id)->with('store')->get();

        $routes = [
            'index' => $user->role === 'admin' ? 'admin.products.index' : 'merchant.products.index',
            'update' => $user->role === 'admin' ? 'admin.products.update' : 'merchant.products.update',
        ];

        $menuOptions = $this->menuService->getMenuOptions();

        return view('products.edit', compact('menuOptions', 'routes', 'categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'product_name' => 'required|string|max:250',
            'description' => 'required|string|max:500',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $imagePath = $product->image;
        $imageName = $product->image;
        if ($request->hasFile('image')) {
            if ($product->image && file_exists(public_path('assets/images/products/' . $product->image))) {
                unlink(public_path('assets/images/products/' . $product->image));
            }

            $directoryPath = 'assets/images/products/';
            $imageName = 'p_' . time() . '.' . $request->file('image')->getClientOriginalExtension();

            $request->file('image')->move(public_path($directoryPath), $imageName);
        }

        $product->update([
            'category_id' => $request->input('category_id'),
            'name' => $request->input('product_name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'image' => $imageName,
            'updated_by' => $user->id,
        ]);

        return redirect()->route($user->role . '.products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $user = Auth::user();
        $product->delete();

        return redirect()->route($user->role . '.products.index')->with('success', 'Product deleted successfully!');
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Services\MenuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
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
            ? Category::all()
            : Category::where('tenant_id', $request->tenant_id ?? $user->tenant_id)
                ->where('created_by', $user->id)
                ->get();

        $routes = [
            'create' => $user->role === 'admin' ? 'admin.categories.create' : 'merchant.categories.create',
            'view' => $user->role === 'admin' ? 'admin.categories.show' : 'merchant.categories.show',
            'edit' => $user->role === 'admin' ? 'admin.categories.edit' : 'merchant.categories.edit',
            'delete' => $user->role === 'admin' ? 'admin.categories.destroy' : 'merchant.categories.destroy',
        ];

        $menuOptions = $this->menuService->getMenuOptions();

        return view('categories.index', compact('items', 'menuOptions', 'routes', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        $stores = $user->role === 'admin'
            ? Store::all()
            : Store::where('tenant_id', $user->tenant_id)->get();

        $routes = [
            'index' => $user->role === 'admin' ? 'admin.categories.index' : 'merchant.categories.index',
            'store' => $user->role === 'admin' ? 'admin.categories.store' : 'merchant.categories.store',
        ];

        $menuOptions = $this->menuService->getMenuOptions();

        return view('categories.create', compact('menuOptions', 'routes', 'user', 'stores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'store_id' => 'required|exists:stores,id',
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories')->where(function ($query) use ($request) {
                    return $query->where('store_id', $request->store_id);
                }),
            ],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $baseSlug = Str::slug($request->name, '_');
        $slug = $baseSlug;
        $counter = 1;

        while (DB::table('categories')->where('slug', $slug)->exists()) {
            $slug = $baseSlug . '_' . $counter;
            $counter++;
        }

        $category = Category::create([
            'tenant_id' => $user->tenant_id,
            'store_id' => $request->store_id,
            'name' => $request->name,
            'slug' => $slug,
            'created_by' => $user->id,
        ]);

        return redirect()->route($user->role . '.categories.index')->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $user = auth()->user();
        $stores = $user->role === 'admin'
            ? Store::all()
            : Store::where('tenant_id', $user->tenant_id)->get();

        $routes = [
            'index' => $user->role === 'admin' ? 'admin.categories.index' : 'merchant.categories.index',
            'update' => $user->role === 'admin' ? 'admin.categories.update' : 'merchant.categories.update',
        ];

        $menuOptions = $this->menuService->getMenuOptions();

        return view('categories.edit', compact('menuOptions', 'routes', 'stores', 'category'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'store_id' => 'required|exists:stores,id',
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories')->where(function ($query) use ($request) {
                    return $query->where('store_id', $request->store_id);
                })->ignore($category->id),
            ],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $baseSlug = Str::slug($request->name, '_');
        $slug = $baseSlug;
        $counter = 1;

        while (DB::table('categories')->where('slug', $slug)->exists()) {
            $slug = $baseSlug . '_' . $counter;
            $counter++;
        }

        $category->update([
            'store_id' => $request->store_id,
            'name' => $request->name,
            'slug' => $slug,
            'updated_by' => $user->id,
        ]);

        return redirect()->route($user->role . '.categories.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $user = Auth::user();
        $category->delete();

        return redirect()->route($user->role . '.categories.index')
            ->with('success', 'Category deleted successfully!');
    }

}

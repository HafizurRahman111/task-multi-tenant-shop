<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Services\MenuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
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
            ? Store::all()
            : Store::where('tenant_id', $request->tenant_id ?? $user->tenant_id)
                ->where('created_by', $user->id)
                ->get();

        $routes = $this->getRoutes($user, ['create', 'view', 'edit', 'delete']);
        $menuOptions = $this->menuService->getMenuOptions();

        return view('stores.index', compact('items', 'menuOptions', 'routes', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();

        [$tenants, $selectedTenantId] = $this->getTenantData($user);

        $routes = $this->getRoutes($user, ['index', 'create', 'store']);
        $menuOptions = $this->menuService->getMenuOptions();

        return view('stores.create', compact('menuOptions', 'routes', 'user', 'tenants', 'selectedTenantId'));
    }

    protected function getTenantData($user)
    {
        if ($user->role === 'admin') {
            return [Tenant::all(), null];
        }

        return [Tenant::where('id', $user->tenant_id)->get(), $user->tenant_id];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $tenant_id = $user->role === 'admin' ? $request->tenant_id : $user->tenant_id;

        $rules = [
            'name' => 'required|string|max:255',
            'website' => 'required|url|max:255|unique:stores,website',
            'phone' => 'nullable|string|max:20',
        ];

        if ($user->role === 'admin') {
            $rules['tenant_id'] = 'required|exists:tenants,id';
        }

        $validatedData = $request->validate($rules);

        $slug = Str::slug($validatedData['name'], '_');
        $originalSlug = $slug;
        $count = 1;

        while (Store::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '_' . $count;
            $count++;
        }

        $store = Store::create([
            'tenant_id' => $tenant_id,
            'name' => $validatedData['name'],
            'slug' => $slug,
            'website' => $validatedData['website'],
            'phone' => $validatedData['phone'],
            'created_by' => $user->id,
        ]);

        return redirect()->route($user->role . '.stores.index')->with('success', 'Store created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Store $store)
    {
        $user = auth()->user();
        [$tenants, $selectedTenantId] = $this->getTenantData($user);

        $routes = $this->getRoutes($user, ['index', 'update']);
        $menuOptions = $this->menuService->getMenuOptions();

        return view('stores.edit', compact('menuOptions', 'store', 'routes', 'user', 'tenants', 'selectedTenantId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Store $store)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'tenant_id' => 'required|exists:tenants,id',
            'name' => 'required|string|max:255',
            'website' => [
                'required',
                'url',
                'max:255',
                Rule::unique('stores', 'website')->ignore($store->id)
            ],
            'phone' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();
        $validatedData['updated_by'] = $user->id;

        if ($validatedData['name'] !== $store->name) {
            $slug = Str::slug($validatedData['name'], '_');
            $originalSlug = $slug;
            $count = 1;

            while (Store::where('slug', $slug)->where('id', '!=', $store->id)->exists()) {
                $slug = $originalSlug . '_' . $count;
                $count++;
            }

            $validatedData['slug'] = $slug;
        }

        $store->update($validatedData);

        return redirect()->route($user->role . '.stores.index')->with('success', 'Store updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        $user = Auth::user();
        $store->delete();

        return redirect()->route($user->role . '.stores.index')->with('success', 'Store deleted successfully!');
    }

    // shop show page 
    public function shopShow($shop_name)
    {
        $store = Store::where('slug', $shop_name)->first();

        if (!$store) {
            abort(404, 'Store not found');
        }

        $categories = Category::where('store_id', $store->id)->get();

        return view('shop', compact('store', 'categories'));
    }

    /**
     * Define specific routes based on user role and requested keys.
     */
    protected function getRoutes($user, array $routeKeys = [])
    {
        $prefix = $user->role === 'admin' ? 'admin' : 'merchant';

        $allRoutes = [
            'index' => "{$prefix}.stores.index",
            'store' => "{$prefix}.stores.store",
            'create' => "{$prefix}.stores.create",
            'view' => "{$prefix}.stores.show",
            'edit' => "{$prefix}.stores.edit",
            'update' => "{$prefix}.stores.update",
            'delete' => "{$prefix}.stores.destroy",
        ];

        if (empty($routeKeys)) {
            return $allRoutes;
        }

        return array_intersect_key($allRoutes, array_flip($routeKeys));
    }
}

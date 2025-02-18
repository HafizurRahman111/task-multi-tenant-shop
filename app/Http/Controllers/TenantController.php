<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\MenuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TenantController extends Controller
{
    protected $menuService;

    // Injecting services
    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tenants = Tenant::all();
        $menuOptions = $this->menuService->getMenuOptions();

        return view('tenants.index', compact('tenants', 'menuOptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menuOptions = $this->menuService->getMenuOptions();

        return view('tenants.create', compact('menuOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:tenants,email',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $tenant = Tenant::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.tenants.index')->with('success', 'Tenant created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        $menuOptions = $this->menuService->getMenuOptions();

        return view('tenants.edit', compact('menuOptions', 'tenant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenant)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:tenants,email,' . $tenant->id,
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $tenant->update($request->only(['name', 'email']));

        return redirect()->route('admin.tenants.index')->with('success', 'Tenant updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        $tenant->delete();

        return redirect()->route('admin.tenants.index')
            ->with('success', 'Tenant deleted successfully!');
    }

}

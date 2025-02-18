<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\Tenant;
use App\Models\User;
use App\Services\MenuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    // dashboard
    public function dashboard()
    {
        $menuOptions = $this->menuService->getMenuOptions();
        $user = auth()->user();

        $counts = [
            'totalTenants' => $user->role == 'admin' ? Tenant::count() : null,
            'totalUsers' => $user->role == 'admin' ? User::count() : null,
            'totalStores' => $user->role == 'admin' ? Store::count() : Store::where('tenant_id', $user->tenant_id)->count(),
            'totalCategories' => $user->role == 'admin' ? Category::count() : Category::where('tenant_id', $user->tenant_id)->count(),
            'totalProducts' => $user->role == 'admin' ? Product::count() : Product::where('tenant_id', $user->tenant_id)->count(),
        ];

        return view('dashboard', [
            'menuOptions' => $menuOptions,
            'isAdmin' => $user->role == 'admin',
            ...$counts,
        ]);
    }

    public function profile()
    {
        $user = Auth::user();
        $tenant = $user->tenant;
        $menuOptions = $this->menuService->getMenuOptions();

        return view('profile', [
            'user' => $user,
            'tenant' => $tenant,
            'menuOptions' => $menuOptions
        ]);

    }

}

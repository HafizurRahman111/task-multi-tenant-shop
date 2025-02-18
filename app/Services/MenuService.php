<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;

class MenuService
{
    public function getMenuOptions()
    {
        $user = Auth::user();
        $menuOptions = [];

        if ($user) {
            if ($user->role === 'admin') {
                $menuOptions = [
                    [
                        'text' => 'Dashboard',
                        'icon' => 'fa fa-dashboard',
                        'route' => 'admin.dashboard',
                    ],
                    [
                        'text' => 'Tenants',
                        'icon' => 'fas fa-building',
                        'submenu' => [
                            ['route' => 'admin.tenants.create', 'icon' => 'fas fa-plus', 'text' => 'Create Tenant'],
                            ['route' => 'admin.tenants.index', 'icon' => 'fas fa-list', 'text' => 'Tenant List'],
                        ],
                    ],
                    [
                        'text' => 'Merchants',
                        'icon' => 'fas fa-users',
                        'submenu' => [
                            ['route' => 'admin.users.index', 'icon' => 'fas fa-list', 'text' => 'Merchant List'],
                        ],
                    ],
                    [
                        'text' => 'Stores',
                        'icon' => 'fas fa-store',
                        'submenu' => [
                            ['route' => 'admin.stores.create', 'icon' => 'fas fa-plus', 'text' => 'Create Store'],
                            ['route' => 'admin.stores.index', 'icon' => 'fas fa-list', 'text' => 'Store List'],
                        ],
                    ],
                    [
                        'text' => 'Categories',
                        'icon' => 'fas fa-tags',
                        'submenu' => [
                            ['route' => 'admin.categories.create', 'icon' => 'fas fa-plus', 'text' => 'Create Category'],
                            ['route' => 'admin.categories.index', 'icon' => 'fas fa-list', 'text' => 'Category List'],
                        ],
                    ],
                    [
                        'text' => 'Products',
                        'icon' => 'fas fa-box',
                        'submenu' => [
                            ['route' => 'admin.products.create', 'icon' => 'fas fa-plus', 'text' => 'Create Product'],
                            ['route' => 'admin.products.index', 'icon' => 'fas fa-list', 'text' => 'Product List'],
                        ],
                    ],
                ];
            } elseif ($user->role === 'merchant') {
                $menuOptions = [
                    [
                        'text' => 'Dashboard',
                        'icon' => 'fa fa-dashboard',
                        'route' => 'merchant.dashboard',
                    ],
                    [
                        'text' => 'Stores',
                        'icon' => 'fas fa-store',
                        'submenu' => [
                            ['route' => 'merchant.stores.create', 'icon' => 'fas fa-plus', 'text' => 'Create Store'],
                            ['route' => 'merchant.stores.index', 'icon' => 'fas fa-list', 'text' => 'Store List'],
                        ],
                    ],
                    [
                        'text' => 'Categories',
                        'icon' => 'fas fa-tags',
                        'submenu' => [
                            ['route' => 'merchant.categories.create', 'icon' => 'fas fa-plus', 'text' => 'Create Category'],
                            ['route' => 'merchant.categories.index', 'icon' => 'fas fa-list', 'text' => 'Category List'],
                        ],
                    ],
                    [
                        'text' => 'Products',
                        'icon' => 'fas fa-box',
                        'submenu' => [
                            ['route' => 'merchant.products.create', 'icon' => 'fas fa-plus', 'text' => 'Create Product'],
                            ['route' => 'merchant.products.index', 'icon' => 'fas fa-list', 'text' => 'Product List'],
                        ],
                    ],
                ];
            }
        }

        return $menuOptions;
    }
}
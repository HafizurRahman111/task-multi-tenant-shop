<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\MenuService;
use Illuminate\Http\Request;

class UserController extends Controller
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
        $items = User::all();
        $menuOptions = $this->menuService->getMenuOptions();

        return view('users.index', compact('items', 'menuOptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menuOptions = $this->menuService->getMenuOptions();

        return view('users.create', compact('menuOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully!');
    }

}

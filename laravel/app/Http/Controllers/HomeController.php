<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //

    public function index()
    {
        $hasReadPermission = Permission::where('role', Auth::user()->role)
            ->where('menu_group', 'dashboard')
            ->where('view', 'home')
            ->where('read', true)
            ->exists();
        return view('home', ['hasReadPermission' => $hasReadPermission]);
    }
}

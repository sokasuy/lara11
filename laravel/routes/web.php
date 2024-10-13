<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //DASHBOARD
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/', [HomeController::class, 'index'])->name('dashboard.home');

    //PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('EnsureAuthenticationAccess')->group(function () {
        //AUTHENTICATION FORMS
        Route::get('/authentication/users', [UserController::class, 'users'])->name('auth.users')->middleware('EnsureUserHasPermission:authentication,users,read');
        Route::post('/authentication/users/get-users-list', [UserController::class, 'getUsersList'])->name('auth.getuserslist');
        Route::get('/authentication/users/add-user', [UserController::class, 'addUser'])->name('auth.adduser')->middleware('EnsureUserHasPermission:authentication,users,create');
        Route::post('/authentication/users/add-user/action', [UserController::class, 'actionRegister'])->name('auth.actionregister');
        Route::post('/authentication/users/change-password', [UserController::class, 'changeUserPassword'])->name('auth.changeuserpassword');
        Route::post('/authentication/users/change-password/action', [UserController::class, 'actionChangeUserPassword'])->name('auth.actionchangeuserpwd');

        //ROLES
        Route::get('/authentication/roles/users', [RoleController::class, 'index'])->name('roles.users')->middleware(['autentikasi-roles']);
        Route::post('/authentication/roles/users/get-roles-list', [RoleController::class, 'getRolesList'])->name('role.getroles');
        Route::get('/authentication/roles/users/add-roles', [RoleController::class, 'addroles'])->name('auth.addroles')->middleware(['autentikasi-roles']);
        Route::post('/authentication/roles/users/add-roles/action-add', [RoleController::class, 'actionRegister'])->name('role.addroles');

        //PERMISSION
        Route::get('/authentication/permission/users', [PermissionController::class, 'index'])->name('permission.users')->middleware(['autentikasi-permission']);
        Route::post('/authentication/permission/users/get-permission-list', [PermissionController::class, 'getpermissionList'])->name('permission.getpermission');
        Route::post('/authentication/permission/users/change-permission', [PermissionController::class, 'changepermission'])->name('permission.changepermission')->middleware(['autentikasi-permission']);
        Route::post('/authentication/permission/action-change-permission', [PermissionController::class, 'actionChangePermission'])->name('permission.actionChangePermission');
    });
});

require __DIR__ . '/auth.php';

<?php

use App\Http\Controllers\Admin\ACL\PermissionController;
use App\Http\Controllers\Admin\ACL\PermissionProfileController;
use App\Http\Controllers\Admin\ACL\PermissionRoleController;
use App\Http\Controllers\Admin\ACL\PlanProfileController;
use App\Http\Controllers\Admin\ACL\ProfileController;
use App\Http\Controllers\Admin\ACL\RoleController;
use App\Http\Controllers\Admin\ACL\RoleUserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CategoryProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DetailPlanController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\TenantController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Site\SiteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::prefix('admin')
    ->middleware('auth')
    ->group(function(){

     /**
     * Role x User
     */
    Route::get('users/{id}/role/{idRole}/detach', [RoleUserController::class, 'detachRoleUser'])->name('users.role.detach' );
    Route::post('users/{id}/roles', [RoleUserController::class, 'attachRolesUser'])->name('users.roles.attache' );
    Route::any('users/{id}/roles/create', [RoleUserController::class, 'rolesAvailable'])->name('users.roles.available');
    Route::get('users/{id}/roles', [RoleUserController::class, 'roles'])->name('users.roles');
    Route::get('roles/{id}/users', [RoleUserController::class, 'users'])->name('roles.users');

    /**
     * Permission x Role
     */
    Route::get('roles/{id}/permission/{idPermission}/detach', [PermissionRoleController::class, 'detachPermissionRole '])->name('roles.permission.detach' );
    Route::post('roles/{id}/permissions', [PermissionRoleController::class, 'attachPermissionsRole'])->name('roles.permissions.attache' );
    Route::any('roles/{id}/permissions/create', [PermissionRoleController::class, 'permissionsAvailable'])->name('roles.permissions.available');
    Route::get('roles/{id}/permissions', [PermissionRoleController::class, 'permissions'])->name('roles.permissions');
    Route::get('permissions/{id}/role', [PermissionRoleController::class, 'roles'])->name('permissions.roles');


     /**
     * Routes Roles
     */
    Route::resource('roles', RoleController::class);
    Route::any('roles/search', [RoleController::class, 'search'])->name('roles.search');

    /**
     * Routes Tenants
     */
    Route::resource('tenants', TenantController::class);
    Route::any('tenants/search', [TenantController::class, 'search'])->name('tenants.search');

    /**
     * Routes Tables
     */
    Route::get('tables/qrcode/{identify}', [TableController::class, 'qrcode'])->name('tables.qrcode');
    Route::resource('tables', TableController::class);
    Route::any('tables/search', [TableController::class, 'search'])->name('tables.search');

    /**
     * Product x Category
     */
    Route::get('products/{id}/category/{idCategory}/detach', [CategoryProductController::class, 'detachCategoryProduct'])->name('products.category.detach' );
    Route::post('products/{id}/categories', [CategoryProductController::class, 'attachCategoriesProduct'])->name('products.categories.attache' );
    Route::any('products/{id}/categories/create', [CategoryProductController::class, 'categoriesAvailable'])->name('products.categories.available');
    Route::get('products/{id}/categories', [CategoryProductController::class, 'categories'])->name('products.categories');
    Route::get('categories/{id}/products', [CategoryProductController::class, 'products'])->name('categories.products');
        
    /**
     * Routes Products
     */
    Route::resource('products', ProductController::class);
    Route::any('products/search', [ProductController::class, 'search'])->name('products.search');

        /**
     * Routes Categories
     */
    Route::resource('categories', CategoryController::class);
    Route::any('categories/search', [CategoryController::class, 'search'])->name('categories.search');


    /**
     * Routes Users
     */
    Route::resource('users', UserController::class);
    Route::any('users/search', [UserController::class, 'search'])->name('users.search');

    /**
     * Plan x Profile
     */
    Route::get('plans/{id}/profile/{idProfile}/detach', [PlanProfileController::class, 'detachProfilePlan'])->name('plans.profile.detach' );
    Route::post('plans/{id}/profiles', [PlanProfileController::class, 'attachProfilesPlan'])->name('plans.profiles.attache' );
    Route::any('plans/{id}/profiles/create', [PlanProfileController::class, 'profilesAvailable'])->name('plans.profiles.available');
    Route::get('plans/{id}/profiles', [PlanProfileController::class, 'profiles'])->name('plans.profiles');
    Route::get('profiles/{id}/plans', [PlanProfileController::class, 'plans'])->name('profiles.plans');


    /**
     * Routes Profiles
     */
    Route::resource('profiles', ProfileController::class);
    Route::any('profiles/search', [ProfileController::class, 'search'])->name('profiles.search');

    /**
     * Permission x Profile
     */
    Route::get('profiles/{id}/permission/{idPermission}/detach', [PermissionProfileController::class, 'detachPermissionProfile'])->name('profiles.permission.detach' );
    Route::post('profiles/{id}/permissions', [PermissionProfileController::class, 'attachPermissionsProfile'])->name('profiles.permissions.attache' );
    Route::any('profiles/{id}/permissions/create', [PermissionProfileController::class, 'permissionsAvailable'])->name('profiles.permissions.available');
    Route::get('profiles/{id}/permissions', [PermissionProfileController::class, 'permissions'])->name('profiles.permissions');
    Route::get('permissions/{id}/profile', [PermissionProfileController::class, 'profiles'])->name('permissions.profiles');

    /**
     * Routes Permissions
     */
    Route::any('permissions/search', [PermissionController::class, 'search'])->name('permissions.search');
    Route::resource('permissions', PermissionController::class);

    /*
    * Routes Details Plans
    */
    Route::get('plans/{url}/details/create', [DetailPlanController::class, 'create'])->name('details.plan.create');
    Route::delete('plans/{url}/details/{idDetail}', [DetailPlanController::class, 'destroy'])->name('details.plan.destroy');
    Route::get('plans/{url}/details/{idDetail}', [DetailPlanController::class, 'show'])->name('details.plan.show');
    Route::put('plans/{url}/details/{idDetail}', [DetailPlanController::class, 'update'])->name('details.plan.update');
    Route::get('plans/{url}/details/{idDetail}/edit', [DetailPlanController::class, 'edit'])->name('details.plan.edit');
    Route::get('plans/{url}/details', [DetailPlanController::class, 'index'])->name('details.plan.index');
    Route::post('plans/{url}/details', [DetailPlanController::class, 'store'])->name('details.plan.store');

    /*
    * Routes Plans
    */
    Route::get('plans', [PlanController::class, 'index'])->name('plans.index');
    Route::get('plans/create', [PlanController::class, 'create'])->name('plans.create');
    Route::post('plans', [PlanController::class, 'store'])->name('plans.store');
    Route::get('plans/{url}', [PlanController::class, 'show'])->name('plans.show');
    Route::get('plans/{url}/edit', [PlanController::class, 'edit'])->name('plans.edit');
    Route::put('plans/{url}', [PlanController::class, 'update'])->name('plans.update');
    Route::delete('plans/{url}', [PlanController::class, 'destroy'])->name('plans.destroy');
    Route::any('plans/search', [PlanController::class, 'search'])->name('plans.search');

    /**
     * Home Dashboard
     */
    Route::get('/', [DashboardController::class, 'home'])->name('admin.index');
});

/**
 * Site
 */
Route::get('/plan/{url}', [SiteController::class, 'plan'])->name('plan.subscription');
Route::get('/', [SiteController::class, 'index'])->name('site.home');

/**
 * Auth Routes
 */
Auth::routes();


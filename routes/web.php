<?php


use App\Http\Controllers\Cliente\AccountController;
use App\Http\Controllers\Cliente\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Products\ProductController;
use App\Http\Controllers\Admin\DashboardController;

use Illuminate\Support\Facades\Auth; // Asegúrate de importar Auth

// 
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminColorController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminBrandController;
use App\Http\Controllers\Admin\AdminInventoryController;

Route::get('/', [ProductController::class, 'index'])->name('index');

    
Route::get('login/google', [LoginController::class, 'loginGoogle'])->name('loginWithGoogle');
Route::get('login/google/callback', [LoginController::class, 'loginGoogleCallback']);

Route::get('login/facebook', [LoginController::class, 'loginFacebook'])->name('loginWithFacebook');
Route::get('login/facebook/callback', [LoginController::class, 'loginFacebookCallback']);

Route::get('/create-password', [LoginController::class, 'showCreatePasswordForm'])->name('create.password.google');
Route::post('/create-password', [LoginController::class, 'createPassword'])->name('create.password.google');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rutas de registro
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('user/account/profile', function () {
    // Verifica si el usuario está autenticado y tiene el rol de "Administrador"
    if (Auth::check() && Auth::user()->isRole('cliente')) {
        return view('cliente.account.profile');
    }
    return redirect('/')->with('error', 'No tienes acceso a esta sección');
})->name('account.profile');

Route::post('/user/profile/search/dni', [AccountController::class, 'searchDNI'])->name('account.search.dni');
Route::put('/user/profile/update', [AccountController::class, 'updateProfile'])->name('profile.update');

Route::get('/user/account/address', [AccountController::class, 'index'])->name('account.address');
Route::post('/user/account/address', [AccountController::class, 'store'])->name('account.address.store');
Route::get('/user/account/address/{id}/edit', [AccountController::class, 'edit'])->name('account.address.edit');
Route::put('/user/account/address/{id}', [AccountController::class, 'update'])->name('account.address.update');
Route::delete('/user/account/address/{id}', [AccountController::class, 'destroy'])->name('account.address.destroy');

// Rutas para los detalles del producto
Route::get('/producto/{sku}', [ProductController::class, 'show'])->name('product.detail');


// Rutas del carrito de compras
Route::prefix('cart')->group(function () {
    Route::get('/detail', [CartController::class, 'index'])->name('cart.detail');
    Route::post('/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::put('/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
});

// Definir la ruta de dashboard para administradores
Route::get('auth/admi/dashboard/index', [DashboardController::class, 'toAdmiLogin'])->name('auth.admi.dashboard.index');


// Rutas para administración con control de acceso (usuarios con rol "administrador")

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Rutas de administración de productos
    Route::get('/products', [AdminProductController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{id}', [AdminProductController::class, 'show'])->name('admin.products.show');
    Route::get('/products/{id}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{id}', [AdminProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{id}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');
    // Rutas de administración de colores
    Route::get('/colors', [AdminColorController::class, 'index'])->name('admin.colors.index');
    Route::get('/colors/create', [AdminColorController::class, 'create'])->name('admin.colors.create');
    Route::post('/colors', [AdminColorController::class, 'store'])->name('admin.colors.store');
    Route::get('/colors/{id}', [AdminColorController::class, 'show'])->name('admin.colors.show');
    Route::get('/colors/{id}/edit', [AdminColorController::class, 'edit'])->name('admin.colors.edit');
    Route::put('/colors/{id}', [AdminColorController::class, 'update'])->name('admin.colors.update');
    Route::delete('/colors/{id}', [AdminColorController::class, 'destroy'])->name('admin.colors.destroy');

    // Rutas de administración de categorias
    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/categories/create', [AdminCategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/categories', [AdminCategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/categories/{id}', [AdminCategoryController::class, 'show'])->name('admin.categories.show');
    Route::get('/categories/{id}/edit', [AdminCategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/categories/{id}', [AdminCategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/{id}', [AdminCategoryController::class, 'destroy'])->name('admin.categories.destroy');
    // Rutas de administración de marcas
    Route::get('/brands', [AdminBrandController::class, 'index'])->name('admin.brands.index');
    Route::get('/brands/create', [AdminBrandController::class, 'create'])->name('admin.brands.create');
    Route::post('/brands', [AdminBrandController::class, 'store'])->name('admin.brands.store');
    Route::get('/brands/{id}', [AdminBrandController::class, 'show'])->name('admin.brands.show');
    Route::get('/brands/{id}/edit', [AdminBrandController::class, 'edit'])->name('admin.brands.edit');
    Route::put('/brands/{id}', [AdminBrandController::class, 'update'])->name('admin.brands.update');
    Route::delete('/brands/{id}', [AdminBrandController::class, 'destroy'])->name('admin.brands.destroy');
    // Rutas de administración de inventario
    Route::get('/inventory', [AdminInventoryController::class, 'index'])->name('admin.inventory.index');
    Route::get('/inventory/create', [AdminInventoryController::class, 'create'])->name('admin.inventory.create');
    Route::post('/inventory', [AdminInventoryController::class, 'store'])->name('admin.inventory.store');
    Route::get('/inventory/{id}', [AdminInventoryController::class, 'show'])->name('admin.inventory.show');
    Route::get('/inventory/{id}/edit', [AdminInventoryController::class, 'edit'])->name('admin.inventory.edit');
    Route::put('/inventory/{id}', [AdminInventoryController::class, 'update'])->name('admin.inventory.update');
    Route::delete('/inventory/{id}', [AdminInventoryController::class, 'destroy'])->name('admin.inventory.destroy');
});

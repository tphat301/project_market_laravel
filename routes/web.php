<?php
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminSliderController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminVoteController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegularController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'laravel-filemanager'], function () {\UniSharp\LaravelFilemanager\Lfm::routes();});

// Route home
Route::get('/', [ProductController::class, 'index']);

Auth::routes(['verify' => true]);

// Route logout user account
Route::get("logout_user", function() {
    Auth::logout();
    return redirect("/");
})->name('logout.user');

// Route login user account
Route::get('login_user', function() {
    return redirect("login");
})->name("login.user");

Route::middleware("auth")->group(function() {
    // Route::get('/home', 'HomeController@index')->name('home');

    // Route admin
    // Route::post("/admin", function() {
        // return view("auth.login");
    //     return redirect("login");
    // })->middleware("CheckAccessUrlLogin");
    // Route dashboard
    Route::get("/dashboard", [AdminDashboardController::class, "show"])->name('dashboard')->middleware("CheckAccessUserAccount");

    // Route admin user
    Route::get('admin/user/list', [AdminUserController::class, "list"]);
    Route::get('admin/user/update/{id}', [AdminUserController::class, "update"])->name('admin.user.update');
    Route::post('admin/user/updateStore/{id}', [AdminUserController::class, "updateStore"])->name('admin.user.updateStore');
    Route::get('admin/user/add', [AdminUserController::class, "add"]);
    Route::get('admin/user/delete/{id}', [AdminUserController::class, "delete"])->name('admin.user.delete');
    Route::post('admin/user/action', [AdminUserController::class, 'action']);
    Route::post('admin/user/add_store', [AdminUserController::class, 'add_store']);

    // Route admin product
    Route::get('admin/product/add', [AdminProductController::class, "add"]);
    Route::get('admin/product/list', [AdminProductController::class, "list"]);
    Route::get('admin/product/delete/{id}', [AdminProductController::class, "delete"])->name('admin.product.delete');
    Route::post('admin/product/add_store', [AdminProductController::class, "add_store"]);
    Route::post('admin/product/action', [AdminProductController::class, "action"]);
    Route::get('admin/product/update/{id}', [AdminProductController::class, "update"])->name('admin.product.update');
    Route::post('admin/product/updateStore/{id}', [AdminProductController::class, "updateStore"])->name('admin.product.updateStore');

    // Route admin order
    Route::get('admin/order/list', [AdminOrderController::class, 'show']);
    Route::get('admin/order/delete/{id}', [AdminOrderController::class, 'delete'])->name('admin.order.delete');
    Route::post('admin/order/action', [AdminOrderController::class, 'action']);
    Route::get('admin/order/detail/{id}', [AdminOrderController::class, 'detail'])->name('admin.order.detail');

    // Route admin slider
    Route::get('admin/slider/list', [AdminSliderController::class, 'show']);
    Route::post('admin/slider/store', [AdminSliderController::class, 'store']);
    Route::get('admin/slider/covert/status/{id}', [AdminSliderController::class, 'convertStatus'])->name('admin.slider.convert.status');
    Route::get('admin/slider/delete/{id}', [AdminSliderController::class, 'delete'])->name('admin.slider.delete');
    
    // Route admin vote
    Route::get('admin/vote/list', [AdminVoteController::class, 'vote']);
    Route::get('admin/vote/delete/{id}', [AdminVoteController::class, 'delete'])->name('admin.vote.delete');
    Route::post('admin/vote/action', [AdminVoteController::class, 'action']);
    Route::get('admin/vote/detail/{id}', [AdminVoteController::class, 'detail'])->name('admin.vote.detail');

    // Route admin comment

    // Route admin post

    // Route admin page
    Route::get('admin/page/list', [AdminPageController::class, 'show']);
    Route::get('admin/page/add', [AdminPageController::class, 'add']);
    Route::post('admin/page/store', [AdminPageController::class, 'store']);
    Route::post('admin/page/action', [AdminPageController::class, "action"]);
    Route::get('admin/page/update/{id}', [AdminPageController::class, 'update'])->name('admin.page.update');
    Route::get('admin/page/delete/{id}', [AdminPageController::class, 'delete'])->name('admin.page.delete');
    Route::post('admin/page/update_store/{id}', [AdminPageController::class, "update_store"])->name('admin.page.update_store');
});

// Detail Product
Route::get("san-pham/{slug}", [ProductController::class, 'detail'])->name('product.detail');

// Route About
Route::get("gioi-thieu", [PageController::class, "about"]);
// Route Contact
Route::get("lien-he", [PageController::class, "contact"]);

// Skirt Product
Route::get("danh-sach-vay-dam", [ProductController::class, 'skirt']);
// Route shirt product
Route::get("danh-sach-ao-thoi-trang", [ProductController::class, 'shirt']);
// Route trouser product
Route::get("danh-sach-quan-thoi-trang", [ProductController::class, 'trouser']);

// Route vote
Route::post('product/vote/stored', [CommentController::class, 'stored'])->name('product.vote.stored');
Route::post('product/vote/update_content_comment/{id}', [CommentController::class, 'update_content_comment'])->name('product.vote.update_content_comment');

// Route cart product
Route::get('gio-hang', [CartController::class, 'show']);
Route::post('cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('cart/remove/{rowId}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('cart/destroy', [CartController::class, 'destroy']);
Route::post('cart/update', [CartController::class, 'update']);
Route::get('thanh-toan', [CartController::class, 'checkout']);
Route::post('cart/buyStore', [CartController::class, 'buyStore']);
Route::get('hoa-don-khach-hang', [CartController::class, "order_show"]);
Route::get('cart/colorAjax', [CartController::class, "colorAjax"]);
Route::post('cart/updateAjax', [CartController::class, "updateAjax"]);

// Route comment regular
Route::get('quy-dinh-dang-binh-luan-tai-market-shop', [RegularController::class, 'show']);

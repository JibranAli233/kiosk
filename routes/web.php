<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::get('/', function () {
    if(Auth::check()) {
		return redirect('/home');
		// Route::get('/permissionList', [App\Http\Controllers\PermissionController::class, 'list']);
    } else {
        return view('auth.login');
    }
});


Route::get('/clearAll', function () {  // all in one
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:cache');
    Artisan::call('config:clear');
    echo '<script>alert("All Clears")</script>';
});
Route::get('/rms', function () {  // all in one
    Artisan::call('migrate:rollback');
    Artisan::call('migrate');
    $output = new \Symfony\Component\Console\Output\BufferedOutput();
    Artisan::call('db:seed', array(), $output);
    return $output->fetch();
    // echo '<script>alert("Rollback,Migrate, and seeder")</script>';
});

Route::get('/clear', function () {
    $output = new \Symfony\Component\Console\Output\BufferedOutput();
    Artisan::call('optimize:clear', array(), $output);
    return $output->fetch();
})->name('/clear');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {

    //stores
    Route::resource('stores', StoreController::class);
    Route::delete('stores/destory', [StoreController::class, 'destroy'])->name('store.massDestroy');
    
    // users
    Route::resource('users', 'UserController');
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    
    // companies
    Route::delete('companies/destroy', 'CompanyController@massDestroy')->name('companies.massDestroy');
    Route::resource('companies', 'CompanyController');
    
    // branches
    Route::resource('branches',  BranchController::class);
    Route::delete('branches/destroy', [CustomerController::class, 'destroy'])->name('branches.massDestroy');
    
    //roles
    Route::resource('roles', 'RoleController');
    Route::delete('roles/destroy', ['RoleController', 'destroy'])->name('roles.massDestroy');
    
	// Route::resource('/permissions', PermissionController::class);
	// Route::get('/permissionList', [App\Http\Controllers\PermissionController::class, 'list']);
	// Route::delete('/permissionDelete', [PermissionController::class, 'destroy']);
    
    //customers
    Route::resource('customers', CustomerController::class);
    Route::delete('customers/destory', [CustomerController::class, 'destroy'])->name('customer.massDestroy');
    
    //cities
    Route::resource('cities', CityController::class);
    Route::delete('cities/destory', [CityController::class, 'destroy'])->name('cities.massDestroy');
	
    //items
    Route::resource('items', ItemController::class);
    Route::delete('items/destory', [ItemController::class, 'destroy'])->name('items.massDestroy');
    
    //categories
    Route::resource('categories', CategoryController::class);
    Route::delete('categories/destory', [CategoryController::class, 'destroy'])->name('categories.massDestroy');
    
    //types
    Route::resource('types', TypeController::class);
    Route::delete('types/destory', [TypeController::class, 'destroy'])->name('types.massDestroy');
    
    //manufacturers
    Route::resource('manufacturers', ManufacturerController::class);
    Route::delete('manufacturers/destory', [ManufacturerController::class, 'destroy'])->name('manufacturers.massDestroy');

    //profiles
    Route::resource('profiles', ProfileController::class);
    Route::delete('profiles/destory', [ProfileController::class, 'destroy'])->name('profiles.massDestroy');
    
	
	// stocks
//    Route::resource('stocks', [StockController::class]);

    Route::resource('purchases', PurchaseController::class);
	Route::post('/fetch_item_detail', [App\Http\Controllers\PurchaseController::class, 'fetch_item_detail']);

    // Route::resource('/customer_types', App\Http\Controllers\Customer_typeController::class);
	// Route::get('/customer_typeList', [App\Http\Controllers\Customer_typeController::class, 'list']);
	// Route::delete('/customer_typeDelete', [App\Http\Controllers\Customer_typeController::class, 'destroy']);

	Route::resource('/stocks', StockController::class);
	Route::get('/stockList', [App\Http\Controllers\StockController::class, 'list']);
	Route::delete('/stockDelete', [App\Http\Controllers\StockController::class, 'destroy']);

	Route::resource('/sells', SellController::class);
	Route::get('/sellList', [App\Http\Controllers\SellController::class, 'list']);
	Route::delete('/sellDelete', [App\Http\Controllers\SellController::class, 'destroy']);
	Route::post('/fetch_item_unit_detail', [App\Http\Controllers\SellController::class, 'fetch_item_unit_detail']);

	Route::resource('/reports', ReportController::class);
});



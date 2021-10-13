<?php

use Illuminate\Support\Facades\Route;

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

Route::namespace('Admin')->group(function () {
    Route::name('admin.')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('login', 'LoginController@showLoginForm')->name('login');
            Route::post('login', 'LoginController@login');
            Route::get('logout', 'LoginController@logout')->name('logout');

            Route::middleware(['auth', 'auth_admin', 'checkStatus'])->group(function () {
                Route::get('home', 'HomeController@index')->name('index');

                Route::name('permission.')->group(function () {
                    Route::prefix('permission')->middleware('acl:permission-edit')->group(function () {
                        Route::get('list/{id_role?}', 'PermissionController@index')->name('index');
                        Route::put('update/{id_role?}', 'PermissionController@update')->name('update');
                    });
                });

                Route::name('user.')->group(function () {
                    Route::prefix('user')->middleware('acl:user-edit')->group(function () {
                        Route::get('search', 'UserController@search')->name('search');
                        Route::get('list', 'UserController@index')->name('index');
                        Route::get('create', 'UserController@showCreateForm')->name('create');
                        Route::post('create', 'UserController@create');
                        Route::get('detail/{id}', 'UserController@detail')->name('detail');
                        Route::put('update/{id}', 'UserController@update')->name('update');
                        Route::get('reset-password/{id}', 'UserController@showFormResetPassword')->name('reset_password');
                        Route::put('reset-password/{id}', 'UserController@resetPassword');
                        Route::put('active/{id?}', 'UserController@active')->name('active');
                        Route::put('block/{id?}', 'UserController@block')->name('block');
                    });
                });

                Route::name('category.')->group(function () {
                    Route::prefix('category')->middleware('acl:category-edit')->group(function () {
                        Route::get('index', 'CategoryController@index')->name('index');
                        Route::get('create', 'CategoryController@showCreateForm')->name('create');
                        Route::post('create', 'CategoryController@create');
                        Route::get('detail/{id}', 'CategoryController@detail')->name('detail');
                        Route::put('update/{id}', 'CategoryController@update')->name('update');
                    });
                });

                Route::name('brand.')->group(function () {
                    Route::prefix('brand')->middleware('acl:brand-edit')->group(function () {
                        Route::get('index', 'BrandController@index')->name('index');
                        Route::get('create', 'BrandController@showCreateForm')->name('create');
                        Route::post('create', 'BrandController@create');
                        Route::get('detail/{id}', 'BrandController@detail')->name('detail');
                        Route::put('update/{id}', 'BrandController@update')->name('update');
                    });
                });

                Route::name('product.')->group(function () {
                    Route::prefix('product')->middleware('acl:product-edit')->group(function () {
                        Route::get('index', 'ProductController@index')->name('index');
                        Route::get('search', 'ProductController@search')->name('search');
                        Route::get('detail/{id}', 'ProductController@detail')->name('detail');
                        Route::put('update/{id}', 'ProductController@update')->name('update');
                        Route::get('create', 'ProductController@showCreateForm')->name('create');
                        Route::post('create', 'ProductController@create');
                    });
                });

                Route::name('order.')->group(function () {
                    Route::prefix('order')->group(function () {
                        Route::middleware('acl:order-list')->group(function() {
                            Route::get('/index', 'OrderController@index')->name('index');
                        });
                        Route::middleware('acl:order-confirm')->group(function() {
                            Route::put('/confirm/{id}', 'OrderController@confirm')->name('confirm');
                        });
                        Route::get('/detail/{id}', 'OrderController@detail')->name('detail');
                        Route::get('/print-invoice/{id}', 'OrderController@print')->name('print');
                    });
                });

                Route::name('blog.')->group(function () {
                    Route::prefix('blog')->middleware('acl:blog-edit')->group(function () {
                        Route::get('index', 'BlogController@index')->name('index');
                        Route::get('search', 'BlogController@search')->name('search');
                        Route::get('create', 'BlogController@showCreateForm')->name('create');
                        Route::post('create', 'BlogController@create');
                        Route::get('detail/{id}', 'BlogController@detail')->name('detail');
                        Route::put('update/{id}', 'BlogController@update')->name('update');
                        Route::delete('delete/{id?}', 'BlogController@delete')->name('delete');
                    });
                });

                Route::name('color.')->group(function() {
                    Route::prefix('color')->group(function () {
                        Route::get('all', 'ColorController@all')->name('all');
                    });
                });
            });
        });
    });
});

Route::namespace('User')->group(function () {
    Route::middleware('checkStatus')->group(function() {
        Route::get('/', 'HomeController@index')->name('index');
        Route::get('/login', 'LoginController@loginForm')->name('login');
        Route::post('/login', 'LoginController@login');
        Route::get('/signup', 'RegisterController@registerForm')->name('signup');
        Route::post('/signup', 'RegisterController@register');
        Route::get('/logout', 'LoginController@logout')->name('logout');
    
        Route::name('product.')->group(function () {
            Route::prefix('product')->group(function () {
                Route::get('/', 'ProductController@index')->name('index');
                Route::get('/search', 'ProductController@search')->name('search');
                Route::get('/detail/{id}', 'ProductController@detail')->name('detail');
            });
        });
    
        Route::name('blog.')->group(function () {
            Route::prefix('blog')->group(function () {
                Route::get('/', 'BlogController@index')->name('index');
                Route::get('/detail/{id}', 'BlogController@detail')->name('detail');
            });
        });
    
        Route::name('cart.')->group(function () {
            Route::prefix('cart')->group(function () {
                Route::get('/', 'CartController@index')->name('index');
                Route::get('/detail/{id}', 'CartController@detail')->name('detail');
                Route::post('add/{id}', 'CartController@add')->name('add');
                Route::post('update', 'CartController@update')->name('update');
            });
        });
    
        Route::name('checkout.')->group(function () {
            Route::prefix('checkout')->group(function () {
                Route::get('/', 'CheckoutController@index')->name('index');
            });
        });
    
        Route::middleware('auth')->group(function (){
            Route::name('profile.')->group(function (){
                Route::prefix('profile')->group(function (){
                    Route::get('/info', 'UserController@showInfo')->name('info');
                    Route::put('/info', 'UserController@updateInfo');
                    Route::get('/change-password', 'UserController@showFormChangePassword')->name('update_password');
                    Route::post('/change-password', 'UserController@updatePassword');
                });
            });
        }); 
    });
});

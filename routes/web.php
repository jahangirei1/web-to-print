<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\userController;    
use Illuminate\Support\Facades\Route;

Route::controller(authController::class)->group(function() {
    Route::get('/', 'showLoginForm')->name('login');
    Route::post('login-post', 'authenticateUser')->name('login.post');
        
});

Route::prefix('admin/')->group(function () {
    Route::group(['middleware' => ['adminMiddleware']], function () {
        Route::controller(adminController::class)->group(function() {
            //Route::get('dashboard', 'showDashboard')->name('admin-dashboard');
            Route::get('dashboard', 'showPendingUsersList')->name('admin-dashboard');
            Route::get('list', 'showAdminsList')->name('admin-list');
            //Route::get('members-list', 'showUsersList')->name('admin-users-list');
            Route::get('members-list', 'showApprovedUsersList')->name('admin-users-list');
            Route::get('profile', 'adminProfile')->name('admin-profile');
            //Route::get('add-admin-form', 'addAdminForm')->name('admin-add-form');
            //Route::post('remove-admin', 'deleteAdmin')->name('admin-delete');
            //Route::post('update-admin', 'updateAdmin')->name('admin-update');
            Route::get('add-admin-form', 'addAdminForm')->name('admin-add-form')->middleware('superAdminMiddleware');
            Route::post('add-admin', 'addAdmin')->name('admin-add')->middleware('superAdminMiddleware');
            Route::delete('remove-admin/{id}', 'deleteAdmin')->name('admin-delete')->middleware('superAdminMiddleware');
            //Route::post('update-admin', 'updateAdmin')->name('admin-update')->middleware('superAdminMiddleware');
            Route::patch('update-admin-role/{id}', 'updateAdminRole')->name('admin-update-role')->middleware('superAdminMiddleware');
            Route::get('logout', 'adminLogout')->name('admin-logout');
            Route::post('/approve-user/{id}','approveUser')->name('approve.user');
            Route::post('/reject-user/{id}', 'rejectUser')->name('reject.user');
            Route::get('user-approved', function () {
                return view('admin.approveDashboard');
            })->name('user.approved');
            
            Route::get('user-rejected', function () {
                return view('admin.rejectDashboard');
            })->name('user.rejected');
        });
    });
});

Route::prefix('user/')->group(function () {
    Route::group(['middleware' => ['userMiddleware']], function () {
        Route::controller(userController::class)->group(function() {
            Route::get('dashboard', 'showDashboard')->name('user-dashboard');
            Route::get('logout', 'userLogout')->name('user-logout');
        });
    });
});


Route::fallback(function(){
    return view('layouts.notFoundView');
});
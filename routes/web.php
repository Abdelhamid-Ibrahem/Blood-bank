<?php

use App\Http\Controllers\FCMNotificationController;
use App\Http\Controllers\Front\AuthController;
use App\Http\Controllers\Front\MainController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReqController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Livewire\UserManagement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GovernorateController;
use Kreait\Firebase\Messaging\CloudMessage;

use Illuminate\Notifications\Messages\MailMessage;
use Kreait\Firebase\Messaging\Notification;


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::group(['namespace' => 'Front','middleware' => 'auth:client-web' ],function (){//
    Route::get('/', [MainController::class, 'home'] );
    Route::get('login', [AuthController::class, 'login'] );
    Route::get('register', [AuthController::class, 'register'] );
    Route::get('about', [MainController::class, 'about'] );
    Route::get('article', [MainController::class, 'article'] );
    Route::get('donations', [MainController::class, 'donationRequests'] );
    Route::get('contact', [MainController::class, 'contact'] );
    Route::post('toggle-favourite', [MainController::class, 'toggleFavourite'] )->name('toggle-favourite');
});
Route::resource('request', ReqController::class );

Route::get('clear', function () {
    \Illuminate\Support\Facades\Artisan::call('config:cache');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
});
Route::get('client-login', [AuthController::class, 'loginClient'] );
Route::post('client-login', [AuthController::class, 'loginClient'] );


//Admin panel
Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function () { //, 'AutoCheckPermission'
Route::resource('governorates', GovernorateController::class);
Route::resource('cities', CityController::class);
Route::resource('categories', CategoryController::class);
Route::get('clients-activate/{id}', [ClientController::class, 'activate'])->name('clients.activate');
Route::get('clients-deactivate/{id}', [ClientController::class, 'deactivate'])->name('clients.deactivate');
Route::get('clients-toggle-activation/{id}', [ClientController::class, 'toggleActivation'])->name('clients.toggle-activation');
Route::resource('clients', ClientController::class);
Route::resource('posts', PostController::class);
Route::resource('contact', ContactController::class);
Route::resource('setting', SettingController::class);
Route::put('donations', [App\Http\Controllers\DonationController::class])->name('donations');
Route::resource('donations', DonationController::class);
Route::resource('users', UserController::class);
Route::resource('roles', RolesController::class);
Route::resource('home', HomeController::class );

// User reset password
Route::get('user/change-password', [UserController::class, 'changePassword']);
Route::post('user/change-password', [UserController::class, 'changePasswordSave']);

});
/*
Route::get('/', function () {
   return view('front.home');

});
*/
Route::get('/send-notification', [NotificationController::class, 'sendFirebaseNotification']);

//Route::post('/send-notification', [FCMNotificationController::class, 'sendNotification']);

Route::get('/send-notification', function () {
    $deviceToken = '$deviceToken';
    $title = 'مرحبًا';
    $body = 'هذا إشعار تجريبي';

    $notificationController = new \App\Http\Controllers\FCMNotificationController();
    return $notificationController->sendNotification($deviceToken, $title,$body);
});

Route::get('/test-fcm', function () {
    $deviceToken = '$deviceToken';

    $messaging = app('firebase.messaging');
    $notification = Notification::create('Test Title', 'This is a test notification.');
    $message = CloudMessage::withTarget('token', $deviceToken)
        ->withNotification($notification);

    $messaging->send($message);

    return 'Notification sent!';
});



<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BusesController;
use App\Http\Controllers\Api\CartypeController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\TicketExportController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Api\NewController;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\VerifyEmailController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\NotificationController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('buses', BusesController::class);
Route::get('search', [BusesController::class , 'search']);
Route::resource('cartypes', CartypeController::class);
Route::resource('services', ServiceController::class);
Route::resource('ticket', TicketController::class);
Route::get('searchTK', [TicketController::class , 'searchTK']);
Route::get('ticketexport', [TicketExportController::class, 'export']);
Route::resource('users', UserController::class);
Route::resource('news', NewController::class);

//Register
Route::post('register', [RegisterController::class , 'register']);

//Login
Route::post('login', [LoginController::class , 'login']);

Route::post('payment', [PaymentController::class , 'create']);
Route::get('vnpay/return', [PaymentController::class, 'vnpayReturn'])->name('vnpay.return');

Route::post('/sendmail', [MailController::class, "sendmail"]);

//api create rating
Route::post('buses/rating/{buses_id}', [BusesController::class , 'rating']);//l???y id c???a chuy???n xe
//api delete
Route::resource('rating', RatingController::class);

//qu???n l?? t??i kho???n

Route::resource('userAdmin', UserAdminController::class);

//qu???n l?? role - permission
Route::resource('role', RolePermissionController::class);
//api permision
Route::resource('permission', PermissionController::class)->only('index');

//g???i mail verify
Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, 'verify'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/email/verify/resend', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth:api', 'throttle:6,1'])->name('verification.send');

//?????i m???t kh???u, qu??n m???t kh???u
Route::post('password/email',[ForgotPasswordController::class, 'forgot']);
Route::post('password/reset', [ForgotPasswordController::class,'reset']);
Route::get('change',[ForgotPasswordController::class,'change']);
Route::post('change',[ForgotPasswordController::class,'change']);

Route::post('loc_ngay', [TicketController::class , 'loc_ngay']);
Route::post('loc_ve', [TicketController::class , 'loc_khoang_tgian']);
Route::post('loc_ve_thang', [TicketController::class , 'loc_theo_thang']);
Route::get('loc_mac_dinh', [TicketController::class , 'loc_default']);


// >>> Xem t???t c??? c??c th??ng b??o ch??a ?????c
Route::get('notification', [NotificationController::class,'index']);

// >>> ????nh d???u 1 th??ng b??o l?? ???? ?????c
Route::get('readed/{id}', [NotificationController::class,'readed']);

// >>> ????nh d???u t???t c??? th??ng b??o ???? ?????c
Route::get('readedall', [NotificationController::class,'readedall']);

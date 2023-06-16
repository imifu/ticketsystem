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


// フロントページ

Route::get('/', [App\Http\Controllers\PagesController::class, 'index'])->name('page.index');

Route::get('/news', [App\Http\Controllers\PagesController::class, 'news'])->name('page.news');
Route::get('/news/{id}', [App\Http\Controllers\PagesController::class, 'newsdetail'])->name('page.newsdetail');

Route::get('/ticket/{id}', [App\Http\Controllers\PagesController::class, 'ticket'])->name('page.ticket');

Route::get('/raw', [App\Http\Controllers\PagesController::class, 'raw'])->name('page.raw');
Route::get('/privacy', [App\Http\Controllers\PagesController::class, 'privacy'])->name('page.privacy');
Route::get('/company', [App\Http\Controllers\PagesController::class, 'company'])->name('page.company');

Route::get('/login', [App\Http\Controllers\UsersController::class, 'login'])->name('users.login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('users.loginS');
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class,'logout'])->name('users.logout');

Route::get('/regist', [App\Http\Controllers\UsersController::class, 'regist'])->name('users.regist');
Route::post('/regist', [App\Http\Controllers\UsersController::class, 'registConf'])->name('users.registConf');
Route::post('/thanks', [App\Http\Controllers\UsersController::class, 'userSave'])->name('users.userSave');
Route::get('/thanks', [App\Http\Controllers\UsersController::class, 'thanks'])->name('users.thanks');


// サイト会員マイページ

Route::middleware('auth')->group(function(){

    Route::get('/mypage', [App\Http\Controllers\UsersController::class, 'index'])->name('users.index');
    Route::get('/mypage/history', [App\Http\Controllers\UsersController::class, 'history'])->name('users.history');
    Route::get('/mypage/profile', [App\Http\Controllers\UsersController::class, 'profile'])->name('users.profile');

    Route::get('/mypage/profileForm', [App\Http\Controllers\UsersController::class, 'profileForm'])->name('users.profile_change');
    Route::post('/mypage/profileConf', [App\Http\Controllers\UsersController::class, 'profileConf'])->name('users.profile_conf');
    Route::post('/mypage/profileComp', [App\Http\Controllers\UsersController::class, 'profileComp'])->name('users.profile_save');



    Route::get('/buyTicket/{id}', [App\Http\Controllers\UsersController::class, 'buyTicket'])->name('users.buyTicket');
    Route::post('/buyTicketConfirm', [App\Http\Controllers\UsersController::class, 'buyTicketConfirm'])->name('users.buyTicketConfirm');

    Route::post('/buyTicketComp', [App\Http\Controllers\UsersController::class, 'buyTicketComp'])->name('users.buyTicketComp');

    Route::get('/buyTicketThanks', [App\Http\Controllers\UsersController::class, 'buyTicketThanks'])->name('users.buyTicketThanks');

    Route::get('/payment_error', [App\Http\Controllers\UsersController::class, 'noPayment'])->name('users.no_payment');


});


// 管理画面

Route::view('/kdMsAsj3U2b8/login', 'admins/login');
Route::view('/kdMsAsj3U2b8/register', 'admins/register'); // *

Route::post('/kdMsAsj3U2b8/login', [App\Http\Controllers\admin\LoginController::class, 'login'])->name('admin.login');
Route::post('kdMsAsj3U2b8/logout', [App\Http\Controllers\admin\LoginController::class,'logout'])->name('admin.logout');
Route::post('/kdMsAsj3U2b8/register', [App\Http\Controllers\admin\RegisterController::class, 'register']);

Route::middleware('auth:admins')->group(function(){

    Route::get('/kdMsAsj3U2b8', [App\Http\Controllers\AdminsController::class, 'index'])->name('admin.top');

    Route::get('/kdMsAsj3U2b8/admins', [App\Http\Controllers\AdminsController::class, 'admins'])->name('admin.admins');
    Route::get('/kdMsAsj3U2b8/admin', [App\Http\Controllers\AdminsController::class, 'admin'])->name('admin.admin');
    Route::get('/kdMsAsj3U2b8/admin/{id}', [App\Http\Controllers\AdminsController::class, 'admin'])->name('admin.detail');
    Route::get('/kdMsAsj3U2b8/adminDelete/{id}', [App\Http\Controllers\AdminsController::class, 'adminDelete'])->name('admin.delete');

    Route::post('/kdMsAsj3U2b8/adminSave', [App\Http\Controllers\AdminsController::class, 'adminSave'])->name('admin.adminSave');


    Route::get('/kdMsAsj3U2b8/news', [App\Http\Controllers\AdminsController::class, 'news'])->name('admin.news');
    Route::get('/kdMsAsj3U2b8/newsDetail', [App\Http\Controllers\AdminsController::class, 'newsDetail'])->name('admin.createDetail');
    Route::get('/kdMsAsj3U2b8/newsDetail/{id}', [App\Http\Controllers\AdminsController::class, 'newsDetail'])->name('admin.newsDetail');
    Route::get('/kdMsAsj3U2b8/newsDelete/{id}', [App\Http\Controllers\AdminsController::class, 'newsDelete'])->name('admin.newsDelete');
    Route::post('/kdMsAsj3U2b8/newsSave', [App\Http\Controllers\AdminsController::class, 'newsSave'])->name('admin.newsSave');


    Route::get('/kdMsAsj3U2b8/users', [App\Http\Controllers\AdminsController::class, 'users'])->name('admin.users');
    Route::get('/kdMsAsj3U2b8/user', [App\Http\Controllers\AdminsController::class, 'user'])->name('admin.createUser');
    Route::get('/kdMsAsj3U2b8/user/{id}', [App\Http\Controllers\AdminsController::class, 'user'])->name('admin.user');
    Route::get('/kdMsAsj3U2b8/userDelete/{id}', [App\Http\Controllers\AdminsController::class, 'userDelete'])->name('admin.userDelete');
    Route::post('/kdMsAsj3U2b8/userSave', [App\Http\Controllers\AdminsController::class, 'userSave'])->name('admin.userSave');

    Route::get('/kdMsAsj3U2b8/tickets', [App\Http\Controllers\AdminsController::class, 'tickets'])->name('admin.tickets');
    Route::get('/kdMsAsj3U2b8/ticket', [App\Http\Controllers\AdminsController::class, 'ticket'])->name('admin.ticket');
    Route::get('/kdMsAsj3U2b8/ticket/{id}', [App\Http\Controllers\AdminsController::class, 'ticket'])->name('admin.ticketDetail');
    Route::get('/kdMsAsj3U2b8/ticketDelete/{id}', [App\Http\Controllers\AdminsController::class, 'ticketDelete'])->name('admin.ticketDelete');
    Route::post('/kdMsAsj3U2b8/ticketSave', [App\Http\Controllers\AdminsController::class, 'ticketSave'])->name('admin.ticketSave');


    Route::get('/kdMsAsj3U2b8/seats', [App\Http\Controllers\AdminsController::class, 'seats'])->name('admin.seats');
    Route::get('/kdMsAsj3U2b8/seat/{ticket_id}', [App\Http\Controllers\AdminsController::class, 'seat'])->name('admin.seat');
    Route::get('/kdMsAsj3U2b8/seat/{ticket_id}/{id}', [App\Http\Controllers\AdminsController::class, 'seat'])->name('admin.seatDetail');
    Route::get('/kdMsAsj3U2b8/seatDelete/{id}', [App\Http\Controllers\AdminsController::class, 'seatDelete'])->name('admin.seatDelete');
    Route::post('/kdMsAsj3U2b8/seatSave', [App\Http\Controllers\AdminsController::class, 'seatSave'])->name('admin.seatSave');

    Route::get('/kdMsAsj3U2b8/seatsAll', [App\Http\Controllers\AdminsController::class, 'seatsAll'])->name('admin.seatsAll');
    Route::get('/kdMsAsj3U2b8/seatsAll/{ticket_id}', [App\Http\Controllers\AdminsController::class, 'seatsAll'])->name('admin.seatsAllTicket');


    Route::get('/kdMsAsj3U2b8/enterSeat', [App\Http\Controllers\AdminsController::class, 'enterSeat'])->name('admin.enter_seat');
    Route::post('/kdMsAsj3U2b8/enterSeat', [App\Http\Controllers\AdminsController::class, 'enterSeatSearch'])->name('admin.enterSeatSearch');
    Route::post('/kdMsAsj3U2b8/enterSeatUpload', [App\Http\Controllers\AdminsController::class, 'enterSeatUpload'])->name('admin.enterSeatUpload');

    Route::get('/kdMsAsj3U2b8/sumally', [App\Http\Controllers\AdminsController::class, 'sumally'])->name('admin.sumally');
    Route::post('/kdMsAsj3U2b8/sumally', [App\Http\Controllers\AdminsController::class, 'sumallySearch'])->name('admin.sumallySearch');


    Route::get('/kdMsAsj3U2b8/payments', [App\Http\Controllers\AdminsController::class, 'payments'])->name('admin.payments');
    Route::get('/kdMsAsj3U2b8/paymentSearch', [App\Http\Controllers\AdminsController::class, 'payments'])->name('admin.paymentSearch');

    Route::get('/kdMsAsj3U2b8/paymentsDelete/{id}/{user_ticket_id}', [App\Http\Controllers\AdminsController::class, 'paymentsDelete'])->name('admin.paymentsDelete');

    Route::get('/kdMsAsj3U2b8/qr', [App\Http\Controllers\AdminsController::class, 'qr_reader'])->name('admin.qr');
    Route::get('/kdMsAsj3U2b8/come_live/', [App\Http\Controllers\AdminsController::class, 'come_live'])->name('admin.come_live');
    Route::get('/kdMsAsj3U2b8/come_live/{str}', [App\Http\Controllers\AdminsController::class, 'come_live'])->name('admin.come_live_function');

    Route::get('/kdMsAsj3U2b8/mails', [App\Http\Controllers\AdminsController::class, 'mails'])->name('admin.mails');
    Route::get('/kdMsAsj3U2b8/sendMail', [App\Http\Controllers\AdminsController::class, 'mail_magazine_search'])->name('admin.mail_magazine_search');
    Route::get('/kdMsAsj3U2b8/createMail', [App\Http\Controllers\AdminsController::class, 'mail_magazine'])->name('admin.mail_magazine');
    Route::get('/kdMsAsj3U2b8/mail_detail/{id}', [App\Http\Controllers\AdminsController::class, 'mail_detail'])->name('admin.mail_detail');
    Route::get('/kdMsAsj3U2b8/mail_delete/{id}', [App\Http\Controllers\AdminsController::class, 'mail_delete'])->name('admin.mail_delete');
    Route::post('/kdMsAsj3U2b8/mailSave', [App\Http\Controllers\AdminsController::class, 'mailSave'])->name('admin.mailSave');

    Route::post('/kdMsAsj3U2b8/mails_send_choose', [App\Http\Controllers\AdminsController::class, 'mails_send_choose'])->name('admin.mail_send_choose');
    Route::post('/kdMsAsj3U2b8/user_mails', [App\Http\Controllers\AdminsController::class, 'user_mails'])->name('admin.user_mails');

    // 送信先一覧画面
    Route::get('/kdMsAsj3U2b8/userMails', [App\Http\Controllers\AdminsController::class, 'userMailView'])->name('admin.user_mails_view');
    //user_mailの削除機能
    Route::get('/kdMsAsj3U2b8/user_mail_delete/{id}', [App\Http\Controllers\AdminsController::class, 'user_mail_delete'])->name('admin.user_mail_delete');
});


// API

Route::post('stripe_create_api', [App\Http\Controllers\ApiController::class, 'stripe_create_api'])->name('api.stripe_create_api');
Route::post('stripe_cancel_api', [App\Http\Controllers\ApiController::class, 'stripe_cancel_api'])->name('api.stripe_cancel_api');
Route::post('stripe_failed_api', [App\Http\Controllers\ApiController::class, 'stripe_failed_api'])->name('api.stripe_failed_api');

<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;



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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('auth/{provider}', [LoginController::class, 'redirectToProvider']);
Route::get('auth/{provider}/callback', [LoginController::class, 'handleProviderCallback']);

Route::get('send-mail', function () {
    $data['email'] = 'tajmeelhussain726@gmail.com';
    dispatch(new App\Jobs\SendEmailJob($data));
    dd('email send successffully');
});

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'hi'])) {
        session(['locale' => $locale]);

        if (Auth::check()) {
            $user = Auth::user()->id;
            $usrUdt = User::find($user);
            $usrUdt->language = $locale;
            $usrUdt->save();
        }
    }
    return redirect()->back();
})->name('switch-language');

Route::get('role-permissions', function(){

    // $admin = User::whereName('user')->with('roles')->first();
    // $adminRole = Role::whereName('user')->first();
    // $admin->roles()->attach($adminRole);
    // if($admin->hasRole('user')){
    //     dd('Yes This user has user role');
    // }
    // dd($admin->toArray());

    $add_user_permission = Permission::where('name','add_user')->first();
    $admin_role = Role::whereName('admin')->with('permissions')->first();
    $admin_role->permissions()->attach($add_user_permission);
    dd($admin_role->toArray());
    dd('ok');
    return view('role');
});

Route::get('show-student', [HomeController::class, 'show']);
Route::get('insert-student', [HomeController::class, 'create']);
Route::get('update-student', [HomeController::class, 'update']);
Route::get('delete-student', [HomeController::class, 'delete']);
Route::get('list-student', [HomeController::class, 'list']);
Route::get('list1-student', [HomeController::class, 'list1']);
Route::get('list2-student', [HomeController::class, 'list2']);
Route::get('multipleCondition-student', [HomeController::class, 'multipleCondition']);
Route::get('list3-student', [HomeController::class, 'list3']);
Route::get('list4-student', [HomeController::class, 'list4']);
Route::get('comment', [HomeController::class, 'comment'])->name('comment');
Route::post('comment-post', [HomeController::class, 'commentPost'])->name('comment-post');

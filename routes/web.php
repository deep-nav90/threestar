<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\UserController;

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
    return view('admin.coming-soon');
});


Route::group(['namespace' => 'Admin','prefix'=>'admin', 'as' => 'admin.'],function(){

    Route::match(['GET','POST'],'login', [UserController::class, 'login'])->name('login');

    Route::match(['GET','POST'],'forgot-password','DashboardController@forgotPassword')->name('forgotPassword');

    Route::post('check-exist-email','DashboardController@checkExistEmail')->name('checkExistEmail');

    Route::match(['GET','POST'],'reset-password/{reset_password_token?}','DashboardController@resetPassword')->name('resetPassword');

    Route::get('password-reset-success','DashboardController@viewMessageResetPassword')->name('passwordReset');


    Route::get('password-reset-invalid','DashboardController@viewMessageResetPasswordInvalid')->name('passwordResetInvalid');


    Route::post('check-exist-email-user/{id?}','UserController@checkExistEmailUser')->name('checkExistEmailUser');

});

Route::group(['middleware'=>['loginAuthenticate'], 'namespace' => 'Admin','prefix'=>'admin', 'as' => 'admin.'], function() {
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    Route::match(['GET', 'POST'], 'user-management',[UserController::class, 'userManagement'])->name('userManagement');

    Route::match(['GET', 'POST'], 'wallet-management',[UserController::class, 'walletManagement'])->name('walletManagement');

    Route::match(['GET','POST'],'add-user',[UserController::class, 'addUser'])->name('addUser');

    Route::post('check-exist-mobile-number-user', [UserController::class, 'checkExistsMobileNumber'])->name('checkExistsMobileNumber');


    Route::match(['GET','POST'],'change-password', [UserController::class, 'changePassword'])->name('changePassword');

    Route::get('tree-view/{user_id}', [UserController::class, 'treeView'])->name('treeView');

    Route::match(['GET', 'POST'],'edit-user/{user_id}', [UserController::class, 'editUser'])->name('editUser');

    Route::get('view/{user_id}', [UserController::class, 'viewUserDetails'])->name('viewUserDetails');

    Route::get('wallet-view/{wallet_id}', [UserController::class, 'viewWalletDetails'])->name('viewWalletDetails');

    Route::get('logout', [UserController::class,'logout'])->name('logout');
    Route::post('get-users-by-sponser/{custom_user_id}', [UserController::class, 'getUserBySponser'])->name('getUserBySponser');

    Route::match(['GET', 'POST'], 'users-wallet-management',[UserController::class, 'usersWalletManagement'])->name('usersWalletManagement');
    Route::match(['GET', 'POST'],'users-wallet-view/{wallet_id}', [UserController::class, 'usersViewWalletDetails'])->name('usersViewWalletDetails');
    
    Route::post('debit-wallet-amount', [UserController::class,'debitWalletAmount'])->name('debitWalletAmount');


    Route::match(['GET', 'POST'], 'reward-management',[UserController::class, 'rewardManagement'])->name('rewardManagement');
    Route::match(['GET', 'POST'], 'add-reward',[UserController::class, 'addReward'])->name('addReward');
    Route::get('reward-view/{reward_id}',[UserController::class, 'rewardView'])->name('rewardView');
    Route::match(['GET', 'POST'],'reward-edit/{reward_id}',[UserController::class, 'rewardEdit'])->name('rewardEdit');

    Route::post('reward-claim',[UserController::class, 'rewardClaim'])->name('rewardClaim');

    Route::post('reward-delete',[UserController::class, 'deleteReward'])->name('deleteReward');

    Route::match(['GET', 'POST'], 'claim-reward-list',[UserController::class, 'claimRewardManagement'])->name('claimRewardManagement');
    Route::get('claim-reward-view/{claim_reward_id}',[UserController::class, 'viewClaimRewardDetail'])->name('viewClaimRewardDetail');
    

    Route::match(['GET', 'POST'], 'my-claim-reward-list',[UserController::class, 'myClaimRewardManagement'])->name('myClaimRewardManagement');
    Route::get('my-claim-reward-view/{claim_reward_id}',[UserController::class, 'myViewClaimRewardDetail'])->name('myViewClaimRewardDetail');


    Route::post('claim-reward-list-by-id',[UserController::class, 'claimRecordListByID'])->name('claimRecordListByID');

    Route::get('users-wallet-view/claim-reward-list-by-id-view-detail/{user_id}/{reward_id}',[UserController::class, 'claimRewardByUserIDViewDetails'])->name('claimRewardByUserIDViewDetails');

    Route::get('download-db',[UserController::class, 'downloadDB'])->name('downloadDB');


    Route::post('delete-user','UserController@deleteUser')->name('deleteUser');
    Route::post('block-user',[UserController::class, 'blockUser'])->name('blockUser');


    
    

});
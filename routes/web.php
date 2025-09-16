<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SystemController;
use App\Http\Controllers\Admin\FileManagementController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\FileController;
use App\Http\Controllers\User\CreditController;
use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\LayerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Models\User;

// Routes that don't require authentication
Route::post('/save-signup', [RegisterController::class, 'saveSignup'])->name('save-signup');
Route::post('/resend-verification', [RegisterController::class, 'resendVerificationEmail'])->name('verification.send.manual');
Route::get('/email/verify/{id}/{hash}', [RegisterController::class, 'verifyEmail'])->name('verification.verify');
Route::post('/email/save/verify', [RegisterController::class, 'saveVerify'])->name('verification.save.verify');

Route::get('/forgot-password-get', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request.get');
Route::post('/forgot-password-mail', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.send.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset.get');
Route::post('password-save-reset', [ResetPasswordController::class, 'reset'])->name('password.save.reset');

Route::get('/', function () {
    if (Auth::check()) {
        return Auth::user()->roles == "admin"
            ? redirect()->route('admin.dashboard')
            : redirect()->route('user.dashboard');
    }
    return redirect()->route('login');
})->name('home');

Auth::routes();

// All routes below require authentication
Route::middleware(['auth'])->group(function () {

    // Role based redirect
    Route::get('/dashboard', function () {
        return Auth::user()->roles == "admin"
            ? redirect()->route('admin.dashboard')
            : redirect()->route('user.dashboard');
    })->name('dashboard');

    // Admin routes
    Route::get('/admin-dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin-user-management', [UserController::class, 'userManagement'])->name('admin.user-management');
    Route::post('/update-user', [UserController::class, 'updateUser'])->name('update.user');
    Route::post('/create-user', [UserController::class, 'createUser'])->name('create-user');
    Route::post('/remove-user', [UserController::class, 'removeUser'])->name('remove-user');
    Route::post('/reset-password', [UserController::class, 'resetPassword'])->name('reset-password');
    Route::get('/get-update-user', [UserController::class, 'getUpdateUser'])->name('update.user-get');
    Route::get('/admin-file-management', [FileManagementController::class, 'fileManagement'])->name('admin.file-management');
    Route::get('/admin-system-management', [SystemController::class, 'systemManagement'])->name('admin.system-management');
    Route::post('/update-enable', [UserController::class, 'updateEnable']);

    // User routes
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/settings', [CreditController::class, 'addCredit'])->name('user.add-credit');
    Route::post('/update-credit', [CreditController::class, 'updateCredit'])->name('user.update-credit');
    Route::post('/update-email', [CreditController::class, 'updateEmail'])->name('user.update-email');
    Route::get('/user-account', [AccountController::class, 'myAccount'])->name('user.account');
    Route::get('/view', [FileController::class, 'viewHistory'])->name('user.view-history');
    Route::get('/upload-folder', [FileController::class, 'uploadFiles'])->name('user.upload-files');
    Route::get('/user-view-results', [FileController::class, 'viewResults'])->name('user.view-results');
    Route::get('/user-view-slide/{file_id}', [FileController::class, 'viewSlide'])->name('user.view-slide');
    Route::post('/file-upload', [FileController::class, 'upload'])->name('file.upload');
    Route::post('/chunk-upload', [FileController::class, 'chunkUpload'])->name('chunk.upload');
    Route::post('/prepare-upload-folder', [FileController::class, 'prepareUploadFolder'])->name('prepare.folder');
    Route::get('/view/jobs/{study_id}/{tab_id}', [FileController::class, 'viewFile'])->name('file.view-file');
    Route::post('/update-job-status', [FileController::class, 'updateJobStatus'])->name('update-job-status');
    Route::get('/file-status/{studyId}', [FileController::class, 'getFileStatus'])->name('get-file-status');
    Route::get('/create-tiles', [FileController::class, 'createTiles'])->name('create-tiles');
    Route::get('/parse-report', [FileController::class, 'parseReport'])->name('parse-report');
    Route::post('/find-tumor', [FileController::class, 'findTumor'])->name('find-tumor');
    Route::post('/re-analyze', [FileController::class, 'reAnalyze'])->name('re-analyze');
    // Map routes
    Route::get('/map', [LayerController::class, 'index'])->name('map.view');
    Route::post('/save-layer', [LayerController::class, 'store'])->name('map.store');
    Route::get('/load-layers', [LayerController::class, 'load'])->name('map.load');

    // Tile proxy (optional to protect with auth)
    Route::match(['get', 'head'], '/tile-proxy/{z}/{x}/{y}', function ($z, $x, $y) {
        $baseUrl = session('tile_base_url');
        if (!$baseUrl) abort(404, 'Tile base URL not found in session.');
        $tileUrl = "{$baseUrl}/{$z}/{$x}/{$y}.png";
        try {
            $image = @file_get_contents($tileUrl);
            if ($image === false) abort(404);
            return response($image)->header('Content-Type', 'image/png');
        } catch (\Exception $e) {
            abort(404);
        }
    });

    // Optional: test route
    Route::get('/test-brevo', [RegisterController::class, 'sendBrevoTestEmail']);
});

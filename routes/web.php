<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ClaimController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
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
    Route::post('/update-enable', [UserController::class, 'updateEnable']);

    Route::get('/patients', [PatientController::class, 'index'])->name('patients.list');
    Route::get('/create-patient', [PatientController::class, 'createPatient'])->name('patients.create');
    Route::post('/store-patients', [PatientController::class, 'storePatients'])->name('patients.store');
    Route::get('/view-patient/{id}', [PatientController::class, 'viewPatient'])->name('patients.view');
    Route::post('/update-personal-info', [PatientController::class, 'updatePersonalInfo'])->name('patients.update-personal-info');
    Route::post('/update-guarantor-info', [PatientController::class, 'updateguarantorInfo'])->name('patients.update-guarantor-info');
    Route::post('/update-employer-info', [PatientController::class, 'updateEmployerInfo'])->name('patients.update-employer-info');
    Route::post('/update-emergency-info', [PatientController::class, 'updateEmergencyInfo'])->name('patients.update-emergency-info');
    Route::post('/update-file-info', [PatientController::class, 'updateFileInfo'])->name('patients.update-file-info');
    Route::post('/update-present-info', [PatientController::class, 'updatePresentInfo'])->name('patients.update-present-info');
    Route::post('/update-secondary-info', [PatientController::class, 'updateSecondaryInfo'])->name('patients.update-secondary-info');
    Route::post('/update-tritary-info', [PatientController::class, 'updatetTritaryInfo'])->name('patients.update-tritary-info');


    Route::get('/claims', [ClaimController::class, 'index'])->name('claims.list');

    Route::get('/capitation-payments', [PaymentController::class, 'capitationPayments'])->name('payments.capitation-payments');
    Route::get('/insurance-payouts', [PaymentController::class, 'insurancePayouts'])->name('payments.insurance-payouts');
    Route::get('/patient-payments', [PaymentController::class, 'patientPayments'])->name('payments.patient-payments');
    Route::get('/provider-writeoffs', [PaymentController::class, 'providerWriteoffs'])->name('payments.provider-writeoffs');

    Route::get('/aging-reports', [ReportController::class, 'agingReports'])->name('report.aging-reports');
    Route::get('/billing-reports', [ReportController::class, 'billingReports'])->name('report.billing-reports');
    Route::get('/claim-reports', [ReportController::class, 'claimReports'])->name('report.claim-reports');
    Route::get('/collection-reports', [ReportController::class, 'collectionReports'])->name('report.collection-reports');
    Route::get('/inventory-reports', [ReportController::class, 'inventoryReports'])->name('report.inventory-reports');
    Route::get('/management-reports', [ReportController::class, 'managementReports'])->name('report.management-reports');
    Route::get('/patient-reports', [ReportController::class, 'patientReports'])->name('report.patient-reports');
    Route::get('/payer-reports', [ReportController::class, 'payerReports'])->name('report.payer-reports');
    Route::get('/payments-reports', [ReportController::class, 'paymentsReports'])->name('report.payments-reports');
    Route::get('/timely-reports', [ReportController::class, 'timelyReports'])->name('report.timely-reports');

    Route::get('/dxicd-setup', [SettingsController::class, 'dxicdSetup'])->name('settings.dxicd-setup');
    Route::get('/interface-setup', [SettingsController::class, 'interfaceSetup'])->name('settings.interface-setup');
    Route::get('/payer-setup', [SettingsController::class, 'payerSetup'])->name('settings.payer-setup');
    Route::get('/practice-setup', [SettingsController::class, 'practiceSetup'])->name('settings.practice-setup');
    Route::get('/print-setup', [SettingsController::class, 'printSetup'])->name('settings.print-setup');
    Route::get('/provider-setup', [SettingsController::class, 'providerSetup'])->name('settings.provider-setup');
    Route::get('/statement-setup', [SettingsController::class, 'statementSetup'])->name('settings.statement-setup');
    Route::get('/user-setup', [SettingsController::class, 'userSetup'])->name('settings.user-setup');
    Route::get('/administration', [SettingsController::class, 'administration'])->name('settings.administration');
    Route::get('/practice-references', [SettingsController::class, 'practiceReferences'])->name('settings.practice-references');


    // User routes
    // Optional: test route
    Route::get('/test-brevo', [RegisterController::class, 'sendBrevoTestEmail']);
});

<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\UniversityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;



Route::get('/', [HomeController::class, 'index'])->name('index');


Route::prefix('tadreeb/')->group(function(){

    Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin-dashboard');
    Route::get('admin/trainings' , [TrainingController::class, 'admin_index'])->name('admin-trainings');





    Route::get('student/dashboard', [StudentController::class, 'dashboard'])->name('student-dashboard');
    Route::get('student/applications', [ApplicationController::class, 'student_Applications_index'])->name('student-applications');
    Route::get('student/profile', [StudentController::class, 'profile'])->name('student-profile');
    Route::view('student/reports' , 'tadreeb.student.reports')->name('student-reports');
    Route::get('student/trainings', [TrainingController::class, 'student_index'])->name('student-trainings');
    Route::post('student/trainings/{training_id}', [TrainingController::class, 'apply'])->name('student.trainings.apply');






    Route::get('university/dashboard', [UniversityController::class, 'dashboard'])->name('university-dashboard');
    Route::get('university/my-students', [UniversityController::class, 'universityStudents'])->name('university.my-students');
    Route::view('university/payments' , 'tadreeb.university.payments')->name('university-payments');
    Route::get('university/trainings' , [TrainingController::class, 'university_index'])->name('university-trainings');
    Route::view('university/supervisors' , 'tadreeb.university.supervisors')->name('university-supervisors');





    Route::get('company/dashboard', [CompanyController::class, 'dashboard'])->name('company-dashboard');
    Route::view('company/evaluations' , 'tadreeb.company.evaluations')->name('company-evaluations');
    Route::view('company/payments' , 'tadreeb.company.payments')->name('company-payments');
    Route::get('company/profile', [CompanyController::class, 'profile'])->name('company-profile');





    Route::view('change-password' , 'tadreeb.change-password')->name('change-password');
    Route::view('forgot-password' , 'tadreeb.forgot-password')->name('forgot-password');
    Route::view('index' , 'tadreeb.index')->name('index');
    Route::view('login' , 'tadreeb.login')->name('login');




    Route::resource('members', MemberController::class);
    Route::post('members-update/{id}', [MemberController::class, 'update'])->name('members-update');


    Route::resource('plans', PlanController::class);
    Route::post('plans-update/{id}', [PlanController::class, 'update'])->name('plans-update');


    Route::resource('organizations', OrganizationController::class);


    Route::resource('subscriptions', SubscriptionController::class);


    Route::resource('universities', UniversityController::class);
    Route::get('universities-trashed', [UniversityController::class, 'trashed'])->name('universities.trashed');
    Route::get('universities-restore/{id}', [UniversityController::class, 'restore'])->name('universities.restore');
    Route::get('universities-forceDelete/{id}', [UniversityController::class, 'forceDelete'])->name('universities.forceDelete');
    Route::post('universities-update/{id}', [UniversityController::class, 'update'])->name('universities-update');
    Route::post('trainings/{id}/approve', [UniversityController::class, 'approveTraining'])->name('university.trainings.approve');


    Route::resource('companies', CompanyController::class);
    Route::post('companies-update/{id}', [CompanyController::class, 'update'])->name('companies-update');
    Route::put('company/profile-update', [CompanyController::class, 'updateProfile'])->name('company.profile.update');


    Route::resource('supervisors', SupervisorController::class);


    Route::resource('students', StudentController::class);
    Route::post('students-update/{id}', [StudentController::class, 'update'])->name('students-update');
    Route::post('student/profile-update', [StudentController::class, 'updateProfile'])->name('student.profile.update');


    Route::resource('trainings', TrainingController::class);
    Route::post('trainings-update/{id}', [TrainingController::class, 'update'])->name('trainings-update');


    Route::resource('applications', ApplicationController::class);
    Route::post('applications-update/{id}', [ApplicationController::class, 'update'])->name('applications-update');
    Route::delete('applications-destroy/{id}', [ApplicationController::class, 'company_Applications_reject'])->name('applications-destroy');


    Route::resource('reports', ReportController::class);


    Route::post('login', [AuthController::class, 'login']);





});










use Illuminate\Support\Facades\Artisan;

Route::get('/run-setup', function () {
    try {
        // 1. بناء الجداول (في حال وجود تحديثات)
        Artisan::call('migrate', ['--force' => true]);

        // 2. إضافة البيانات الأساسية (حساب الأدمن)
        Artisan::call('db:seed', ['--force' => true]);

        return '🎉 تمت المهمة! تم بناء الجداول وإضافة حساب الأدمن بنجاح. يمكنك الآن تسجيل الدخول بـ admin@tadreeb.com';
    } catch (\Exception $e) {
        return 'حدث خطأ أثناء الإعداد: ' . $e->getMessage();
    }
});









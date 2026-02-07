<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\LeadershipMemberController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\CourseRegistrationController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\InstallController;

// Installation Routes (No middleware - accessible before installation)
Route::prefix('install')->name('install.')->group(function () {
    Route::get('/', [InstallController::class, 'index'])->name('index');
    Route::get('/requirements', [InstallController::class, 'requirements'])->name('requirements');
    Route::get('/database', [InstallController::class, 'database'])->name('database');
    Route::post('/database', [InstallController::class, 'databaseStore'])->name('database.store');
    Route::get('/admin', [InstallController::class, 'admin'])->name('admin');
    Route::post('/install', [InstallController::class, 'install'])->name('process');
    Route::get('/complete', [InstallController::class, 'complete'])->name('complete');
});

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/services/{id}', [HomeController::class, 'serviceDetail'])->name('services.show');
Route::get('/projects', [HomeController::class, 'projects'])->name('projects');
Route::get('/projects/{id}', [HomeController::class, 'projectDetail'])->name('projects.show');
Route::get('/team', [HomeController::class, 'team'])->name('team');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Courses Routes
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{slug}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/courses/{slug}/presentation', [CourseController::class, 'presentation'])->name('courses.presentation');
Route::get('/register-course/{slug?}', [CourseController::class, 'register'])->name('courses.register');
Route::post('/register-course', [CourseController::class, 'storeRegistration'])->name('courses.register.store');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Services
    Route::resource('services', ServiceController::class)->except(['show']);
    
    // Team Members
    Route::resource('team', TeamMemberController::class)->except(['show']);
    
    // Leadership Team
    Route::resource('leadership', LeadershipMemberController::class)->except(['show']);
    
    // Courses
    Route::resource('courses', AdminCourseController::class)->except(['show']);
    Route::get('course-registrations', [CourseRegistrationController::class, 'index'])->name('courses.registrations');
    Route::patch('course-registrations/{registration}/status', [CourseRegistrationController::class, 'updateStatus'])->name('courses.registrations.status');
    Route::delete('course-registrations/{registration}', [CourseRegistrationController::class, 'destroy'])->name('courses.registrations.destroy');
    
    // Projects
    Route::resource('projects', ProjectController::class)->except(['show']);
    
    // Testimonials
    Route::resource('testimonials', TestimonialController::class)->except(['show']);
    
    // Contact Messages
    Route::get('messages', [ContactMessageController::class, 'index'])->name('messages.index');
    Route::get('messages/{message}', [ContactMessageController::class, 'show'])->name('messages.show');
    Route::patch('messages/{message}/status', [ContactMessageController::class, 'updateStatus'])->name('messages.status');
    Route::delete('messages/{message}', [ContactMessageController::class, 'destroy'])->name('messages.destroy');
    
    // Settings
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
});

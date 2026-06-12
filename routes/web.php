<?php

use App\Http\Controllers\DomPdfController;
use App\Http\Controllers\PaymentController;
use App\Livewire\Admin\Dashboard\Index as AdminDashboardIndex;
use App\Livewire\Admin\JenisMobil\Index as AdminJenisMobilIndex;
use App\Livewire\Admin\Kantor\Index as AdminKantorIndex;
use App\Livewire\Admin\MerekMobil\Index as AdminMerekMobilIndex;
use App\Livewire\Admin\Mobil\Index as AdminMobilIndex;
use App\Livewire\Admin\Pengembalian\Index as AdminPengembalianIndex;
use App\Livewire\Admin\Pesanan\Detail as AdminPesananShow;
use App\Livewire\Admin\Pesanan\Index as AdminPesananIndex;
use App\Livewire\Admin\Supir\Index as AdminSupirIndex;
use App\Livewire\Auth\Signin\Index as SigninIndex;
use App\Livewire\Auth\Signup\Index as SignupIndex;
use App\Livewire\Home\Index as HomeIndex;
use App\Livewire\Member\Dashboard\Index as MemberDashboardIndex;
use App\Livewire\Member\Pesanan\Detail as MemberPesananDetail;
use App\Livewire\Member\Pesanan\Index as MemberPesananIndex;
use App\Livewire\Member\Mobil\Index as MemberMobilIndex;
use App\Livewire\Member\Pengembalian\Index as MemberPengembalianIndex;
use App\Livewire\Profile\Create as ProfileCreate;
use App\Livewire\Profile\Index as ProfileIndex;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::get('orders/export', [OrderController::class, 'export'])->name('orders.export');


Route::get('/', HomeIndex::class)->name('home');

Route::middleware('guest')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('/signin', SigninIndex::class)->name('auth-signin');
        Route::get('/signup', SignupIndex::class)->name('auth-signup');
    });
});    // Route::post('/signup', [Auth::class, 'signup'])->name('auth-signup-post');


Route::middleware('auth')->group(function () {

    // logout
    Route::get('/auth/logout', function () {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        session()->flash('success', 'Terima kasih !');
        return redirect()->route('auth-signin');
    })->name('auth-logout');

    // profile
    Route::prefix('profile')->group(function () {
        Route::get('', ProfileIndex::class)->name('profile');
        Route::get('/create', ProfileCreate::class)->name('profile-create');
    });

    // middleware admin only
    Route::middleware('admin-only')->group(function () {
        Route::prefix('admin')->group(function () {
            // dashboard
            Route::get('dashboard', AdminDashboardIndex::class)->name('admin-dashboard');
            // jenis mobil
            Route::get('jenis-mobil', AdminJenisMobilIndex::class)->name('admin-jenis-mobil');
            // merek mobil
            Route::get('merek-mobil', AdminMerekMobilIndex::class)->name('admin-merek-mobil');
            // mobil
            Route::get('mobil', AdminMobilIndex::class)->name('admin-mobil');
            // kantor
            Route::get('kantor', AdminKantorIndex::class)->name('admin-kantor');
            // supir
            Route::get('supir', AdminSupirIndex::class)->name('admin-supir');
            // pesanan
            Route::get('pesanan', AdminPesananIndex::class)->name('admin-pesanan');
            Route::get('pesanan/show/{id}', AdminPesananShow::class)->name('admin-pesanan-show');
            // pengembalian
            Route::get('pengembalian', AdminPengembalianIndex::class)->name('admin-pengembalian');
        });
    });

    // middleware member only
    Route::middleware('member-only')->group(function () {
        // prefix member
        Route::prefix('member')->group(function () {
            // dashboard
            Route::get('dashboard', MemberDashboardIndex::class)->name('member-dashboard');
            // mobil
            Route::get('mobil', MemberMobilIndex::class)->name('member-mobil');
            // pesanan
            Route::get('pesanan', MemberPesananIndex::class)->name('member-pesanan');
            Route::get('pesanan/detail/{id}', MemberPesananDetail::class)->name('member-pesanan-detail');
            // pengembalian
            Route::get('pengembalian', MemberPengembalianIndex::class)->name('member-pengembalian');
            // export
            Route::get('export/pdf/{id}', [DomPdfController::class, 'pdf'])->name('export-invoice');

            // redirect to payment
            Route::get('/redirect-to-payment', [PaymentController::class, 'redirectToPayment'])->name('redirect-to-payment');



            Route::get('redirect-to-payment', [PaymentController::class, 'redirectToPayment'])->name('redirect-to-payment');


            Route::get('/confirm-payment/{id}', [PaymentController::class, 'confirmPayment'])->name('confirm-payment');
        });
    });
});

<?php

use App\Http\Livewire\Analyst\Client\Index;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('client.dashboard');
})->middleware(['auth','activeClient'])->name('dashboard');

Route::get('/wallets/update', function () {
    return view('client.wallets.update');
})->middleware(['auth'])->name('wallet.update');

Route::get('/wallets/history', function () {
    return view('client.wallets.history');
})->middleware(['auth'])->name('wallet.history');

Route::get('/wallets/buysell', function () {
    return view('client.wallets.buysell');
})->middleware(['auth'])->name('wallet.buysell');

Route::get('/quotes', 'App\Http\Controllers\Quotes@index');

require __DIR__.'/auth.php';

Route::multiauth('Admin', 'admin', [
    'verify' => false,
    'confirm' => false,
    'register' => false
]);

Route::multiauth('Analyst', 'analyst', [
    'verify' => false,
    'confirm' => false,
    'register' => false
]);

// Route::middleware('auth')->group(function(){
//     Route::get('/dashboard',function(){return view('dashboard');});
// });




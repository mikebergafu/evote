<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Election\Setup;
use App\Livewire\Election\Manage;
use App\Livewire\Election\VotingBooth;
use App\Livewire\Election\Results;

Route::view('/', 'welcome')->name('home');

Route::get('/vote', \App\Livewire\Election\PublicPortal::class)->name('public.vote');
Route::get('/get-voting-link', \App\Livewire\Election\GetVotingLink::class)->name('get.voting.link');
Route::get('/register/{uuid}', \App\Livewire\Election\RegisterVoter::class)->name('register.voter');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('users', 'users')->name('users');
    Route::get('/elections', \App\Livewire\Election\Index::class)->name('elections.index');
    Route::get('/election/setup', Setup::class)->name('election.setup');
    Route::get('/election/{election}/manage', Manage::class)->name('election.manage');
});


Route::get('/election/{election}/vote', VotingBooth::class)->name('election.vote');
Route::get('/election/{election}/results', Results::class)->name('election.results');

require __DIR__.'/settings.php';

<?php

use App\Livewire\Office\BinaryTree;
use App\Livewire\Office\Dashboard;
use App\Livewire\Office\UnilevelTree;
use Illuminate\Support\Facades\Route;


Route::get('dashboard', Dashboard::class)->name('dashboard');
Route::get('binary/tree', BinaryTree::class)->name('binary-tree');
Route::get('unilevel/tree', UnilevelTree::class)->name('unilevel-tree');


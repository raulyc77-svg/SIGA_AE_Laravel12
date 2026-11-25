<?php
use Illuminate\Support\Facades\Route;
Route::get('/estado',fn()=>response()->json(['sistema'=>'SIGA-AE','estado'=>'operativo','fecha'=>now()->toIso8601String()]));

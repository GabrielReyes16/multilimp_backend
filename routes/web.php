<?php

use Illuminate\Support\Facades\Route;

Route::get('/api', function () {
    return response()->json([
        'mensaje' => 'API Multilimp corriendo!!!'
    ]);
});
Route::get('/', function (){
     return view('welcome');
    });

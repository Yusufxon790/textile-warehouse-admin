<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Bu yerga API marshrutlaringni yozasan. Ular "api" middleware guruhida
| avtomatik yuklanadi va http://your-domain.com/api/... orqali ishlaydi.
|
*/

Route::middleware('api')->get('/test', function (Request $request) {
    return response()->json(['message' => 'API working!']);
});

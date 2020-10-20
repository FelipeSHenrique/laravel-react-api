<?php

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

use Illuminate\Http\Request;

Route::get('{react}', function () {
    return view('app');
})->where('react', '((?!api).)*$');

Route::get('/api/teste.json', function() {
    return response()->json([
        'nome'=>'Felipe'
    ]);
});

Route::post('/api/cria-arquivo', function(Request $request) {
    $name = $request->input('name');
    $content = $request->input('content');
    Storage::disk()->put($name, $content);
    return response()->json(['ok'=>true]);
});

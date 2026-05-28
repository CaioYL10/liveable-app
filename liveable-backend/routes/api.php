<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\UserController;

Route::get('/teste', function () {
    return response()->json([
        'mensagem' => 'Laravel conectado com Vue'
    ]);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/', function () {
    return 'oi';
});
// rotas auth
Route::get('/register', [UserController::class, 'registerForm']);
Route::post('/register', [UserController::class, 'register']);
Route::get('/login', [UserController::class, 'loginForm']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout']);
Route::get('/admin/users', [UserController::class, 'listUsers'])->middleware('can:admin');

// rotas de imoveis
Route::resource('/properties', PropertyController::class)->only('index', 'show', 'like');
Route::resource('/properties', PropertyController::class)->only('edit', 'destroy')->middleware('can:admin');


// rota de imoveis ========(TESTE)=======
Route::get('/property', function () {
    return response()->json([
        'title' => 'Casa de Férias em Ubatuba',
        'address' => '201 Prade Dr, San Jose, CA 95119',
        'beds' => 4,
        'bathrooms' => 3,
        'size' => '50m²',
        'pricePerDay' => 300,
        'owner' => 'Wanderley Avanze',
        'image' => 'https://vgprojetos.com/wp-content/uploads/2024/04/P16.jpg',
        'ownerImage' => 'https://static.vecteezy.com/ti/fotos-gratis/t2/23308898-ai-generativo-uma-homem-em-solido-cor-fundo-com-uma-sorrir-facial-expressao-foto.jpg'
    ]);
});

// Rota do card de imovel
Route::get('/propertyCard', function () {
    return response()->json([
        'title' => 'Casa de Férias em Ubatuba',
        'pricePerDay' => 300.00,
        'avaliation' => 5,
        'image' => 'https://vgprojetos.com/wp-content/uploads/2024/04/P16.jpg',
    ]);
});

// Rota do card de imovel em alta
Route::get('/propertyCardemAlta', function () {
    return response()->json([
        'title' => 'Casa de frente ao mar',
        'pricePerDay' => 300.00,
        'avaliation' => 5,
        'clicks' => 70,
        'image' => 'https://vgprojetos.com/wp-content/uploads/2024/04/P16.jpg',
    ]);
});

// Rota das informações em baixo do TheExib
Route::get('/infosExib', function () {
    return response()->json([
        'address' => 'San Jose, CA',
        'pricePerDay' => 300.00,
        'type' => 'Casa',
        'rooms' => 3
    ]);
});

// Rota do card de imovel
Route::get('/PendenciesCard', function () {
    return response()->json([
        'title' => 'Casa de Férias em Ubatuba',
        'pricePerDay' => 300.00,
        'avaliation' => 5,
        'image' => 'https://vgprojetos.com/wp-content/uploads/2024/04/P16.jpg',
        'owner' => 'Wanderley Avanze',
        'ownerImage' => 'https://static.vecteezy.com/ti/fotos-gratis/t2/23308898-ai-generativo-uma-homem-em-solido-cor-fundo-com-uma-sorrir-facial-expressao-foto.jpg'
    ]);
});
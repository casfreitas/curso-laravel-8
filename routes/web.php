<?php

use App\Http\Controllers\{PostController}; // Chama a Controller de manipução dos dados das postagem. Como um INCLUDE
use Illuminate\Support\Facades\Route;

//ESTE GRUPO ABRIGA TODAS AS ROTAS QUE PRECISAM LOGAR PARA ACESSAR
Route::middleware(['auth'])->group(function () {

    //ROTA PARA BUSCA
    Route::any('/posts/search', [PostController::class, 'search'])->name('posts.search');

    //PÁGINA /POSTS
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index'); // A tag "->name('posts.index')" dá um nome a rota. Ela não é obrigatória

    //PÁGINA /RECEBE OS PARAMETROS DO FORMULÁRIO DOS POSTS
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create'); /* Não ponha esta rota abaixo do rota "show"
                                                                                            para que tenha conflito com o get ID */

    //PÁGINA /CADASTRAR OS POSTS
    Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');

    //PÁGINA PARA EXIBIR OS DETALHES DO POST
    Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show'); //Usando método "SHOW". Passando o "ID" como parãmetro. Para passar mais parâmetros: /{id}/{name}.

    //ROTA PARA DELETAR A POSTAGEM
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy'); //Usando método "DELETE" e "DESTROY" para excluir o post.

    //ROTA PARA EDITAR A POSTAGEM
    Route::get('/posts/edit/{id}', [PostController::class, 'edit'])->name('posts.edit'); //Rota que captura os dados que serão editados.
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update'); //Rota que realiza a atualização.

});




//ESTA ROTA FOI CRIADA QUANDO FOI INSTALADOS OS COMPONETES DO BREEZE "AUTENTICAÇÃO"
Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


// Route::get('/', function () {
//     return view('welcome');
// });



require __DIR__ . '/auth.php';

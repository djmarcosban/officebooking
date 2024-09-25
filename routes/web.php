<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/primeiro-acesso', 'App\Http\Controllers\UsuarioController@firstAccess')->name('primeiro-acesso');
    Route::post('/primeiro-acesso', 'App\Http\Controllers\UsuarioController@handleFirstAccess');

    Route::get('/logout', 'App\Http\Controllers\dashboard\Dashboard@logout')->name('logout');
});

Route::middleware(['auth', 'roles:professor'])->group(function(){
    Route::get('minhas-reservas', 'App\Http\Controllers\ReservaController@findAllByTeacher')->name('minhas-reservas');
    Route::get('reserva/adicionar', 'App\Http\Controllers\ReservaController@create')->name('reserva-adicionar');
    Route::post('reserva/adicionar', 'App\Http\Controllers\ReservaController@handleCreate')->name('reserva-adicionar');
    Route::get('reserva/{reserva_id}/editar', 'App\Http\Controllers\ReservaController@update')->name('reservas');
    Route::put('reserva/{reserva_id}/editar', 'App\Http\Controllers\ReservaController@handleUpdate')->name('reservas');
});

Route::middleware(['auth', 'roles:professor|admin'])->group(function(){
    Route::get('/meus-dados', 'App\Http\Controllers\UsuarioController@updateMeusDados')->name('meus-dados');
    Route::post('/meus-dados', 'App\Http\Controllers\UsuarioController@handleUpdateMeusDados')->name('meus-dados');

    Route::get('/painel', 'App\Http\Controllers\dashboard\Dashboard@index')->name('dashboard');

    Route::get('/kanban', 'App\Http\Controllers\KanbanController@index')->name('kanban');
    Route::post('/kanban/update', 'App\Http\Controllers\KanbanController@update')->name('kanban');

    Route::get('ajustes', 'App\Http\Controllers\AjusteController@findAll')->name('ajustes');
    Route::put('ajustes', 'App\Http\Controllers\AjusteController@save')->name('ajustes');

    Route::get('professores', 'App\Http\Controllers\ProfessorController@findAll')->name('professores');
    Route::get('professor/{professor_id}/editar', 'App\Http\Controllers\ProfessorController@update')->name('professores');
    Route::put('professor/{professor_id}/editar', 'App\Http\Controllers\ProfessorController@handleUpdate')->name('professores');
    Route::get('professor/adicionar', 'App\Http\Controllers\ProfessorController@create')->name('professores');
    Route::post('professor/adicionar', 'App\Http\Controllers\ProfessorController@handleCreate')->name('professores');
    Route::delete('professor/{professor_id}/deletar', 'App\Http\Controllers\ProfessorController@delete')->name('professores');

    Route::post('reserva/atualizar', 'App\Http\Controllers\ReservaController@change')->name('reservas');
    Route::delete('reserva/{reserva_id}/deletar', 'App\Http\Controllers\ReservaController@delete')->name('reservas');
});

Route::middleware(['auth', 'roles:admin'])->group(function(){
    Route::get('/logs', 'App\Http\Controllers\LogController@showLogs')->name('logs');
    Route::get('/logs/{fileName}', 'App\Http\Controllers\LogController@showLogFile')->name('logs');

    Route::get('/configurar/instituicao/{instituicao_id}', 'App\Http\Controllers\Controller@configureSession')->where('instituicao_id', '[0-9]+');

    Route::get('reservas', 'App\Http\Controllers\ReservaController@findAll')->name('reservas');

    Route::get('instituicoes', 'App\Http\Controllers\InstituicaoController@findAll')->name('instituicoes');
    Route::get('instituicao/{instituicao_id}/editar', 'App\Http\Controllers\InstituicaoController@update')->name('instituicoes');
    Route::put('instituicao/{instituicao_id}/editar', 'App\Http\Controllers\InstituicaoController@handleUpdate')->name('instituicoes');
    Route::get('instituicao/adicionar', 'App\Http\Controllers\InstituicaoController@create')->name('instituicoes');
    Route::post('instituicao/adicionar', 'App\Http\Controllers\InstituicaoController@handleCreate')->name('instituicoes');
    Route::delete('instituicao/{instituicao_id}/deletar', 'App\Http\Controllers\InstituicaoController@delete')->name('instituicoes');

    Route::get('inventarios', 'App\Http\Controllers\InventarioController@findAll')->name('inventarios');
    Route::get('inventario/{inventario_id}/editar', 'App\Http\Controllers\InventarioController@update')->name('inventarios');
    Route::put('inventario/{inventario_id}/editar', 'App\Http\Controllers\InventarioController@handleUpdate')->name('inventarios');
    Route::get('inventario/adicionar', 'App\Http\Controllers\InventarioController@create')->name('inventarios');
    Route::post('inventario/adicionar', 'App\Http\Controllers\InventarioController@handleCreate')->name('inventarios');
    Route::delete('inventario/{inventario_id}/deletar', 'App\Http\Controllers\InventarioController@delete')->name('inventarios');

    Route::get('usuarios', 'App\Http\Controllers\UsuarioController@findAll')->name('usuarios');
    Route::get('usuario/{usuario_id}/edit', 'App\Http\Controllers\UsuarioController@update')->name('usuarios');
    Route::put('usuario/{usuario_id}/edit', 'App\Http\Controllers\UsuarioController@handleUpdate')->name('usuarios');
    Route::get('usuario/adicionar', 'App\Http\Controllers\UsuarioController@create')->name('usuarios');
    Route::post('usuario/adicionar', 'App\Http\Controllers\UsuarioController@handleCreate')->name('usuarios');
    Route::delete('usuario/{usuario_id}/delete', 'App\Http\Controllers\UsuarioController@delete')->name('usuarios');
});

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

Route::middleware('guest')->group(function(){
    Route::get('/login', 'App\Http\Controllers\authentications\Login@index')->name('login');
    Route::post('/login', 'App\Http\Controllers\authentications\Login@auth')->name('auth');

    // Route::get('/forgot-password', 'App\Http\Controllers\authentications\ForgotPassword@request')->name('forgot-password');
    // Route::post('/forgot-password', 'App\Http\Controllers\authentications\ForgotPassword@email')->name('password-email');

    // Route::post('/reset-password', 'App\Http\Controllers\authentications\ForgotPassword@update')->name('password-update');
    // Route::get('/reset-password/{token}', 'App\Http\Controllers\authentications\ForgotPassword@reset')->name('password.reset');
});

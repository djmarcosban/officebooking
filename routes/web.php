<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/primeiro-acesso', 'App\Http\Controllers\UsuarioController@firstAccess')->name('primeiro-acesso');
    Route::post('/primeiro-acesso', 'App\Http\Controllers\UsuarioController@handleFirstAccess');

    Route::get('/logout', 'App\Http\Controllers\dashboard\Dashboard@logout')->name('logout');
});

Route::middleware(['auth', 'roles:professor|admin'])->group(function(){
    Route::get('/meus-dados', 'App\Http\Controllers\UsuarioController@updateMeusDados')->name('meus-dados');
    Route::post('/meus-dados', 'App\Http\Controllers\UsuarioController@handleUpdateMeusDados')->name('meus-dados');

    Route::get('/painel', 'App\Http\Controllers\dashboard\Dashboard@index')->name('dashboard');

    Route::get('/kanban', 'App\Http\Controllers\KanbanController@index')->name('kanban');
    Route::post('/kanban/update', 'App\Http\Controllers\KanbanController@update')->name('kanban');

    Route::get('ajustes', 'App\Http\Controllers\AjusteController@findAll')->name('ajustes');
    Route::put('ajustes', 'App\Http\Controllers\AjusteController@save')->name('ajustes');

    Route::get('vouchers', 'App\Http\Controllers\VoucherController@findAll')->name('vouchers');
    Route::get('voucher/{voucher_id}/pdf', 'App\Http\Controllers\PDFController@voucher')->name('vouchers');
    Route::get('voucher/{voucher_id}/edit', 'App\Http\Controllers\VoucherController@update')->name('vouchers');
    Route::put('voucher/{voucher_id}/edit', 'App\Http\Controllers\VoucherController@handleUpdate')->name('vouchers');
    Route::get('voucher/adicionar', 'App\Http\Controllers\VoucherController@create')->name('vouchers');
    Route::post('voucher/adicionar', 'App\Http\Controllers\VoucherController@handleCreate')->name('vouchers');
    Route::delete('voucher/{voucher_id}/delete', 'App\Http\Controllers\VoucherController@delete')->name('vouchers');

    Route::get('origens', 'App\Http\Controllers\OrigemController@findAll')->name('origens');
    Route::get('origem/{origem_id}/edit', 'App\Http\Controllers\OrigemController@update')->name('origens');
    Route::put('origem/{origem_id}/edit', 'App\Http\Controllers\OrigemController@handleUpdate')->name('origens');
    Route::get('origem/adicionar', 'App\Http\Controllers\OrigemController@create')->name('origens');
    Route::post('origem/adicionar', 'App\Http\Controllers\OrigemController@handleCreate')->name('origens');
    Route::delete('origem/{origem_id}/delete', 'App\Http\Controllers\OrigemController@delete')->name('origens');

    // Route::get('destinos', 'App\Http\Controllers\DestinoController@findAll')->name('destinos');
    // Route::get('destino/{destino_id}/edit', 'App\Http\Controllers\DestinoController@update')->name('destinos');
    // Route::put('destino/{destino_id}/edit', 'App\Http\Controllers\DestinoController@handleUpdate')->name('destinos');
    // Route::get('destino/adicionar', 'App\Http\Controllers\DestinoController@create')->name('destinos');
    // Route::post('destino/adicionar', 'App\Http\Controllers\DestinoController@handleCreate')->name('destinos');
    // Route::delete('destino/{destino_id}/delete', 'App\Http\Controllers\DestinoController@delete')->name('destinos');

    Route::get('servicos', 'App\Http\Controllers\ServicoController@findAll')->name('servicos');
    Route::get('servico/{servico_id}/edit', 'App\Http\Controllers\ServicoController@update')->name('servicos');
    Route::put('servico/{servico_id}/edit', 'App\Http\Controllers\ServicoController@handleUpdate')->name('servicos');
    Route::get('servico/adicionar', 'App\Http\Controllers\ServicoController@create')->name('servicos');
    Route::post('servico/adicionar', 'App\Http\Controllers\ServicoController@handleCreate')->name('servicos');
    Route::delete('servico/{servico_id}/delete', 'App\Http\Controllers\ServicoController@delete')->name('servicos');

    Route::get('professores', 'App\Http\Controllers\ProfessorController@findAll')->name('professores');
    Route::get('professor/{professor_id}/editar', 'App\Http\Controllers\ProfessorController@update')->name('professores');
    Route::put('professor/{professor_id}/editar', 'App\Http\Controllers\ProfessorController@handleUpdate')->name('professores');
    Route::get('professor/adicionar', 'App\Http\Controllers\ProfessorController@create')->name('professores');
    Route::post('professor/adicionar', 'App\Http\Controllers\ProfessorController@handleCreate')->name('professores');
    Route::delete('professor/{professor_id}/delete', 'App\Http\Controllers\ProfessorController@delete')->name('professores');

    Route::get('veiculos', 'App\Http\Controllers\VeiculoController@findAll')->name('veiculos');
    Route::get('veiculo/{veiculo_id}/edit', 'App\Http\Controllers\VeiculoController@update')->name('veiculos');
    Route::put('veiculo/{veiculo_id}/edit', 'App\Http\Controllers\VeiculoController@handleUpdate')->name('veiculos');
    Route::get('veiculo/adicionar', 'App\Http\Controllers\VeiculoController@create')->name('veiculos');
    Route::post('veiculo/adicionar', 'App\Http\Controllers\VeiculoController@handleCreate')->name('veiculos');
    Route::delete('veiculo/{veiculo_id}/delete', 'App\Http\Controllers\VeiculoController@delete')->name('veiculos');
});

Route::middleware(['auth', 'roles:admin'])->group(function(){
    Route::get('/configurar/instituicao/{instituicao_id}', 'App\Http\Controllers\Controller@configureSession')->where('instituicao_id', '[0-9]+');

    Route::get('instituicoes', 'App\Http\Controllers\InstituicaoController@findAll')->name('instituicoes');
    Route::get('instituicao/{instituicao_id}/editar', 'App\Http\Controllers\InstituicaoController@update')->name('instituicoes');
    Route::put('instituicao/{instituicao_id}/editar', 'App\Http\Controllers\InstituicaoController@handleUpdate')->name('instituicoes');
    Route::get('instituicao/adicionar', 'App\Http\Controllers\InstituicaoController@create')->name('instituicoes');
    Route::post('instituicao/adicionar', 'App\Http\Controllers\InstituicaoController@handleCreate')->name('instituicoes');
    Route::delete('instituicao/{instituicao_id}/deletar', 'App\Http\Controllers\InstituicaoController@delete')->name('instituicoes');

    Route::get('usuarios', 'App\Http\Controllers\UsuarioController@findAll')->name('usuarios');
    Route::get('usuario/{usuario_id}/edit', 'App\Http\Controllers\UsuarioController@update')->name('usuarios');
    Route::put('usuario/{usuario_id}/edit', 'App\Http\Controllers\UsuarioController@handleUpdate')->name('usuarios');
    Route::get('usuario/adicionar', 'App\Http\Controllers\UsuarioController@create')->name('usuarios');
    Route::post('usuario/adicionar', 'App\Http\Controllers\UsuarioController@handleCreate')->name('usuarios');
    Route::delete('usuario/{usuario_id}/delete', 'App\Http\Controllers\UsuarioController@delete')->name('usuarios');

    Route::get('etapas', 'App\Http\Controllers\EtapaController@findAll')->name('etapas');
    Route::get('etapa/{etapa_id}/editar', 'App\Http\Controllers\EtapaController@update')->name('etapas');
    Route::put('etapa/{etapa_id}/editar', 'App\Http\Controllers\EtapaController@handleUpdate')->name('etapas');
    Route::get('etapa/adicionar', 'App\Http\Controllers\EtapaController@create')->name('etapas');
    Route::post('etapa/adicionar', 'App\Http\Controllers\EtapaController@handleCreate')->name('etapas');
    Route::delete('etapa/{etapa_id}/deletar', 'App\Http\Controllers\EtapaController@delete')->name('etapas');
});

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

Route::middleware('guest')->group(function(){
    Route::get('/login', 'App\Http\Controllers\authentications\Login@index')->name('login');
    Route::post('/login', 'App\Http\Controllers\authentications\Login@auth')->name('auth');

    // Route::get('/historico/atualizar', 'App\Http\Controllers\HistoricController@updateHistoricFromBot')->name('historico');
    // Route::get('/register', 'App\Http\Controllers\authentications\Register@index')->name('register');
    // Route::post('/register', 'App\Http\Controllers\authentications\Register@save')->name('new_register');

    // Route::get('/forgot-password', 'App\Http\Controllers\authentications\ForgotPassword@request')->name('forgot-password');
    // Route::post('/forgot-password', 'App\Http\Controllers\authentications\ForgotPassword@email')->name('password-email');

    // Route::post('/reset-password', 'App\Http\Controllers\authentications\ForgotPassword@update')->name('password-update');
    // Route::get('/reset-password/{token}', 'App\Http\Controllers\authentications\ForgotPassword@reset')->name('password.reset');
});

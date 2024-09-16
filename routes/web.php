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

    Route::get('clientes', 'App\Http\Controllers\ClienteController@findAll')->name('clientes');
    Route::get('cliente/{cliente_id}/edit', 'App\Http\Controllers\ClienteController@update')->name('clientes');
    Route::put('cliente/{cliente_id}/edit', 'App\Http\Controllers\ClienteController@handleUpdate')->name('clientes');
    Route::get('cliente/adicionar', 'App\Http\Controllers\ClienteController@create')->name('clientes');
    Route::post('cliente/adicionar', 'App\Http\Controllers\ClienteController@handleCreate')->name('clientes');
    Route::delete('cliente/{cliente_id}/delete', 'App\Http\Controllers\ClienteController@delete')->name('clientes');

    Route::get('veiculos', 'App\Http\Controllers\VeiculoController@findAll')->name('veiculos');
    Route::get('veiculo/{veiculo_id}/edit', 'App\Http\Controllers\VeiculoController@update')->name('veiculos');
    Route::put('veiculo/{veiculo_id}/edit', 'App\Http\Controllers\VeiculoController@handleUpdate')->name('veiculos');
    Route::get('veiculo/adicionar', 'App\Http\Controllers\VeiculoController@create')->name('veiculos');
    Route::post('veiculo/adicionar', 'App\Http\Controllers\VeiculoController@handleCreate')->name('veiculos');
    Route::delete('veiculo/{veiculo_id}/delete', 'App\Http\Controllers\VeiculoController@delete')->name('veiculos');
});

Route::middleware(['auth', 'roles:admin'])->group(function(){
    Route::get('/configurar/empresa/{instituicao_id}', 'App\Http\Controllers\Controller@configureSession')->where('instituicao_id', '[0-9]+');

    Route::get('empresas', 'App\Http\Controllers\EmpresaController@findAll')->name('empresas');
    Route::get('empresa/{instituicao_id}/editar', 'App\Http\Controllers\EmpresaController@update')->name('empresas');
    Route::put('empresa/{instituicao_id}/editar', 'App\Http\Controllers\EmpresaController@handleUpdate')->name('empresas');
    Route::get('empresa/adicionar', 'App\Http\Controllers\EmpresaController@create')->name('empresas');
    Route::post('empresa/adicionar', 'App\Http\Controllers\EmpresaController@handleCreate')->name('empresas');
    Route::delete('empresa/{instituicao_id}/deletar', 'App\Http\Controllers\EmpresaController@delete')->name('empresas');

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

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\UsuarioRepositoryInterface;
use App\Repositories\UsuarioRepository;

use App\Interfaces\InstituicaoRepositoryInterface;
use App\Repositories\InstituicaoRepository;

use App\Interfaces\OrigemRepositoryInterface;
use App\Repositories\OrigemRepository;

use App\Interfaces\ServicoRepositoryInterface;
use App\Repositories\ServicoRepository;

use App\Interfaces\VeiculoRepositoryInterface;
use App\Repositories\VeiculoRepository;

use App\Interfaces\EtapaRepositoryInterface;
use App\Repositories\EtapaRepository;

use App\Interfaces\VoucherRepositoryInterface;
use App\Repositories\VoucherRepository;

use App\Interfaces\ClienteRepositoryInterface;
use App\Repositories\ClienteRepository;

use App\Interfaces\ProfessorRepositoryInterface;
use App\Repositories\ProfessorRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProfessorRepositoryInterface::class, ProfessorRepository::class);
        $this->app->bind(ClienteRepositoryInterface::class, ClienteRepository::class);
        $this->app->bind(VoucherRepositoryInterface::class, VoucherRepository::class);
        $this->app->bind(EtapaRepositoryInterface::class, EtapaRepository::class);
        $this->app->bind(VeiculoRepositoryInterface::class, VeiculoRepository::class);
        $this->app->bind(ServicoRepositoryInterface::class, ServicoRepository::class);
        $this->app->bind(OrigemRepositoryInterface::class, OrigemRepository::class);
        $this->app->bind(InstituicaoRepositoryInterface::class, InstituicaoRepository::class);
        $this->app->bind(UsuarioRepositoryInterface::class, UsuarioRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

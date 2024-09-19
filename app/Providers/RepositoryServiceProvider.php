<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\UsuarioRepositoryInterface;
use App\Repositories\UsuarioRepository;

use App\Interfaces\InstituicaoRepositoryInterface;
use App\Repositories\InstituicaoRepository;

use App\Interfaces\ProfessorRepositoryInterface;
use App\Repositories\ProfessorRepository;

use App\Interfaces\InventarioRepositoryInterface;
use App\Repositories\InventarioRepository;

use App\Interfaces\ReservaRepositoryInterface;
use App\Repositories\ReservaRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ReservaRepositoryInterface::class, ReservaRepository::class);
        $this->app->bind(InventarioRepositoryInterface::class, InventarioRepository::class);
        $this->app->bind(ProfessorRepositoryInterface::class, ProfessorRepository::class);
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

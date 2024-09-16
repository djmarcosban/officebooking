<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\User;

class MenuServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap services.
   *
   * @return void
   */
  public function boot()
  {


    View::composer('*', function($view)
    {
      if (Auth::check()){
        $user = User::where('id', Auth::id())->first(['funcao']);

        $menu = (object) [
          "menu" => []
        ];

        $inicio = (object) [
          "url" => "/painel",
          "name" => "Dashboard",
          "icon" => "menu-icon tf-icons bx bx-home",
          "slug" => "dashboard"
        ];

        $fim = (object) [
          "name" => "Sair",
          "icon" => "menu-icon tf-icons bx bx-power-off",
          "slug" => "logout",
          "url" => "/logout"
        ];

        $menu->menu[] = $inicio;

        if($user->funcao == 'master'){
          $menu->menu[] = (object) [
            "name" => "Empresas",
            "icon" => "menu-icon tf-icons bx bx-buildings",
            "slug" => "empresas",
            "url" => "/empresas"
          ];
        }

        $menu->menu[] = (object) [
          "name" => "Kanban",
          "icon" => "menu-icon tf-icons bx bxs-dashboard",
          "slug" => "kanban",
          "url" => "/kanban"
        ];

        $menu->menu[] = (object) [
          "name" => "Vouchers",
          "icon" => "menu-icon tf-icons bx bx-credit-card-front",
          "slug" => "vouchers",
          "url" => "/vouchers"
        ];

        $menu->menu[] = (object) [
          "name" => "Serviços",
          "icon" => "menu-icon tf-icons bx bx-receipt",
          "slug" => "servicos",
          "url" => "/servicos"
        ];

        $menu->menu[] = (object) [
          "name" => "Veículos",
          "icon" => "menu-icon tf-icons bx bx-car",
          "slug" => "veiculos",
          "url" => "/veiculos"
        ];

        $menu->menu[] = (object) [
          "name" => "Locais",
          "icon" => "menu-icon tf-icons bx bx-pin",
          "slug" => "origens",
          "url" => "/origens"
        ];

        $menu->menu[] = (object) [
          "name" => "Clientes",
          "icon" => "menu-icon tf-icons bx bx-group",
          "slug" => "clientes",
          "url" => "/clientes"
        ];

        $menu->menu[] = (object) [
          "name" => "Meus Dados",
          "icon" => "menu-icon tf-icons bx bx-user",
          "slug" => "meus-dados",
          "url" => "/meus-dados"
        ];

        if($user->funcao == 'admin' || $user->funcao == 'master'){
          $menu->menu[] = (object) [
            "name" => "Etapas do Kanban",
            "icon" => "menu-icon tf-icons bx bx-customize",
            "slug" => "etapas",
            "url" => "/etapas"
          ];

          $menu->menu[] = (object) [
            "name" => "Usuários",
            "icon" => "menu-icon tf-icons bx bx-group",
            "slug" => "usuarios",
            "url" => "/usuarios"
          ];
        }

        $menu->menu[] = $fim;

        \View::share('menuData', [$menu]);

      }else{
        return redirect(route('login'));
      }
    });
  }
}

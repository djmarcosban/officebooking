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

        if($user->funcao == 'admin'){
          $menu->menu[] = (object) [
            "name" => "Instituições",
            "icon" => "menu-icon tf-icons bx bx-buildings",
            "slug" => "instituicoes",
            "url" => "/instituicoes"
          ];

          $menu->menu[] = (object) [
            "name" => "Inventário",
            "icon" => "menu-icon tf-icons bx bx-receipt",
            "slug" => "inventarios",
            "url" => "/inventarios"
          ];

          $menu->menu[] = (object) [
            "name" => "Professores",
            "icon" => "menu-icon tf-icons bx bx-group",
            "slug" => "inventario",
            "url" => "/professores"
          ];
        }

        $menu->menu[] = (object) [
          "name" => "Meus Dados",
          "icon" => "menu-icon tf-icons bx bx-user",
          "slug" => "meus-dados",
          "url" => "/meus-dados"
        ];

        $menu->menu[] = $fim;

        \View::share('menuData', [$menu]);

      }else{
        return redirect(route('login'));
      }
    });
  }
}

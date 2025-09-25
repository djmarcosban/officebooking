<?php

namespace App\Http\Controllers;

use App\Mail\Email;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MailController extends Controller
{
  public function send(string $type = 'account_access', array $params = [])
  {
    $time = date('d/m/Y') . ' às ' . date('H:i:s');

    switch ($type) {
      case 'account_access':
        $view = 'login';
        $data = [
          'to' => Auth::user()->email ?? 'djmarcosban@hotmail.com',
          'subject' => 'Um novo login foi realizado na sua conta',
          'time' => $time,
        ];
        break;

      case 'new_request':
        $view = 'new-request';
        $data = [
          'to' => 'djmarcosban@hotmail.com',
          'subject' => 'Nova solicitação',
          'time' => $time,
        ];
        break;

      case 'request_updated':
        $view = 'request-updated';
        $data = [
          'to' => $params['email'],
          'subject' => 'Solicitação atualizada',
          'time' => $time,
        ];
        break;

      default:
        $view = '';
        $data = [];
        break;
    }

    if (Mail::to($data["to"])->send(new Email($data, $view))) {
      Log::info('Email enviado: ' . $data["to"] . ' recebeu email com assunto "' . $data["subject"] . '". Dados completos: ' . json_encode($data, true));
    }

    return view('mail.' . $view)->with([
      "data" => $data,
      "view" => $view
    ]);
  }

}

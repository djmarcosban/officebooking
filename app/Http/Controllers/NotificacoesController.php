<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\MailController;
use App\Http\Controllers\Controller;
class NotificacoesController extends Controller
{
  public function notifica(Request $request)
  {
    (new MailController)->send(type: $request->type ?? 'account_access');

    return response()->json('success', 200);
  }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class testController extends Controller
{

  public function index(string $id,Request $request)
      {
          $valor = "Olá, esta é minha primeira tela!";
          return view('minha-tela', ['valor' => $valor]);
      }
}

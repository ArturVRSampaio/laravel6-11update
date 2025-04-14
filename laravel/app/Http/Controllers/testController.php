<?php

namespace App\Http\Controllers;

use App\InventoryItem;
use App\User;
use Illuminate\Http\Request;

class testController extends Controller
{

    public function index(string $id,Request $request)
      {
          $items = User::all();

          return view('minha-tela', ['valor' => $items]);
      }
}

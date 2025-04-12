<?php

namespace App\Http\Controllers;

use App\InventoryItem;
use Illuminate\Http\Request;

class testController extends Controller
{

    public function index(string $id,Request $request)
      {
          $items = InventoryItem::all();

          return view('minha-tela', ['valor' => $items]);
      }
}

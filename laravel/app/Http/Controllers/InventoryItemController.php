<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use Illuminate\Http\Request;

class InventoryItemController extends Controller
{

    public function index(){
        $items = InventoryItem::all();

        return view('minha-tela', ['valor' => $items]);
    }

    public function details(int $id){

        $items = InventoryItem::find($id);

        return view('minha-tela', ['valor' => $items]);
    }

    public function create(Request $request){
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'quantity' => 'required|integer|min:1',
                'price' => 'required|numeric|min:0',
            ]);
            $item = InventoryItem::create($validatedData);

            return view('minha-tela', ['valor' => $item]);

    }

    public function update(int $id, Request $request){

        $item = InventoryItem::find($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);
        $item->update($validatedData);

        return view('minha-tela', ['valor' => $item]);
    }

    public function delete(int $id){
        $item = InventoryItem::find($id);

        if ($item){
            $item->delete();
        }

        return view('minha-tela', ['valor' => "deleted data"]);
    }



}

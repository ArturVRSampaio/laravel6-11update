<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use Illuminate\Http\Request;

class InventoryItemController extends Controller
{

    public function index(){
        $items = InventoryItem::all();

        return view('InventoryItem/index', ['valor' => $items]);
    }

    public function edit(int $id){
        $item = InventoryItem::findOrFail($id);
        return view('InventoryItem/edit', ['item' => $item]);
    }

    public function createForm(){

        return view('InventoryItem/new');

    }
    public function create(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);
        InventoryItem::create($validatedData);

        return redirect()->route('InventoryItem.index');
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

        return redirect()->route('InventoryItem.index');
    }

    public function delete(int $id){
        $item = InventoryItem::find($id);

        if ($item){
            $item->delete();
        }

        return redirect()->route('InventoryItem.index');
    }

}

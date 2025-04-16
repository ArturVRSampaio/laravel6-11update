<?php

namespace App\Http\Controllers;

use App\InventoryItem;
use Illuminate\Http\Request;

class InventoryItemController extends Controller
{

    public function index()
    {
        $items = InventoryItem::all();
        return view('InventoryItem/index', ['valor' => $items]);
    }

    public function createForm()
    {
        $form = 'InventoryItem.inventoryItemForm';
        $form_request ='InventoryItem.create';
        $form_method ='POST';
        $form_title = 'Create Inventory Item';
        $return_button_request = 'InventoryItem.index';
        $return_button_title = 'Back to Inventory List';
        $button_send_form_title = 'Create Item';


        return view('InventoryItem/new',
            [
                'form' => $form,
                'form_request' => $form_request,
                'form_method' => $form_method,
                'form_title'=> $form_title,
                'return_button_request' => $return_button_request,
                'return_button_title' => $return_button_title,
                '$button_send_form_title' => $button_send_form_title,
            ]);
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
    public function edit(int $id){
        $item = InventoryItem::findOrFail($id);

        $form = 'InventoryItem.inventoryItemForm';
        $form_request ='InventoryItem.update';
        $form_method ='PUT';
        $form_title = 'Edit Inventory Item';
        $return_button_request = 'InventoryItem.index';
        $return_button_title = 'Back to Inventory List';
        $button_send_form_title = 'Update Item';


        return view('InventoryItem/new',
            [
                'item' => $item,
                'form' => $form,
                'form_request' => $form_request,
                'form_method' => $form_method,
                'form_title'=> $form_title,
                'return_button_request' => $return_button_request,
                'return_button_title' => $return_button_title,
                'button_send_form_title' => $button_send_form_title,
            ]);
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

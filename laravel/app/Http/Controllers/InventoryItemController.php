<?php

namespace App\Http\Controllers;

use App\InventoryItem;
use App\ItemCategory;
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
        $categories = ItemCategory::all();
        $form = 'InventoryItem.inventoryItemForm';
        $form_request ='InventoryItem.create';
        $form_method ='POST';
        $form_title = 'Create Inventory Item';
        $return_button_request = 'InventoryItem.index';
        $return_button_title = 'Back to Inventory List';
        $button_send_form_title = 'Create Item';


        return view('default/form_shell',
            [
                'form' => $form,
                'form_request' => $form_request,
                'form_method' => $form_method,
                'form_title'=> $form_title,
                'return_button_request' => $return_button_request,
                'return_button_title' => $return_button_title,
                'button_send_form_title' => $button_send_form_title,
                'categories' => $categories
            ]);
    }

    public function create(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'item_category_id' => 'numeric|min:1',
        ]);
        InventoryItem::create($validatedData);

        return redirect()->route('InventoryItem.index');
    }
    public function edit(int $id){
        $item = InventoryItem::findOrFail($id);
        $categories = ItemCategory::all();

        $form = 'InventoryItem.inventoryItemForm';
        $form_request ='InventoryItem.update';
        $form_method ='PUT';
        $form_title = 'Edit Inventory Item';
        $return_button_request = 'InventoryItem.index';
        $return_button_title = 'Back to Inventory List';
        $button_send_form_title = 'Update Item';


        return view('default/form_shell',
            [
                'item' => $item,
                'form' => $form,
                'form_request' => $form_request,
                'form_method' => $form_method,
                'form_title'=> $form_title,
                'return_button_request' => $return_button_request,
                'return_button_title' => $return_button_title,
                'button_send_form_title' => $button_send_form_title,
                'categories' => $categories
            ]);
    }

    public function update(int $id, Request $request){
        $item = InventoryItem::find($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'item_category_id' => 'numeric|min:1',
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

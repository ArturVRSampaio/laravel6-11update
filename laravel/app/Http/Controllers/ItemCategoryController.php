<?php

namespace App\Http\Controllers;

use App\ItemCategory;
use Illuminate\Http\Request;

class ItemCategoryController extends Controller
{

    public function index()
    {
        $items = ItemCategory::all();
        return view('ItemCategory/index', ['valor' => $items]);
    }

    public function createForm()
    {
        $form = 'ItemCategory.ItemCategoryForm';
        $form_request ='ItemCategory.create';
        $form_method ='POST';
        $form_title = 'Create Inventory Item';
        $return_button_request = 'ItemCategory.index';
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
            ]);
    }

    public function create(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        ItemCategory::create($validatedData);

        return redirect()->route('ItemCategory.index');
    }
    public function edit(int $id){
        $item = ItemCategory::findOrFail($id);

        $form = 'ItemCategory.ItemCategoryForm';
        $form_request ='ItemCategory.update';
        $form_method ='PUT';
        $form_title = 'Edit Inventory Item';
        $return_button_request = 'ItemCategory.index';
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
            ]);
    }

    public function update(int $id, Request $request){
        $item = ItemCategory::find($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $item->update($validatedData);

        return redirect()->route('ItemCategory.index');
    }

    public function delete(int $id){
        $item = ItemCategory::find($id);

        if ($item){
            $item->delete();
        }

        return redirect()->route('ItemCategory.index');
    }
}

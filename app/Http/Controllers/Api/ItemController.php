<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

use Validator;

class ItemController extends Controller
{
    protected $rules = [
        'name' => 'required|min:3|max:30',
        'key' => 'required|min:3|max:30',
    ];

    public function items(){
        return response()->json(Item::get(), 200);
    }

    public function item($id){
        $item = Item::find($id);
        if (is_null($item)){
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        return response()->json($item, 200);
    }

    public function itemSave(Request $request){
        $validator = Validator::make($request->all(), $this->rules);
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $item = Item::create($request->all());
        return response()->json($item, 201);
    }

    public function itemEdit(Request $request, $id){
        $validator = Validator::make($request->all(), $this->rules);
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $item = Item::find($id);
        if (is_null($item)){
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $item->update($request->all());
        return response()->json($item, 200);
    }

    public function itemDelete(Request $request, $id){
        $item = Item::find($id);
        if (is_null($item)){
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $item->delete();
        return response()->json('', 204);
    }
}

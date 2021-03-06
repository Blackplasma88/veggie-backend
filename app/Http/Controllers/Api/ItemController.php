<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ItemCollection;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ItemCollection|\Illuminate\Http\Response
     */
    public function index()
    {
//        $items = Item::get();
        $items = Item::paginate(Item::get()->count());
//        return $items;
//        return ItemResource::collection($items);
        return new ItemCollection($items);
    }
    public function getToHome()
    {
        $items = Item::paginate(Item::get()->count());
        return new ItemCollection($items);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Item|\Illuminate\Http\Response
     */

    public function uploadImage(Request $request){
        $item = Item::findOrFail($request->id);
            if($request->hasFile('img')){
                $file = $request->file('img');
                $fileName = time() . '.' . $file->getClientOriginalName();
                $path = $file->move(public_path('images'), $fileName);
                $photoURL = url('/images/'.$fileName);
                $item->image_path = $photoURL;
                $item->save();
                return $item;
            }
    }

    public function store(Request $request)
    {
        $item = new Item;
        $item->name = $request->input('name');
        $item->price = $request->input('price');
        $item->inventories = $request->input('inventories');
        $item->total_sales = $request->input('total_sales');
        $item->image_path = $request->input('image_path');
        $item->save();
        return $item;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        // return $item;
        return new ItemResource($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        $item->inventories = $request->inventories;
        $item->total_sales = $request->total_sales;
        $item->save();
        return $item;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
    }

    public function searchName($name){
        return Item::where('name','LIKE', '%'.$name.'%')->get();
    }
}

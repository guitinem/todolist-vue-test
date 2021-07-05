<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Carbon\Carbon;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itens = Item::orderByDesc('created_at')->get();

        return response($itens);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->has('name')) {
            return response()->json([
                'error' => 'Name is missing'
            ], 400);
        }

        $newItem = new Item;
        $newItem->name = $request->get('name');
        $newItem->save();

        return response($newItem, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        // Check if item exist
        $itemExist = Item::find($id);

        if ($itemExist) {
            $itemExist->completed = $request->get('completed') ? true : false;
            $itemExist->completed_at = $request->get('completed') ?  Carbon::now() : null;
            $itemExist->save();

            return response($itemExist);
        }

        return response()->json([
            'error' => 'Item not found'
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Check if item exist
        $itemExist = Item::find($id);

        if ($itemExist) {
            $itemExist->delete();

            return response('', 204);
        }

        return response()->json([
            'error' => 'Item not found'
        ], 404);
    }
}

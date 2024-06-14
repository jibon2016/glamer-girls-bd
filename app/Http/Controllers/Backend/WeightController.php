<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Weight;

class WeightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items=Weight::all();
        return view('backend.weight.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!auth()->user()->can('size.create'))
        {
            abort(403, 'unauthorized');
        }

        return view('backend.weight.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!auth()->user()->can('size.create'))
        {
            abort(403, 'unauthorized');
        }

        $data=$request->validate([
             'title'=> 'required',
        ]);

        Weight::create($data);

        return response()->json(['status'=>true ,'msg'=>'Weight Is  Created !!','url'=>route('admin.weights.index')]);
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
        if(!auth()->user()->can('size.edit'))
        {
            abort(403, 'unauthorized');
        }

        $item=Weight::find($id);
        return view('backend.weight.edit', compact('item'));
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
        if(!auth()->user()->can('size.edit'))
        {
            abort(403, 'unauthorized');
        }

        $category=Weight::find($id);
        $data=$request->validate([
             'title'=> 'required',
        ]);
       
        $category->update($data);

        return response()->json(['status'=>true ,'msg'=>'Weight Is Updated !!','url'=>route('admin.weights.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!auth()->user()->can('size.delete'))
        {
            abort(403, 'unauthorized');
        }

        $category=Weight::find($id);
        $category->delete();
        return response()->json(['status'=>true ,'msg'=>'Weight Is Deleted !!']);
    }
}

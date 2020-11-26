<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ClassName;
use DB;

class ClassNameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $className = ClassName::all();
        return response()->json($className);
        // return ClassName::all()->json($className);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validatedData = $request->validate([
            'class_class_name' => 'required|unique:class_names|max:25'
        ]);

            ClassName::Create($request->all()); 
            return response('done');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $show = ClassName::where('id',$id)->first();
       return response($show);
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
        $oldValue = ClassName::where('id' ,$id)->first();
        $oldValue->class_class_name = $request->class_class_name;
        $oldValue->update();
        return response('updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ClassName::where('id', $id)->delete();
        
        return response('Deleted');
    }
}

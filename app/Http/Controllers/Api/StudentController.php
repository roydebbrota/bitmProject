<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
use DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = Student::all();
        return response()->json($student);
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
            'class_id' => 'required',
            'section_id' => 'required',
            'name' => 'required',
            'phone' => 'required|unique:students',
            'email' => 'required|unique:students',
            'password' => 'required',
            'photo' => 'required',
            'address' => 'required',
            'gender' => 'required'
        ]);
        $studentInsart = Student::create([
            'class_id' =>$request->class_id,
            'section_id' =>$request->section_id,
            'name' =>$request->name,
            'phone' =>$request->phone,
            'email' =>$request->email,
            'password' =>Hash::make($request->password),
            'photo' => $request->photo,
            'address' =>$request->address,
            'gender' =>$request->gender,
        ]);
        return response()->json('inserted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $studentDelails = Student::where('id', $id)->first();
        return response()->json($studentDelails);
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
        $studentDelailsById =  Student::where('id',$id)->first();
        $studentDelailsById->class_id = $request->class_id;
        $studentDelailsById->section_id = $request->section_id;
        $studentDelailsById->name = $request->name;
        $studentDelailsById->phone = $request->phone;
        $studentDelailsById->email = $request->email;
        $studentDelailsById->password = Hash::make($request->password);
        $studentDelailsById->photo = $request->photo;
        $studentDelailsById->address = $request->address;
        $studentDelailsById->gender = $request->gender;
        $studentDelailsById->update();
        return response()->json($studentDelailsById->name.' updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $studentDelailsById = Student::find($id);
        $done = unlink(public_path($studentDelailsById->photo));
        $studentDelailsById->delete();
        return response()->json('Deleted Item Successfuly');
    }
}

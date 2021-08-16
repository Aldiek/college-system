<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function index2($faculty_id,Department $departments)
    {
        return view('departments.index',['faculty_id'=>$faculty_id,'departments'=>$departments::all()->where('faculty_id',$faculty_id)]);
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
    public function create2($faculty_id)
    {

        return view('departments.create',['faculty_id'=>$faculty_id]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Department $department)
    {
       $this->validate($request,[
          'name'=>'required'
       ]);

        $faculty_id=$request->input('faculty_id');;

       $department->create($request->all());
        return redirect()->route('departments.index2',$faculty_id)->withStatus('تم إضافة القسم بنجاح');
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
    public function edit(Department $department)
    {
        return view('departments.edit',['department'=>$department]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $this->validate($request,[
            'name'=>'required'
        ]);
        $department->update($request->all());
        $faculty_id=$request->input('faculty_id');
        return redirect()->route('departments.index2',$faculty_id)->withStatus('تم تعديل القسم بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $faculty_id=$department->faculty_id;
        $department->delete();
        return redirect()->route('departments.index2',$faculty_id)->withStatus('تم حذف القسم بنجاح');
    }
}

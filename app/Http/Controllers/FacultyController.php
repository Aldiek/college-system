<?php

namespace App\Http\Controllers;

use App\Models\Council;
use App\Models\Faculty;
use App\Models\FacultyCouncil;
use Illuminate\Http\Request;

class FacultyController extends Controller
{

    public function index(Faculty $faculties)
    {
        return view('faculties.index',['faculties'=>$faculties->all()]);
    }

    public function create()
    {
        return  view('faculties.create');
    }


    public function store(Request $request,Faculty $faculty)
    {
        $this->validate($request,[
            'name'=>'required'
        ]);
        $added_faculty = $faculty->create($request->all());
        $facultyCouncil = new FacultyCouncil(['faculty_id'=>$added_faculty->id]);
        $facultyCouncil->save();

        $council = new Council();
        $council->name =  'مجلس كلية '.$added_faculty->name;
        $council->save();

        $facultyCouncil->council()->save($council);
        return redirect()->route('faculties.index')->withStatus('تم إضافة الكلية بنجاح');
    }


    public function show($id)
    {
    }


    public function edit(Faculty $faculty)
    {
        return view('faculties.edit',['faculty'=>$faculty]);
    }


    public function update(Request $request, Faculty $faculty)
    {
        $this->validate($request,[
            'name'=>'required'
        ]);
        $faculty->update($request->all());
        return redirect()->route('faculties.index')->withStatus('تم تعديل الكلية بنجاح');
    }


    public function destroy(Faculty $faculty)
    {
        $faculty_council = $faculty->faculty_council;
        $council = $faculty_council->council;
        $council->delete();
        $faculty->delete();
        return redirect()->route('faculties.index')->withStatus('تم الحذف بنجاح');
    }
}

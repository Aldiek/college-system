<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacultySessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Session $session)
    {

        $council_id = Auth::user()->userable->council_id;

         return view('faculty_sessions.index',['sessions'=>$session->all()->where('council_id',$council_id)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('faculty_sessions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'session_number'=>'required',
            'date'=>'required',
        ]);
        $council_id = Auth::user()->userable->council_id;
        $session = new Session();
        $session->session_number = $request->session_number;
        $session->date = $request->date;
        $session->council_id = $council_id;
        $session->save();

        return redirect()->route('facultySession.index')->withStatus('تم إضافة الجلسة بنجاح');
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
    public function edit(Session $session)
    {
        return view('faculty_sessions.edit');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
       $session = Session::find($id);

       $session->delete();

        return redirect()->route('facultySession.index')->withStatus('تم حذف الجلسة بنجاح');
    }
}

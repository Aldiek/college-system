<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Advertisement $advertisements)
    {
        $council_id = Auth::user()->userable->council_id;

        return view('advertisements.index',['advertisements'=>$advertisements->all()->where('council_id',$council_id)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('advertisements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Advertisement $advertisement)
    {
        $this->validate($request,[
            'content'=>'required',
            'expiration_date'=>'required',
        ]);
        $council_id = Auth::user()->userable->council_id;
        $advertisement->create($request->merge(['council_id'=>$council_id])->all());
        return redirect()->route('advertisement.index')->withStatus(__('تم اضافة الإعلان الجديد'));
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
    public function edit(Advertisement $advertisement)
    {
        return view('advertisements.edit',['advertisement'=>$advertisement]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advertisement $advertisement)
    {
        $advertisement->update($request->all());

        return redirect()->route('advertisement.index')->withStatus('تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertisement $advertisement)
    {
        $advertisement->delete();
        return redirect()->route('advertisement.index')->withStatus('تم حذف الإعلان بنجاح');
    }
}

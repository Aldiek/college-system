<?php

namespace App\Http\Controllers;

use App\Models\Council;
use App\Models\Decision;
use App\Models\ScientificAffairsCouncil;
use App\Models\Session;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
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
    public function store2(Request $request,Decision $decision)
    {
        $vote_value=$request->input('vote_value');
        if(!($vote_value=='agreed' || $vote_value =='disagreed' || $vote_value =='discussed'))
        {
            return back()->withStatus('invalid value');
        }




        //check if the user is ordinary council member or scientific council member

        if(Auth::user()->is_scientific_council_member()){

            $scientific_affairs_council_id = Auth::user()->userable->scientific_affairs_council_id;
            $council_id = ScientificAffairsCouncil::find($scientific_affairs_council_id)->council->id;
            $session = Session::where('council_id',$council_id)->latest()->first();
            //check if he had voted or not
            //he had voted so edit his vote
            if(Vote::where('scientific_council_member_id',$scientific_affairs_council_id)->where('decision_id',$decision->id)->
            where('session_id',$session->id)->exists()){

                $vote=Vote::where('scientific_council_member_id',Auth::user()->userable->id)->where('decision_id',$decision->id)->
                where('session_id',$session->id)->first();
                $vote->vote_value=$vote_value;
                if($request->has('note')){
                    $vote->note=$request->input('note');
                }
                $vote->save();
                return redirect()->route('decision.index')->withStatus('تم تعديل التصويت بنجاح');

            }
            // he hadn't voted yet so save his vote
            else{
                $vote =new Vote();
                $vote->scientific_council_member_id = Auth::user()->userable->id;
                $vote->session_id =$session->id;
                $vote->decision_id = $decision->id;
                $vote->vote_value=$vote_value;
                if($request->has('note')){
                    $vote->note=$request->input('note');
                }
                $vote->save();
                return redirect()->route('decision.index')->withStatus('تم التصويت بنجاح');
            }




        }

        else{

            $council_id = Auth::user()->userable->council_id;
            $session = Session::where('council_id',$council_id)->latest()->first();
            //check if he had voted or not
            //he had voted so edit his vote
            if(Vote::where('council_member_id',Auth::user()->userable->id)->where('decision_id',$decision->id)->
            where('session_id',$session->id)->exists()){
                $vote=Vote::where('council_member_id',Auth::user()->userable->id)->where('decision_id',$decision->id)->
                where('session_id',$session->id)->first();
                $vote->vote_value=$vote_value;
                if($request->has('note')){
                    $vote->note=$request->input('note');
                }
                $vote->save();
                return redirect()->route('decision.index')->withStatus('تم تعديل التصويت بنجاح');
            }
            // he hadn't voted yet so save his vote
            else{
                $vote =new Vote();
                $vote->council_member_id = Auth::user()->userable->id;
                $vote->session_id =$session->id;
                $vote->decision_id = $decision->id;
                $vote->vote_value=$vote_value;
                if($request->has('note')){
                    $vote->note=$request->input('note');
                }
                $vote->save();
                return redirect()->route('decision.index')->withStatus('تم التصويت بنجاح');

            }

        }









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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

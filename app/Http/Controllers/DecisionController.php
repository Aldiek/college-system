<?php

namespace App\Http\Controllers;

use App\Models\Council;
use App\Models\Decision;
use App\Models\DecisionImage;
use App\Models\DepartmentSecretary;
use App\Models\Faculty;
use App\Models\Session;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ScientificAffairsCouncil;
use App\Models\UnionRepresentative;

class DecisionController extends Controller
{
    /* Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('department.secretary', ['only' => ['create','store']]);

    }

    public function index()
      {
          $user_type = Auth::user()->userable_type;
         if($user_type ==="App\Models\DepartmentSecretary"){
             $department_id = Auth::user()->userable->department_id;
             $decisions = Decision::all()->where('department_id',$department_id);
             $deps= DepartmentSecretary::all();
            $x='';
            foreach($deps as $dep){
                if ($dep->id == Auth::user()->userable_id)
                $x=$dep->id;
            }
             return view('decisions.index2',['decisions'=>$decisions,'x'=>$x]);
         }
          if($user_type ==="App\Models\CouncilSecretary" ){
             $council_id=Auth::user()->userable->council_id;
             $council=Council::find($council_id);
             $decisions = $council->decisions;
             $deps= DepartmentSecretary::all();

             $x='';
             foreach($deps as $dep){
                 if ($dep->id == Auth::user()->userable_id)
                 $x=$dep->id;
             }
             return view('decisions.index2',['decisions'=>$decisions,'x'=>$x]);
         }
          if($user_type ==="App\Models\CouncilMember" ||
              $user_type ==="App\Models\CouncilPresedent"
              ){
              $council_id=Auth::user()->userable->council_id;
              $session = Session::where('council_id',$council_id)->latest()->first();

              $decisions = $session->decisions;
              $deps= DepartmentSecretary::all();
              $x='';
              foreach($deps as $dep){
                  if ($dep->id == Auth::user()->userable_id)
                  $x=$dep->id;
              }
              return view('decisions.index2',['decisions'=>$decisions,'x'=>$x]);
          }
          if( $user_type ==="App\Models\ScientificCouncilMember" ||
              $user_type ==="App\Models\UnionRepresentative")
          {

              $scientific_council_id=Auth::user()->userable->scientific_affairs_council_id;
              $scientific_council= ScientificAffairsCouncil::find($scientific_council_id);
              $council_id = $scientific_council->council->id;

              $session = Session::where('council_id',$council_id)->latest()->first();

              $decisions = $session->decisions;
              $deps= DepartmentSecretary::all();
              $x='';
              foreach($deps as $dep){
                  if ($dep->id == Auth::user()->userable_id)
                  $x=$dep->id;
              }
              return view('decisions.index2',['decisions'=>$decisions,'x'=>$x]);
          }

      }
    /* Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->is_department_secretary()) return abort(404);
        return view('decisions.create');
    }

    /* Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Decision $decision)
    {
        $this->validate($request,[
            'subject'=>'required',
            'content'=>'required',
            'content1'=>'required',
            'content2'=>'required',
            'date'=>'required',

        ]);



        $department_id=Auth::user()->userable->department_id;







        $decision->subject=$request->input('subject');
        $decision->content=$request->input('content');
        $decision->content1=$request->input('content1');
        $decision->content2=$request->input('content2');
        $decision->date=$request->input('date');
        $decision->department_id=$department_id;

        $decision->save();

       

        $faculty_id = Auth::user()->userable->department->faculty->id;
        $faculty = Faculty::find($faculty_id);
        $council_id= $faculty->faculty_council->council->id;

        $decision->councils()->attach($council_id);

        return redirect()->route('decision.index')->withStatus('تم إضافة القرار بنجاح');
    }

    /* Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $councils = Council::all();
        $decision=Decision::find($id);
//check if the user is ordinary council member or scientific council member
      if(Auth::user()->is_scientific_council_member() || Auth::user()->is_union_represintive() ){
            $scientific_affairs_council_id = Auth::user()->userable->scientific_affairs_council_id;
            $council_id = ScientificAffairsCouncil::find($scientific_affairs_council_id)->council->id;
            $session = Session::where('council_id',$council_id)->latest()->first();
            $vote = Vote::where('scientific_council_member_id',$scientific_affairs_council_id)->where('decision_id',$decision->id)->
            where('session_id',$session->id)->first();

            if(Vote::where('scientific_council_member_id',$scientific_affairs_council_id)->where('decision_id',$decision->id)->
            where('session_id',$session->id)->exists()){
                return view('decisions.show',
                    ['decision'=>$decision,'vote'=>$vote->vote_value,
                        'had_voted'=>true,'councils'=>$councils]
                );
            }
            else{
                return view('decisions.show',
                    ['decision'=>$decision,'vote'=>'لم تصوت بعد',
                        'had_voted'=>false,'councils'=>$councils]
                );
            }
        }

        //ordinary council member
        else{
            $council_id = Auth::user()->userable->council_id;
            $session = Session::where('council_id',$council_id)->latest()->first();
            $vote=Vote::where('council_member_id',Auth::user()->userable->id)->where('decision_id',$id)
                ->where('session_id',$session->id)->first();

            if(Vote::where('council_member_id',Auth::user()->userable->id)->where('decision_id',$id)
                ->where('session_id',$session->id)->exists())
            {


                return view('decisions.show',
                    ['decision'=>$decision,'vote'=>$vote->vote_value,
                        'had_voted'=>true,'councils'=>$councils]
                );
            }
           
            return view('decisions.show',
                ['decision'=>$decision,'vote'=>'لم تصوت بعد',
                    'had_voted'=>false,'councils'=>$councils,
                    'session'=>$session,
                    ]
            );
        }


    }

    /* Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $decision=Decision::find($id);


        if(!Auth::user()->is_department_secretary()) return abort(404);
        return view('decisions.edit',['decision'=>$decision]);
    }

    /* Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'subject'=>'required',
            'content'=>'required',
            'content1'=>'required',
            'content2'=>'required',
            'date'=>'required',

        ]);


        


        $decision=Decision::find($id);
        $decision->subject=$request->input('subject');
        $decision->content=$request->input('content');
        $decision->content1=$request->input('content1');
        $decision->content2=$request->input('content2');
        $decision->date=$request->input('date');
        $decision->save();

        return redirect()->route('decision.index',$decision->faculty_id)->withStatus('تم تعديل القرار بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Decision $decision)
    {
        $decision->delete();


        return redirect()->route('decision.index')->withStatus('تم حذف القرار بنجاح');
    }



    public function addDecisionToNextSession(Decision $decision){
        $council_id=Auth::user()->userable->council_id;
        $session = Session::where('council_id',$council_id)->latest()->first();

        if (! $session->decisions->contains($decision->id)) {
            $session->decisions()->save($decision);
            return redirect()->route('decision.index')->withStatus('تم إضافة القرار إلى الجبسة القادمة');
        }

        return redirect()->route('decision.index')->withStatus('القرار مضاف سابقا');
    }

    public function show_votes($decision_id){

        $votes=Vote::where('decision_id',$decision_id)->get();
        $agreed = $votes->where('vote_value','agreed')->count();
        $disagreed = $votes->where('vote_value','disagreed')->count();
        $discussed = $votes->where('vote_value','discussed')->count();
        return view('decisions.decision_votes',['votes'=>$votes,'agreed'=>$agreed,
            'disagreed'=>$disagreed,'discussed'=>$discussed,
            'decision_id'=>$decision_id
            ]);
    }

    public function decisionAdoption ($decision_id){
        $council_id = Auth::user()->userable->council_id;

        $query = DB::table('council_decision')
            ->where('council_id', $council_id)
            ->where('decision_id', $decision_id)

            ->update(['final_decision' => 'agreed']);

        return redirect()->route('decision.index')->withStatus('تم إصدار القرار عن المجلس');

    }

    public function sendDecision(Request $request,$decision_id){

        $this->validate($request,[
            'council'=>'required',
        ]);
        $council = Council::find($request->council);




        if (! $council->decisions->contains($decision_id)) {
            $council->decisions()->attach($decision_id);
            return redirect()->route('decision.index')->withStatus('تم إرسال القرار بنجاح');
        }

        return redirect()->route('decision.index')->withStatus('القرار مرسل سابقا');
    }
}

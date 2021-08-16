<?php

namespace App\Http\Controllers;

use App\Models\Council;
use App\Models\CouncilMember;
use App\Models\CouncilPresedent;
use App\Models\CouncilSecretary;
use App\Models\Department;
use App\Models\DepartmentSecretary;
use App\Models\Faculty;
use App\Models\ScientificCouncilMember;
use App\Models\UnionRepresentative;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function __construct(){
        $this->middleware('super.admin');
    }
    public function index(User $model)
    {
        return view('users.index', ['users' => $model->paginate(5)]);
    }
    public function create()
    {
        $faculties=Faculty::all();
        $councils=Council::all();
        $departments=Department::all();
        return view('users.create',['faculties'=>$faculties,'councils'=>$councils,'departments'=>$departments]);
    }

    public function store(UserRequest $request, User $model)
    {



        if($request->input('userType')==5  ){
            $this->validate($request,[
                'faculty'=>'required'
            ]);


        }
        if($request->input('userType')==6  ){
            $this->validate($request,[
                'department'=>'required'
            ]);
        }
        $user_types = array(1,2,3 );

        if(in_array($request->input('userType'),$user_types) ){
            $this->validate($request,[
                'council'=>'required'
            ]);
        }

        $user_type_id=$request->input('userType');


        $user=$model->create($request->merge(['password' => Hash::make($request->get('password'))])->all());


        switch ($user_type_id){
            case 1:
                $council_id = $request->input('council');
                $user_type = new CouncilPresedent(['council_id'=>$council_id]);
                $user_type->save();
                $user_type->user()->save($user);
                break;

            case 2:
                $council_id = $request->input('council');
                $user_type= new CouncilMember(['council_id'=>$council_id,'can_vote'=>1]);
                $user_type->save();
                $user_type->user()->save($user);
                break;

            case 3:
                $council_id = $request->input('council');
                $user_type = new CouncilSecretary(['council_id'=>$council_id]);
                $user_type->save();
                $user_type->user()->save($user);
                break;
            
            case 4:
                $department_id = $request->input('department');
                $user_type = new DepartmentSecretary(['department_id'=> $department_id]);
                $user_type->save();
                $user_type->user()->save($user);
                break;
        }



        return redirect()->route('user.index')->withStatus(__('تم اضافة المستخدم بنجاح'));
    }



    public function destroy(User  $user)
    {
        $user->userable()->delete();
        $user->delete();

        return redirect()->route('user.index')->withStatus(__('تم حذف المستخدم بنجاح'));
    }
}

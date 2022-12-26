<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\AccessModel;
use App\Models\MethodsModel;
use Auth;
use App\CustomClasses\Access;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RandomStringController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */


    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
        
    }

    public function index($id)
    {
        if(Gate::allows('Level1')):
        else:
            abort(403);
        endif;
        if($id == 'all'):
            $users = User::get();
            return view('admin.user.all')->with(['users' => $users]);
        else:
            $user = User::where('id', $id)->first();
            $methods = MethodsModel::orderBy('fa_name')->get();
            $access = AccessModel::get();
            return view('admin.user.edit')->with(['user' => $user, 'accessibilities' => $access, 'methods' => $methods]);
        endif;
    }
    
    public function AccessReg(Request $request, $id)
    {
        if(Gate::allows('Level1')):
        else:
            abort(403);
        endif;
        $methods = MethodsModel::get()->toArray();
        
        foreach($methods as $method)
        {
            $name = $method['name'];
            if(isset($request->$name)):
                Access::set($id,$method['name']);
                
            else:
                Access::unset($id,$method['name']);
            endif;
        }
        return redirect()->back();
    }
    
    public function ChangePass(Request $request, $id)
    {
        User::where('id', $id)->update([ 'password' => Hash::make($request->pass) ]);
        return redirect()->back();
    }
    
    public function changeShowInReport(Request $r, $id){
        if(isset($r->showInReport))
            $showInReport = true;
        else
            $showInReport = false;
        User:: where('id', $id)->update([ 'showInReport' => $showInReport ]);
        return redirect()->back();
    }

    public static function create_api_token(User $user)
    {
        $token = RandomStringController::Generate(32);
        $user->api_token = $token;
        $user->save();
        return $user;
    }

}

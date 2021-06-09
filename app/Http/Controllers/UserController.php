<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Permission;
use App\Group;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Authorizable;


class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    use Authorizable;
    private $view;
    private $conf;

    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->conf = New User();
        $this->view["casts"]=$this->conf::$html_casts;
        $this->view["list"]=$this->conf::$table_list;
        $this->view["disabled"]=$this->conf::$html_disabled;
        $this->view["table"]=$this->conf->getTable();
        $this->view["hidden"]=$this->conf->getHidden();
        $this->view["nav"] = "config-nav";
    }

    public function getData()
    {
        $keyword = request('search');
        return User::select('id','name','email','password')
                    ->when($keyword,function ($query) use ($keyword) {
                        $query->orWhere('name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('email', 'LIKE', '%' . $keyword . '%');
                    })->orderBy('id','DESC')->paginate(10);
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->formatResponse($request);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return $this->formatResponse($request);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => "required|email|unique:".Str::plural($this->view['table']).",email",
            'password' => 'required',
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $conf = $this->conf::create($input);
        if(isset($input['groups'])) $conf->syncGroups($input['groups']);
        if(isset($input['permissions'])) $conf->syncPermissions($input['permissions']);
        $message="Bearer Token: ".$conf->createToken('auth_token')->plainTextToken;
        return $this->formatResponse($request,$conf,$message);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request ,$id)
    {
        $conf = $this->conf::find($id);
        return $this->formatResponse($request,$conf);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request ,$id)
    {        
        $conf = $this->conf::find($id);
        return $this->formatResponse($request,$conf);
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
        $this->validate($request, [
            'name' => 'required',        
        ]);
    
        $input = $request->all();

        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
        
        $conf = $this->conf::find($id);
        if(isset($input['groups'])) $conf->syncGroups($input['groups']);
        if(isset($input['permissions'])) $conf->syncPermissions($input['permissions']);
        $conf->update($input);

        return $this->formatResponse($request,$conf);        
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $this->conf::find($id)->delete();
        return $this->formatResponse($request);
               
    }

    public function formatResponse(Request $request,$conf = NULL,$message=NULL)
    {
        $Func_Type = debug_backtrace()[1]['function'];

        if( ( $request->is('api/*') || $request->ajax() ) && isset($conf) )
            return response()->json($conf); 
        else if( ( $request->is('api/*') || $request->ajax() ) && !isset($conf) && $Func_Type != "index" )
            return response()->json(['error' => ucfirst(Str::singular($this->view['table'])). ' Not found'],404);
        else if( ( $request->is('api/*') || $request->ajax() ) && !isset($conf) && $Func_Type == "index" )
            return response()->json($this->getData());
        else
            $ConfList = $this->getData();
        
        $view = $this->view;
        $var = array('ConfList','view');
        if(isset($conf))
        {
            $_cData["permissions"] = $conf->permissions()->pluck('slug')->toArray();
            $_fData["permissions"] = Permission::pluck('name','slug')->WhereNull('deleted_at')->toArray();
            $_cData["groups"] = $conf->groups()->pluck('slug')->toArray();
            $_fData["groups"] = Group::pluck('name','slug')->WhereNull('deleted_at')->toArray();
            $result = compact($var,'conf','_cData','_fData');
        }
        else if($Func_Type == "create")
        {
            $_fData["permissions"] = Permission::pluck('name','slug')->WhereNull('deleted_at')->toArray();
            $_fData["groups"] = Group::pluck('name','slug')->WhereNull('deleted_at')->toArray();
            $result = compact($var,'_fData');
        }
        else
            $result = compact($var);
        
        $massage = array(
            "store" => "created",
            "update" => "updated",
            "destroy" => "deleted",
        );
        if($Func_Type == "store" || $Func_Type == "update" || $Func_Type == "destroy")
            $message = ucfirst(Str::singular($this->view['table']))." ". ucfirst($massage[$Func_Type]) ." successfully";

        if(isset($message))
        return view('conf-management',$result)
                ->with('success',$message)
                ->with('i', ($request->input('page', 1) - 1) * 10); 
        else
        return view('conf-management',$result)
                ->with('i', ($request->input('page', 1) - 1) * 10);

    }
}

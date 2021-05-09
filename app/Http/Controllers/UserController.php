<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Illuminate\Support\Arr;


class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }

    public function getData(Request $request)
    {        
        $keyword = request('search');
        $ConfList = User::select('id','name','email','password')
                    ->when($keyword,function ($query) use ($keyword) {
                        $query->orWhere('name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('email', 'LIKE', '%' . $keyword . '%');
                    })->orderBy('id','DESC')->paginate(5);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = request('search');
        $ConfList = User::select('id','name','email','password')
                    ->when($keyword,function ($query) use ($keyword) {
                        $query->orWhere('name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('email', 'LIKE', '%' . $keyword . '%');
                    })->orderBy('id','DESC')->paginate(5);
        return view('conf-management',compact('ConfList'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $keyword = request('search');
        $ConfList = User::select('id','name','email','password')
                    ->when($keyword,function ($query) use ($keyword) {
                            $query
                            ->orWhere('name', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('email', 'LIKE', '%' . $keyword . '%');
                        })->orderBy('id','DESC')->paginate(5);
        return view('conf-management',compact('ConfList'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $conf = User::create($input);
        $keyword = request('search');
        $ConfList = User::select('id','name','email','password')
                    ->when($keyword,function ($query) use ($keyword) {
                            $query
                            ->orWhere('name', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('email', 'LIKE', '%' . $keyword . '%');
                        })->orderBy('id','DESC')->paginate(5);
        return view('conf-management',compact('ConfList'))
                ->with('i', ($request->input('page', 1) - 1) * 5)
                ->with('success','User created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request ,$id)
    {
        $conf = User::find($id);
        $keyword = request('search');
        $ConfList = User::select('id','name','email','password')
                    ->when($keyword,function ($query) use ($keyword) {
                            $query
                            ->orWhere('name', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('email', 'LIKE', '%' . $keyword . '%');
                        })->orderBy('id','DESC')->paginate(5);        
        return view('conf-management',compact('conf','ConfList'))
                ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request ,$id)
    {        
        $conf = User::find($id);
        $keyword = request('search');
        $ConfList = User::select('id','name','email','password')
                    ->when($keyword,function ($query) use ($keyword) {
                            $query
                            ->orWhere('name', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('email', 'LIKE', '%' . $keyword . '%');
                        })->orderBy('id','DESC')->paginate(5);
        return view('conf-management',compact('conf','ConfList'))
                ->with('i', ($request->input('page', 1) - 1) * 5);
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

        $conf = User::find($id);
        $conf->update($input);
        $keyword = request('search');
        $ConfList = User::select('id','name','email','password')
                        ->when($keyword,function ($query) use ($keyword) {
                                $query
                                ->orWhere('name', 'LIKE', '%' . $keyword . '%')
                                ->orWhere('email', 'LIKE', '%' . $keyword . '%');
                            })->orderBy('id','DESC')->paginate(5);
        return view('conf-management',compact('conf','ConfList'))
                ->with('success','User updated successfully')
                ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        User::find($id)->delete();
        $keyword = request('search');
        $ConfList = User::select('id','name','email','password')
                    ->when($keyword,function ($query) use ($keyword) {
                            $query
                            ->orWhere('name', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('email', 'LIKE', '%' . $keyword . '%');
                        })->orderBy('id','DESC')->paginate(5);
        return view('conf-management',compact('ConfList'))
                ->with('success','User deleted successfully')
                ->with('i', ($request->input('page', 1) - 1) * 5);        
    }
}

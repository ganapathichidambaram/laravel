<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RoleController extends Controller
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
        $ConfList = Role::select('id','name','slug')
                    ->when($keyword,function ($query) use ($keyword) {
                        $query->orWhere('name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('slug', 'LIKE', '%' . $keyword . '%');
                    })->orderBy('id','DESC')->paginate(5);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $dev_permission = Permission::where('slug','play-recording')->first();
		// $manager_permission = Permission::where('slug', 'download-recording')->first();
        // $admin_permission = Permission::where('slug', 'bulk-download')->first();

		//RoleTableSeeder.php
		// $dev_role = new Role();
		// $dev_role->slug = 'admin';
		// $dev_role->name = 'Admin';
		// $dev_role->save();
		// $dev_role->permissions()->attach($dev_permission);
        // $dev_role->permissions()->attach($manager_permission);
        //$dev_role->permissions()->attach($admin_permission);
        $keyword = request('search');
        $ConfList = Role::select('id','name','slug')
                    ->when($keyword,function ($query) use ($keyword) {
                        $query->orWhere('name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('slug', 'LIKE', '%' . $keyword . '%');
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
        $ConfList = Role::select('id','name','slug')
                    ->when($keyword,function ($query) use ($keyword) {
                            $query
                            ->orWhere('name', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('slug', 'LIKE', '%' . $keyword . '%');
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
            'slug' => 'required|unique:roles,slug',
        ]);
    
        $input = $request->all();

        $conf = Role::create($input);
        $keyword = request('search');
        $ConfList = Role::select('id','name','slug')
                    ->when($keyword,function ($query) use ($keyword) {
                            $query
                            ->orWhere('name', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('slug', 'LIKE', '%' . $keyword . '%');
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
        $conf = Role::find($id);
        $keyword = request('search');
        $ConfList = Role::select('id','name','slug')
                    ->when($keyword,function ($query) use ($keyword) {
                            $query
                            ->orWhere('name', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('slug', 'LIKE', '%' . $keyword . '%');
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
        $conf = Role::find($id);
        $keyword = request('search');
        $ConfList = Role::select('id','name','slug')
                    ->when($keyword,function ($query) use ($keyword) {
                            $query
                            ->orWhere('name', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('slug', 'LIKE', '%' . $keyword . '%');
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
        
        $conf = Role::find($id);
        $conf->update($input);
        $keyword = request('search');
        $ConfList = Role::select('id','name','slug')
                        ->when($keyword,function ($query) use ($keyword) {
                                $query
                                ->orWhere('name', 'LIKE', '%' . $keyword . '%')
                                ->orWhere('slug', 'LIKE', '%' . $keyword . '%');
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
        Role::find($id)->delete();
        $keyword = request('search');
        $ConfList = Role::select('id','name','slug')
                    ->when($keyword,function ($query) use ($keyword) {
                            $query
                            ->orWhere('name', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('slug', 'LIKE', '%' . $keyword . '%');
                        })->orderBy('id','DESC')->paginate(5);
        return view('conf-management',compact('ConfList'))
                ->with('success','User deleted successfully')
                ->with('i', ($request->input('page', 1) - 1) * 5);        
    }
}

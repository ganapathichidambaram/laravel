<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;

class GroupController extends Controller
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
        $ConfList = Group::select('id','name','slug')
                    ->when($keyword,function ($query) use ($keyword) {
                        $query->orWhere('name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('slug', 'LIKE', '%' . $keyword . '%');
                    })->orderBy('id','DESC')->paginate(10);
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
        $ConfList = Group::select('id','name','slug')
                    ->when($keyword,function ($query) use ($keyword) {
                        $query->orWhere('name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('slug', 'LIKE', '%' . $keyword . '%');
                    })->orderBy('id','DESC')->paginate(10);
        return view('conf-management',compact('ConfList'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $keyword = request('search');
        $ConfList = Group::select('id','name','slug')
                    ->when($keyword,function ($query) use ($keyword) {
                            $query
                            ->orWhere('name', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('slug', 'LIKE', '%' . $keyword . '%');
                        })->orderBy('id','DESC')->paginate(10);
        return view('conf-management',compact('ConfList'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
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
            'slug' => 'required|unique:groups,slug',
        ]);
    
        $input = $request->all();

        $conf = Group::create($input);
        $keyword = request('search');
        $ConfList = Group::select('id','name','slug')
                    ->when($keyword,function ($query) use ($keyword) {
                            $query
                            ->orWhere('name', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('slug', 'LIKE', '%' . $keyword . '%');
                        })->orderBy('id','DESC')->paginate(10);
        return view('conf-management',compact('ConfList'))
                ->with('i', ($request->input('page', 1) - 1) * 10)
                ->with('success','Group created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request ,$id)
    {
        $conf = Group::find($id);
        $keyword = request('search');
        $ConfList = Group::select('id','name','slug')
                    ->when($keyword,function ($query) use ($keyword) {
                            $query
                            ->orWhere('name', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('slug', 'LIKE', '%' . $keyword . '%');
                        })->orderBy('id','DESC')->paginate(10);        
        return view('conf-management',compact('conf','ConfList'))
                ->with('i', ($request->input('page', 1) - 1) * 10);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request ,$id)
    {        
        $conf = Group::find($id);
        $keyword = request('search');
        $ConfList = Group::select('id','name','slug')
                    ->when($keyword,function ($query) use ($keyword) {
                            $query
                            ->orWhere('name', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('slug', 'LIKE', '%' . $keyword . '%');
                        })->orderBy('id','DESC')->paginate(10);
        return view('conf-management',compact('conf','ConfList'))
                ->with('i', ($request->input('page', 1) - 1) * 10);
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
        
        $conf = Group::find($id);
        $conf->update($input);
        $keyword = request('search');
        $ConfList = Group::select('id','name','slug')
                        ->when($keyword,function ($query) use ($keyword) {
                                $query
                                ->orWhere('name', 'LIKE', '%' . $keyword . '%')
                                ->orWhere('slug', 'LIKE', '%' . $keyword . '%');
                            })->orderBy('id','DESC')->paginate(10);
        return view('conf-management',compact('conf','ConfList'))
                ->with('success','Group updated successfully')
                ->with('i', ($request->input('page', 1) - 1) * 10);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        Group::find($id)->delete();
        $keyword = request('search');
        $ConfList = Group::select('id','name','slug')
                    ->when($keyword,function ($query) use ($keyword) {
                            $query
                            ->orWhere('name', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('slug', 'LIKE', '%' . $keyword . '%');
                        })->orderBy('id','DESC')->paginate(10);
        return view('conf-management',compact('ConfList'))
                ->with('success','Group deleted successfully')
                ->with('i', ($request->input('page', 1) - 1) * 10);        
    }
}

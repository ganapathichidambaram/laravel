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
    private $view;
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $conf = new Group();
        $this->view["casts"]=$conf::$html_casts;
        $this->view["list"]=$conf::$table_list;
        $this->view["disabled"]=$conf::$html_disabled;
        $this->view["table"]=$conf->getTable();
        $this->view["hidden"]=$conf->getHidden();
    }

    public function getData()
    {
        $keyword = request('search');
        return Group::select('id','name','slug')
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

        $ConfList = $this->getData();
        $view = $this->view;
        return view('conf-management',compact('ConfList','view'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $ConfList = $this->getData();
        $view = $this->view;
        return view('conf-management',compact('ConfList','view'))
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
        $ConfList = $this->getData();
        $view = $this->view;
        return view('conf-management',compact('ConfList','view'))
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
        $ConfList = $this->getData();
        $view = $this->view;
        return view('conf-management',compact('conf','ConfList','view'))
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
        $ConfList = $this->getData();
        $view = $this->view;
        return view('conf-management',compact('conf','ConfList','view'))
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
        $ConfList = $this->getData();
        $view = $this->view;                            
        return view('conf-management',compact('conf','ConfList','view'))
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
        $ConfList = $this->getData();
        $view = $this->view;
        return view('conf-management',compact('ConfList','view'))
                ->with('success','Group deleted successfully')
                ->with('i', ($request->input('page', 1) - 1) * 10);        
    }
}

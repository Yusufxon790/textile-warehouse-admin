<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cat;
use Illuminate\Support\Facades\DB;



class CatController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats=Cat::all();
        return view('admin-panel.dist.elements.cat',['cats'=>$cats]);
    }


    public function search(Request $request){
        $search=$request->ser;
        $cats=DB::table('cats')->when($search,function($query,$search){
            return $query->where('name','like',"%{$search}%");
        })->get();
        $html='';
        $i=1;
        foreach ($cats as $cat){
            $edit=route('textile.edit',['textile'=>$cat->id]);
              $html.="<tr>
                <td>".$i++."</td> 
                <td>$cat->name</td> 
                <td>
                  <a href='$edit' class='btn btn-sm btn-warning' ><i class='fas fa-edit' ></i></a>
                </td>
              </tr> ";  
        }  
        return response()->json(['html'=>$html]);        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin-panel.dist.elements.cat_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:20',
        ]);

        DB::table('cats')->insert([
            'name'=>$request->name,
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        return back()->with('success',"Ma'lumot muvaffaqiyatli qo'shildi!");
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
        return view('admin-panel.dist.elements.cat_edit',['cat'=>Cat::find($id)]);
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
        $request->validate([
            'name'=>'required|max:20'
        ]);
        DB::table('cats')->where('id',$id)->update([
            'name'=>$request->name,
            'updated_at'=>now(),
        ]);
        return redirect('textile')->with('success',"Ma'lumot muvaffaqiyatli yangiladi!");
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

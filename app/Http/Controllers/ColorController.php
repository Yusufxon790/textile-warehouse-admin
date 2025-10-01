<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cat;
use App\Models\Type;
use App\Models\Color;



class ColorController extends Controller
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
        $colors=DB::select("select cats.name as cat_name,types.name as type_name,colors.* from colors left join types on colors.type_id=types.id left join cats on colors.cat_id=cats.id");
        return view('admin-panel.dist.elements.color',['colors'=>$colors]);
    }

    public function search(Request $request){
        $search=$request->ser_color;
        $colors=DB::table('colors')
        ->leftJoin('types','colors.type_id','=','types.id')
        ->leftJoin('cats','colors.cat_id','=','cats.id')
        ->select("colors.*",'types.name as type_name','cats.name as cat_name')
        ->when($search,function($query,$search){
            return $query->where('colors.name','like',"%{$search}%")
            ->orWhere('types.name','like',"%{$search}%")
            ->orWhere('cats.name','like',"%{$search}%");
        })->get();
        $html='';
        $i=1;
        foreach ($colors as $color) {
            $edit_color=route('colors.edit',['color'=>$color->id]);
            $html.="<tr>
                <td>".$i++."</td> 
                <td>$color->name</td> 
                <td>$color->type_name</td> 
                <td>$color->cat_name</td> 
                <td>
                  <a href='$edit_color' class='btn btn-sm btn-warning' ><i class='fas fa-edit' ></i></a>
                </td>
              </tr>";
        }
        return response()->json(['html'=>$html]);
    }

    public function color_cat_change(Request $request){
        $ts=DB::table('types')->where('cat_id',$request->color_cat_change)->select('id','name')->get();
            $types='';
            foreach ($ts as $t) {
                $types.="
                    <option value='$t->id'>$t->name</option>
                ";
            }
        return response()->json(['types'=>$types]);
    }
    public function getTypesByCategory($cat_id){
    $types = DB::table('types')
        ->where('cat_id', $cat_id)
        ->select('id', 'name')
        ->get();

    return response()->json($types); // Bu javob JavaScriptga boradi
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats=Cat::all();
        $types=Type::all();
        return view('admin-panel.dist.elements.color_create',['cats'=>$cats,'types'=>$types]);
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
            'type_id'=>'required',
            'cat_id'=>'required',
        ]);
        DB::table('colors')->insert([
            'name'=>$request->name,
            'type_id'=>$request->type_id,
            'cat_id'=>$request->cat_id,
            'c_amount'=>0,
            'cr_soni'=>0,
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        return back()->with('success',"Ma'lumotlar muvaffaqiyatli qo'shildi!");
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
        $cats=Cat::all();
        $color=Color::find($id);
        $type=DB::table('types')->select("types.id","types.name","types.cat_id")->where('types.cat_id',$color->cat_id)->get();
        return view('admin-panel.dist.elements.color_edit',['cats'=>$cats,'type'=>$type,'color'=>$color]);
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
            'name'=>'required|max:20',
            'type_id'=>'required',
            'cat_id'=>'required',
        ]);
        DB::table('colors')->where('id',$id)
        ->update([
            'name'=>$request->name,
            'type_id'=>$request->type_id,
            'cat_id'=>$request->cat_id,
            'updated_at'=>now(),
        ]);
        return redirect('colors')->with('success',"Ma'lumotlar muvaffaqiyatli o'zgartirildi!");
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

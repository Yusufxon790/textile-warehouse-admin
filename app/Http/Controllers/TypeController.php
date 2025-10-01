<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cat;
use App\Models\Type;



class TypeController extends Controller
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
        $types=DB::select('select cats.name as cat_name,types.* from types left join cats on types.cat_id=cats.id');
        return view('admin-panel.dist.elements.type',['types'=>$types]);
    }

    public function search(Request $request){
        $search=$request->ser_type;
        $types=DB::table('types')->leftJoin('cats','types.cat_id','=','cats.id')
        ->select('types.*','cats.name as cat_name')
        ->when($search,function($query,$search){
            return $query->where('types.name','like',"%{$search}%")
            ->orWhere('types.price','like',"%{$search}%")
            ->orWhere('cats.name','like',"%{$search}%");
        })->get();
        $html='';
        $i=1;
        foreach ($types as $type) {
            $edit_type=route('types.edit',['type'=>$type->id]);
            $html.="<tr>
                <td>".$i++."</td> 
                <td>$type->name</td> 
                <td>".number_format($type->price)."</td> 
                <td>$type->cat_name</td> 
                <td>
                  <a href='$edit_type' class='btn btn-sm btn-warning' ><i class='fas fa-edit' ></i></a>
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
        $cats=Cat::all();
        return view('admin-panel.dist.elements.type_create',['cats'=>$cats]);
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
            'price'=>'required|integer',
            'cat_id'=>'required',
        ]);
        DB::table('types')->insert([
            'name'=>$request->name,
            'price'=>$request->price,
            'cat_id'=>$request->cat_id,
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
        return back()->with('success',"Ma'luot muvaffaqiyatli qo'shildi!");
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
        $type=Type::find($id);
        $cats=Cat::all();
        return view('admin-panel.dist.elements.type_edit',['type'=>$type,'cats'=>$cats]);

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
            'price'=>'required',
            'cat_id'=>'required',
        ]);
        DB::table('types')->where('id',$id)->update([
            'name'=>$request->name,
            'price'=>$request->price,
            'cat_id'=>$request->cat_id,
            'updated_at'=>now(),
        ]);
        return redirect('types')->with('success',"Ma'lumotlar muvaffaqiyatli o'zgartirildi!");
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

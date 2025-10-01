<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cat;
use App\Models\Type;
use App\Models\Color;
use App\Models\Income;
use Illuminate\Support\Facades\DB;




class IncomeController extends Controller
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
        $cats = DB::table('cats')
        ->join('colors', 'cats.id', '=', 'colors.cat_id')
        ->select('cats.id', 'cats.name')
        ->distinct()
        ->get();
        $types=DB::table('types')
        ->join('colors','types.id','=','colors.type_id')
        ->select('types.id','types.name')
        ->distinct()
        ->get();

        return view('admin-panel.dist.dashboard.index',['cats'=>$cats,'types'=>$types]);
    }

    public function search_input(Request $request){
        $search=$request->ser_income;
        $colors=DB::table('colors')
        ->leftJoin('types','colors.type_id','=','types.id')
        ->leftJoin('cats','colors.cat_id','=','cats.id')
        ->select("colors.*",'types.name as type_name',"types.price as type_price",'cats.name as cat_name')
        ->when($search,function($query,$search){
            return $query->where('colors.name','like',"%{$search}%")
            ->orWhere('types.name','like',"%{$search}%")
            ->orWhere('cats.name','like',"%{$search}%");
        })->get();
        $html1='';
        $i=1;
        foreach ($colors as $color) {
            $html1.="<tr>
                <td>".$i++."</td> 
                <td>$color->cat_name</td> 
                <td>$color->type_name</td> 
                <td>$color->name</td> 
                <td>$color->c_amount kg</td> 
                <td>$color->cr_soni ta</td> 
                <td>".(number_format($color->type_price*$color->c_amount))." so'm</td> 
                <td>
                  <a href='".route('incomes.edit',['income'=>$color->id])."' class='btn btn-sm btn-success' ><i class='fas fa-plus' ></i></a>
                  <a href='".route('income_edit2',['id'=>$color->id])."' class='btn btn-sm btn-danger' ><i class='fas fa-minus' ></i></a>
                  <a href='".route('incomes.show',['income'=>$color->id])."' class='btn btn-sm btn-info' ><i class='fas fa-eye' ></i></a>
                </td>
              </tr>";
        }

        
        $amount=DB::table('colors')
        ->leftJoin('types','colors.type_id','=','types.id')
        ->leftJoin('cats','colors.cat_id','=','cats.id')
        ->where("types.name",'like',"%$search%")
        ->orWhere("cats.name",'like',"%$search%")
        ->select(DB::raw("SUM(colors.c_amount) as amount"))
        ->value("amount");

        $rulon=DB::table('colors')
        ->leftJoin('types','colors.type_id','=','types.id')
        ->leftJoin('cats','colors.cat_id','=','cats.id')
        ->where("types.name",'like',"%$search%")
        ->orWhere("cats.name",'like',"%$search%")
        ->select(DB::raw("SUM(colors.cr_soni) as rulon"))
        ->value("rulon");

        $summa=DB::table('colors')
        ->leftJoin('types','colors.type_id','=','types.id')
        ->leftJoin('cats','colors.cat_id','=','cats.id')
        ->where("types.name",'like',"%$search%")
        ->orWhere("cats.name",'like',"%$search%")
        ->select(DB::raw("SUM(colors.c_amount * types.price) as toal_summa"))
        ->value("total_summa");

        $sum="
            <h4 class='alert alert-info shadow-sm mt-3 sum_summa '>Mavjud miqdor: ".number_format($summa)." so'm</h4>
            <h4 class='alert alert-info shadow-sm mt-3 sum_amount '>Mavjud miqdor: $amount kg/m</h4>
            <h4 class='alert alert-info shadow-sm mt-3 sum_r_soni '>Mavjud rulonlar soni: $rulon ta</h4>
        ";

        return response()->json(['html1'=>$html1,'sum'=>$sum]);
    }
   
    public function cat_search(Request $request){
        $cat_id = $request->income_change_1;
    
        // TYPE lar faqat category tanlanganda chiqadi, "All" da chiqmaydi
        $ts = collect(); // default bo‘sh collection

        if (!empty($cat_id) && $cat_id !== 'All') {
            $ts = Type::where('cat_id', $cat_id)->get();
        }

    
        $types = '';
        foreach ($ts as $t) {
            $types .= "<option value='$t->id'>$t->name</option>";
        }
    
        // COLORS (incomes)
        $incomes = DB::table('colors')
            ->leftJoin('types','colors.type_id','=','types.id')
            ->leftJoin('cats','types.cat_id','=','cats.id')
            ->select("colors.*","types.name as type_name","types.price as type_price","cats.name as cat_name")
            ->when(!empty($cat_id) && $cat_id !== 'All', function($query) use ($cat_id){
                return $query->where('colors.cat_id',$cat_id);
            })
            ->get();
    
        $html = '';
        $i = 1;
        foreach ($incomes as $income) {
            $html .= "<tr>
                <td>".$i++."</td> 
                <td>$income->cat_name</td> 
                <td>$income->type_name</td> 
                <td>$income->name</td> 
                <td>$income->c_amount kg</td> 
                <td>$income->cr_soni ta</td> 
                <td>".number_format($income->type_price * $income->c_amount)." so'm</td> 
                <td>
                  <a href='".route('incomes.edit',['income'=>$income->id])."' class='btn btn-sm btn-success'><i class='fas fa-plus'></i></a>
                  <a href='".route('income_edit2',['id'=>$income->id])."' class='btn btn-sm btn-danger'><i class='fas fa-minus'></i></a>
                  <a href='".route('incomes.show',['income'=>$income->id])."' class='btn btn-sm btn-info'><i class='fas fa-eye'></i></a>
                </td>
              </tr>";
        }
    
        // Summalar
        $amount = DB::table('colors')
            ->when(!empty($cat_id) && $cat_id !== 'All', function($q) use ($cat_id) {
                return $q->where('colors.cat_id', $cat_id);
            })
            ->sum("colors.c_amount");
    
        $rulon = DB::table('colors')
            ->when(!empty($cat_id) && $cat_id !== 'All', function($q) use ($cat_id) {
                return $q->where('colors.cat_id', $cat_id);
            })
            ->sum("colors.cr_soni");
    
        $summa = DB::table('colors')
            ->leftJoin('types','colors.type_id','=','types.id')
            ->when(!empty($cat_id) && $cat_id !== 'All', function($q) use ($cat_id) {
                return $q->where('colors.cat_id', $cat_id);
            })
            ->select(DB::raw("SUM(colors.c_amount * types.price) as total_summa"))
            ->first();
    
        $summa = $summa->total_summa ?? 0;
    
        $sum = "
            <h4 class='alert alert-info shadow-sm mt-3 sum_summa'>Mavjud qiymat: ".number_format($summa)." so'm</h4>
            <h4 class='alert alert-info shadow-sm mt-3 sum_amount'>Mavjud miqdor: $amount kg/m</h4>
            <h4 class='alert alert-info shadow-sm mt-3 sum_r_soni'>Mavjud rulonlar soni: $rulon ta</h4>
        ";
    
        return response()->json(['html'=>$html,'types'=>$types,'sum'=>$sum]);
    }
    
    


    public function type_search(Request $request){
        $cat_id = $request->income_change_1;
        $type_id = $request->income_change_2;
    
        $incomes = DB::table('colors')
            ->leftJoin('types','colors.type_id','=','types.id')
            ->leftJoin('cats','types.cat_id','=','cats.id')
            ->select("colors.*","types.name as type_name","types.price as type_price","cats.name as cat_name")
            ->when($cat_id && $cat_id !== 'All', function($q,$cat_id){
                return $q->where('colors.cat_id',$cat_id);
            })
            ->when($type_id, function($q,$type_id){
                return $q->where('colors.type_id',$type_id);
            })
            ->get();
    
        $html = '';
        $i = 1;
        foreach ($incomes as $income) {
            $html .= "<tr>
                <td>".$i++."</td> 
                <td>$income->cat_name</td> 
                <td>$income->type_name</td> 
                <td>$income->name</td> 
                <td>$income->c_amount kg</td> 
                <td>$income->cr_soni ta</td> 
                <td>".number_format($income->type_price * $income->c_amount)." so'm</td> 
                <td>
                  <a href='".route('incomes.edit',['income'=>$income->id])."' class='btn btn-sm btn-success'><i class='fas fa-plus'></i></a>
                  <a href='".route('income_edit2',['id'=>$income->id])."' class='btn btn-sm btn-danger'><i class='fas fa-minus'></i></a>
                  <a href='".route('incomes.show',['income'=>$income->id])."' class='btn btn-sm btn-info'><i class='fas fa-eye'></i></a>
                </td>
              </tr>";
        }
    
        $amount = DB::table('colors')
            ->when($cat_id && $cat_id !== 'All', function($q) use ($cat_id) {
                return $q->where('colors.cat_id',$cat_id);
            })
            ->when($type_id, function($q) use ($type_id) {
                return $q->where('colors.type_id',$type_id);
            })
            ->sum("colors.c_amount");
    
        $rulon = DB::table('colors')
            ->when($cat_id && $cat_id !== 'All', function($q) use ($cat_id) {
                return $q->where('colors.cat_id',$cat_id);
            })
            ->when($type_id, function($q) use ($type_id) {
                return $q->where('colors.type_id',$type_id);
            })
            ->sum("colors.cr_soni");
    
        $summa = DB::table('colors')
            ->leftJoin('types','colors.type_id','=','types.id')
            ->when($cat_id && $cat_id !== 'All', function($q) use ($cat_id) {
                return $q->where('colors.cat_id',$cat_id);
            })
            ->when($type_id, function($q) use ($type_id) {
                return $q->where('colors.type_id',$type_id);
            })
            ->select(DB::raw("SUM(colors.c_amount * types.price) as total_summa"))
            ->value("total_summa") ?? 0;
    
        $sum = "
            <h4 class='alert alert-info shadow-sm mt-3 sum_summa'>Mavjud qiymat: ".number_format($summa)." so'm</h4>
            <h4 class='alert alert-info shadow-sm mt-3 sum_amount'>Mavjud miqdor: $amount kg/m</h4>
            <h4 class='alert alert-info shadow-sm mt-3 sum_r_soni'>Mavjud rulonlar soni: $rulon ta</h4>
        ";
    
        return response()->json(['html'=>$html,'sum'=>$sum]);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $incomes=DB::table('incomes')
        ->leftJoin('colors','incomes.color_id','=','colors.id')
        ->leftJoin('types','incomes.type_id','=','types.id')
        ->leftJoin('cats','incomes.cat_id','=','cats.id')
        ->select(
   "incomes.*",
            "colors.name as color_name",
            "types.name as type_name",
            "cats.name as cat_name")
        ->where('color_id',$id)
        ->get();
        return view('admin-panel.dist.elements.income_view',['incomes'=>$incomes]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $income=DB::table('colors')
        ->leftJoin('types','colors.type_id','=','types.id')
        ->leftJoin('cats','colors.cat_id','=','cats.id')
        ->select("colors.*","types.name as type_name","cats.name as cat_name")
        ->where('colors.id',"=",$id)->first();

        return view('admin-panel.dist.elements.income_edit',['income'=>$income]);
    }

    public function income_edit2($id)
    {
        $income=DB::table('colors')
        ->leftJoin('types','colors.type_id','=','types.id')
        ->leftJoin('cats','colors.cat_id','=','cats.id')
        ->select("colors.*","types.name as type_name","cats.name as cat_name")
        ->where('colors.id',"=",$id)->first();

        return view('admin-panel.dist.elements.income_edit2',['income'=>$income]);
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
            'c_amount'=>'required',
            'cr_soni'=>'required',
            'vaqt'=>'required'
        ]);

        DB::table('incomes')->insert([
            'cat_id'=>$request->cat_id,
            'type_id'=>$request->type_id,
            'color_id'=>$id,
            'amount'=>$request->c_amount,
            'r_soni'=>$request->cr_soni,
            'status'=>1,
            'desc'=>$request->desc,
            'vaqt'=>$request->vaqt,
            'created_at'=>now(),
            'updated_at'=>now()
        ]);

        DB::table('colors')->where('id',$id)
        ->update([
            'c_amount'=>$request->old_amount+$request->c_amount,
            'cr_soni'=>$request->old_cr_soni+$request->cr_soni,
            'updated_at'=>now(),
        ]);

        return redirect('incomes')->with('success',"Ma'lumot muvaffaqiyatli qo'shildi!");
    }


    public function income_update2(Request $request, $id)
    {
        $request->validate([
            'c_amount'=>'required',
            'cr_soni'=>'required',
            'vaqt'=>'required'
        ]);

        DB::table('incomes')->insert([
            'cat_id'=>$request->cat_id,
            'type_id'=>$request->type_id,
            'color_id'=>$id,
            'amount'=>$request->c_amount,
            'r_soni'=>$request->cr_soni,
            'status'=>0,
            'desc'=>$request->desc,
            'vaqt'=>$request->vaqt,
            'created_at'=>now(),
            'updated_at'=>now()
        ]);

        DB::table('colors')->where('id',$id)
        ->update([
            'c_amount'=>$request->old_amount-$request->c_amount,
            'cr_soni'=>$request->old_cr_soni-$request->cr_soni,
            'updated_at'=>now(),
        ]);

        return redirect('incomes')->with('success',"Ma'lumot muvaffaqiyatli ayirildi!");
    }

    public function income_view_edit($id){
        $income=DB::table('incomes')->where('id',$id)->first();
        return view('admin-panel.dist.elements.income_view_edit',['income'=>$income]);
    }

    public function income_view_update(Request $request,$id){
        $request->validate([
            'amount'=>'required',
            'r_soni'=>'required',
            'status'=>'required',
            'vaqt'=>'required',
        ]);
        
        $color=DB::table('colors')
        ->where('id',$request->color_id)
        ->first();

        $income=DB::table('incomes')
        ->where('id',$id)
        ->first();

        if($request->status==1 && $income->status==1){
            DB::table('colors')->where('id',$request->color_id)
            ->update([
                'c_amount'=>($color->c_amount-$income->amount)+$request->amount,
                'cr_soni'=>($color->cr_soni-$income->r_soni)+$request->r_soni,
                'updated_at'=>now(),
            ]);

            DB::table('incomes')->where('id',$id)
            ->update([
                'amount'=>$request->amount,
                'r_soni'=>$request->r_soni,
                'status'=>$request->status,
                'desc'=>$request->desc,
                'vaqt'=>$request->vaqt,
            ]);

            return redirect('incomes')->with('success',"Ma'lumotlar muvaffaqiyatli yangilandi!");
        }
        elseif ($request->status==0 && $income->status==0) {
            DB::table('colors')->where('id',$request->color_id)
            ->update([
                'c_amount'=>($color->c_amount+$income->amount)-$request->amount,
                'cr_soni'=>($color->cr_soni+$income->r_soni)-$request->r_soni,
                'updated_at'=>now(),
            ]);

            DB::table('incomes')->where('id',$id)
            ->update([
                'amount'=>$request->amount,
                'r_soni'=>$request->r_soni,
                'status'=>$request->status,
                'desc'=>$request->desc,
                'vaqt'=>$request->vaqt,
            ]);

            return redirect('incomes')->with('success',"Ma'lumotlar muvaffaqiyatli yangilandi!");
        }

        elseif ($request->status==1 && $income->status!=$request->status) {
            DB::table('colors')->where('id',$request->color_id)
            ->update([
                'c_amount'=>$color->c_amount+$request->amount,
                'cr_soni'=>$color->cr_soni+$request->r_soni,
                'updated_at'=>now(),
            ]);

            DB::table('incomes')->where('id',$id)
            ->update([
                'amount'=>$request->amount,
                'r_soni'=>$request->r_soni,
                'status'=>$request->status,
                'desc'=>$request->desc,
                'vaqt'=>$request->vaqt,
            ]);

            return redirect('incomes')->with('success',"Ma'lumotlar muvaffaqiyatli yangilandi!");
        }

        elseif ($request->status==0 && $income->status!=$request->status) {
            DB::table('colors')->where('id',$request->color_id)
            ->update([
                'c_amount'=>$color->c_amount-$request->amount,
                'cr_soni'=>$color->cr_soni-$request->r_soni,
                'updated_at'=>now(),
            ]);

            DB::table('incomes')->where('id',$id)
            ->update([
                'amount'=>$request->amount,
                'r_soni'=>$request->r_soni,
                'status'=>$request->status,
                'desc'=>$request->desc,
                'vaqt'=>$request->vaqt,
            ]);

            return redirect('incomes')->with('success',"Ma'lumotlar muvaffaqiyatli yangilandi!");
        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $income=DB::table('incomes')->where('id',$id)->first();
        $color = DB::table('colors')->where('id', $income->color_id)->first();

        if ($income->status == 1) {
            DB::table('colors')->where('id', $income->color_id)->update([
                'c_amount' => $color->c_amount - $income->amount,
                'cr_soni' => $color->cr_soni - $income->r_soni,
            ]);
        } elseif ($income->status == 0) {
            DB::table('colors')->where('id', $income->color_id)->update([
                'c_amount' => $color->c_amount + $income->amount,
                'cr_soni' => $color->cr_soni + $income->r_soni,
            ]);
        }

        if (!$income) {
            return redirect()->back()->with('error',"Topilmadi!");
        }

        DB::table('incomes')->where('id', $id)->delete();

        return redirect()->route('incomes.index')->with('success', "Ma'lumot o'chirildi!");
    }
}

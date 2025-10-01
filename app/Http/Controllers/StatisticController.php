<?php

namespace App\Http\Controllers;
use App\Models\Cat;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;
use Illuminate\Queue\Jobs\JobName;

class StatisticController extends Controller
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
        return view('admin-panel.dist.dashboard.statistic',['cats'=>$cats]);
    }

    public function cat_search(Request $request){
        $cat_id=$request->cat_search;

        $type_id=DB::table('types')
        ->leftJoin('cats','types.cat_id','=','cats.id')
        ->select("types.name as type_name","types.id as type_id")
        ->when($cat_id && $cat_id != "",function($query) use ($cat_id){
            return $query->where("types.cat_id",$cat_id);
        })
        ->distinct()->get();


        $type_option='<option>---</option>';
        foreach ($type_id as $type) {
            $type_option.="
            <option value='$type->type_id'>$type->type_name</option>
            ";
        }

        return response()->json(["type"=>$type_option]);

    }

    public function date_search(Request $request){
        $cat_id=$request->cat_search;
        $type_id=$request->type_search;
        $status_id=$request->status_search;
        $date_id=$request->date_search;

        $statistics=DB::table('incomes')
        ->leftJoin('colors','incomes.color_id','=','colors.id')
        ->leftJoin('types','colors.type_id','=','types.id')
        ->leftJoin('cats','types.cat_id','=','cats.id')
        ->select("incomes.*","colors.name as color_name","types.name as type_name","types.price as type_price","cats.name as cat_name")
        ->when($cat_id,function($query,$cat_id){
            return $query->where("incomes.cat_id",$cat_id);
        })
        ->when($type_id,function($query,$type_id){
            return $query->where("incomes.type_id",$type_id);
        })
        ->when(is_numeric($status_id), function($query) use ($status_id) {
            return $query->where("incomes.status", $status_id);
        })
        ->when($date_id,function($query,$date_id){
            return $query->where("incomes.vaqt",$date_id);
        })->get();

        $html="";
        $i=1;

        foreach ($statistics as $statistic) {
            if ($statistic->status==1) {
                $status="Kirim";
            }
            elseif ($statistic->status==0) {
                $status="Chiqim";
            }
            $html.="<tr>
                <td>".$i++."</td> 
                <td>$statistic->cat_name</td> 
                <td>$statistic->type_name</td> 
                <td>$statistic->color_name</td> 
                <td>$status</td> 
                <td>$statistic->amount kg</td> 
                <td>$statistic->r_soni ta</td> 
                <td>".(number_format($statistic->type_price))." so'm</td> 
                <td>".(number_format($statistic->type_price*$statistic->amount))." so'm</td> 
              </tr>";
        }

        $title_date=$request->date_search." bo'yicha statistika ko'rsatilmoqda";

        
        $amount = DB::table("incomes")
        ->whereDate('incomes.vaqt', $date_id)
        ->where('incomes.status', $status_id)
        ->where('incomes.cat_id', $cat_id)
        ->where('incomes.type_id', $type_id)
        ->sum('incomes.amount');

        $summa = DB::table("types")
        ->select('types.price')
        ->where('id', $type_id)
        ->first();

        $price = $summa ? $summa->price : 0;
        $sum_price=$price*$amount;
        $sum_price=number_format($sum_price);


        $r_soni = DB::table("incomes")
        ->whereDate('incomes.vaqt', $date_id)
        ->where('incomes.status', $status_id)
        ->where('incomes.cat_id', $cat_id)
        ->where('incomes.type_id', $type_id)
        ->sum('incomes.r_soni');

        $sum="
        <h4 class='alert alert-info shadow-sm mt-3 sum_summa '>Jami summa: $sum_price so'm</h4>
        <h4 class='alert alert-info shadow-sm mt-3 sum_amount '>Mavjud miqdor: $amount kg/m</h4>
        <h4 class='alert alert-info shadow-sm mt-3 sum_r_soni '>Mavjud rulonlar soni: $r_soni ta</h4>
        ";

        return response()->json(["html"=>$html,"title_date"=>$title_date,"sum"=>$sum]);

    }

    public function month_search(Request $request){
        $cat_id=$request->cat_search;
        $type_id=$request->type_search;
        $status_id=$request->status_search;
        $month_id=$request->month_search;



        $statistics=DB::table('incomes')
        ->leftJoin('colors','incomes.color_id','=','colors.id')
        ->leftJoin('types','colors.type_id','=','types.id')
        ->leftJoin('cats','types.cat_id','=','cats.id')
        ->select("incomes.*","colors.name as color_name","types.name as type_name","types.price as type_price","cats.name as cat_name")
        ->when($cat_id,function($query,$cat_id){
            return $query->where("incomes.cat_id",$cat_id);
        })
        ->when($type_id,function($query,$type_id){
            return $query->where("incomes.type_id",$type_id);
        })
        ->when(is_numeric($status_id), function($query) use ($status_id) {
            return $query->where("incomes.status", $status_id);
        })
        ->when($month_id,function($query,$month_id){
            return $query->whereMonth("incomes.vaqt",$month_id);
        })->get();

        $html="";
        $i=1;

        foreach ($statistics as $statistic) {
            if ($statistic->status==1) {
                $status="Kirim";
            }
            elseif ($statistic->status==0) {
                $status="Chiqim";
            }
            $html.="<tr>
                <td>".$i++."</td> 
                <td>$statistic->cat_name</td> 
                <td>$statistic->type_name</td> 
                <td>$statistic->color_name</td> 
                <td>$status</td> 
                <td>$statistic->amount kg</td> 
                <td>$statistic->r_soni ta</td> 
                <td>".(number_format($statistic->type_price))." so'm</td> 
                <td>".(number_format($statistic->type_price*$statistic->amount))." so'm</td> 
              </tr>";
        }

        $title_date=$request->month." sana bo'yicha statistika ko'rsatilmoqda";


        $amount = DB::table("incomes")
        ->whereMonth('incomes.vaqt', $month_id)
        ->where('incomes.status', $status_id)
        ->where('incomes.cat_id', $cat_id)
        ->where('incomes.type_id', $type_id)
        ->sum('incomes.amount');

        $summa = DB::table("types")
        ->select('types.price')
        ->where('id', $type_id)
        ->first();

        $price = $summa ? $summa->price : 0;
        $sum_price=$price*$amount;
        $sum_price=number_format($sum_price);

        $r_soni = DB::table("incomes")
        ->whereMonth('incomes.vaqt', $month_id)
        ->where('incomes.status', $status_id)
        ->where('incomes.cat_id', $cat_id)
        ->where('incomes.type_id', $type_id)
        ->sum('incomes.r_soni');


        $sum="
        <h4 class='alert alert-info shadow-sm mt-3 sum_summa '>Jami summa: $sum_price so'm</h4>
        <h4 class='alert alert-info shadow-sm mt-3 sum_amount '>Mavjud miqdor: $amount kg/m</h4>
        <h4 class='alert alert-info shadow-sm mt-3 sum_r_soni '>Mavjud rulonlar soni: $r_soni ta</h4>
        ";

        return response()->json(["html"=>$html,"title_date"=>$title_date,"sum"=>$sum]);

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
        //
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
        //
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

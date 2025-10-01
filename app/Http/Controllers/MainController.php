<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Post;
use App\Models\Type;
use Session;

use Illuminate\Support\Facades\DB;


class MainController extends Controller
{
    public function index(){
        return view('dars-3/layout');
    }
    public function about(){
        return view('dars-3/about');
    }
    public function dars4(){
        $student=Student::all();
        $posts=Post::all();
        return view('dars-4.index',['student'=>$student,'posts'=>$posts]);
    }
    public function dars14(){
        return view('dars-14.index');
    }
    public function ajaxdata(Request $request){
        $db=DB::select("select * from student where name like '%$request->name%' ");
        return response()->json(['students'=>$db]);
    }
    public function dars16(){
        $cats=Type::get();
        return view('dars-16.index',['cats'=>$cats]);
    }

    public function checkses(Request $req){
        if($req['password']==123){
            session()->put('login',$req['login']);
            return view('dars-17.view');
        }
        else{
            return back()->with('fail',"Parolda xatolik mavjud!");
        }
    }
}

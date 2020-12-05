<?php

namespace App\Http\Controllers;


use App\Models\Lecture;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user=Auth::user();

        return view('index',compact('user'));
    }
    public function students(){
        $students=User::with(['classes'])->get();
        return view('students',compact('students'));
    }
    public function student($id){
        $classes=Lecture::all();
        $student=User::findOrFail($id);
        return view('student',compact('student','classes'));
    }

//    public function student(Request $request,$id){
//        $student=User::findOrFail($id);
//        $student->classes()->attach($request->classes);
//        return view('student',compact('student'));
//    }


    public function classes(){
        $classes=Lecture::with(['students'])->get();
        return view('classes',compact('classes'));
    }
    public function class($id){
        $class=Lecture::findOrFail($id);
        return view('class',compact('class'));
    }

    public function my_classes(){
        $student=Auth::user();
        return view('my_classes',compact('student'));
    }

//    public function change_class(Lecture $lecture){
//        if ($lecture->is_admin==false){
//            $lecture->is_admin=true;
//        }else{
//            $lecture->is_admin=false;
//        }
//    }
}

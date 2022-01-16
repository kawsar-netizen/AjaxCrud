<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(){
        return view('teacher.index');
    }

    
    public function alldata(){


        $data = Teacher::orderBy('id','DESC')->get();

        return response()->json($data);

    }
}

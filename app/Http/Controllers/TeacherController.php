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

    public function dataStore(Request $request){
        $request->validate([
        'name' => 'required',
        'title' => 'required',
        'institute' => 'required'
        ]);

        $data = Teacher::insert([
            'name'=>$request->name,
            'title'=>$request->title,
            'institute'=>$request->institute,
        ]);
        return response()->json($data);

    }

    public function dataEdit($id){
        $data = Teacher::findOrFail($id);
        return response()->json($data);
    }

    public function dataUpdate(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'institute' => 'required'
            ]);
    
            $data = Teacher::findOrFail($id)->update([
                'name'=>$request->name,
                'title'=>$request->title,
                'institute'=>$request->institute,
            ]);
            return response()->json($data);
    }

    public function datadestory($id){
        $data = Teacher::findOrFail($id)->delete();
        return response()->json($data);
    }
}

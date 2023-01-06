<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SkillController extends Controller
{
    public function index()
    {
     
     return response(Skill::all());
    }

    public function create(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required',
            'slug' => 'required',
        ]);

        if ($validator->fails()) 
        {
           return response($validator->errors()->first(),422);
        }
        Skill::create($req->all());
        return response()->json(['error'=>'New slug created']);
    }

    public function edit($id)
    {
     return response()->json(['data'=>Skill::find($id)]);
    }

    public function update(Request $req)
    {
       $id=$req->input('id');
       $skill=Skill::find($id);
       $skill->update(['name'=>$req->input('name'),'slug'=>$req->input('slug')]);
       return response()->json(['error'=>'data updated successfullly']);
    }

    public function delete(Request $req)
    {
      $id=$req->input('id');
      $skill=Skill::find($id);
      
      $skill->delete();
      return response()->json(['error'=>'Item deleted']);
    }
}

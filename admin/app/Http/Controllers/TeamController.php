<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamModel;

class TeamController extends Controller
{
    function TeamIndex(){
        return view('Team');
    }


    function getTeamData(){
        $result = json_encode(TeamModel::orderBy('id','desc')->get());
        return $result;
    }

    function getTeamDetails(Request $req){
        $id = $req->input('id');
        $result = json_encode(TeamModel::where('id','=',$id)->get());
        return $result;
    }


    
    function TeamDelete(Request $req){
        $id = $req->input('id');
        
        $result = TeamModel::where('id','=',$id)->delete();
        if($result==true){
            return 1;
        }
        else{
            return 0;
        }
     
    }
    
    function TeamUpdate(Request $req){
        $id = $req->input('id');
        $name = $req->input('name');
        $des = $req->input('des');
        $img = $req->input('img');
        
        $result = TeamModel::where('id','=',$id)->update(['name'=> $name,'designation'=> $des, 'image' => $img]);
        if($result==true){
            return 1;
        }
        else{
            return 0;
        }
     
    }

    function TeamAdd(Request $req){

        $name = $req->input('name');
        $des = $req->input('des');
        $img = $req->input('img');
        
        $result = TeamModel::insert(['name'=> $name,'designation'=> $des, 'image' => $img]);
        if($result==true){
            return 1;
        }
        else{
            return 0;
        }
     
    }

}

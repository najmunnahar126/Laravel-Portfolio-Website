<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamModel;

class TeamController extends Controller
{
    function TeamPage(){
    $TeamData=json_decode(TeamModel::get());
  

        return view('Team',[
            'TeamData'=>$TeamData,
            ]);
    }
}

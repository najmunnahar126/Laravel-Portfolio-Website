<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;
use App\Models\ServicesModel;
use App\Models\CourseModel;
use App\Models\TeamModel;
use App\Models\ContactModel;
use App\Models\ReviewModel;

class HomeController extends Controller
{
    function HomeIndex(){
        $UserIP=$_SERVER['REMOTE_ADDR'];
        date_default_timezone_set('Asia/Dhaka');
        $timeDate= date("Y-m-d h:i:sa");
        VisitorModel::insert(['ip_address'=>$UserIP,'visit_time'=>$timeDate]);


  $ServicesData=json_decode(ServicesModel::all());
  $CoursesData=json_decode(CourseModel::orderBy('id','desc')->limit(6)->get());
  $TeamData=json_decode(TeamModel::orderBy('id','desc')->limit(6)->get());
  $ReviewData=json_decode(ReviewModel::orderBy('id','desc')->limit(6)->get());

        return view('Home',[
            'ServicesData'=>$ServicesData,
            'CoursesData'=>$CoursesData,
            'TeamData'=>$TeamData,
            'ReviewData'=>$ReviewData
            ]);
    }


    function ContactSend(Request $request){
        $contact_name=$request->input('contact_name');
        $contact_mobile=$request->input('contact_mobile');
        $contact_email=$request->input('contact_email');
        $contact_message=$request->input('contact_message');
        $result=ContactModel::insert([
            'contact_name'=>$contact_name,
            'contact_mobile'=>$contact_mobile,
            'contact_email'=> $contact_email,
            'contact_message'=>$contact_message
        ]);

        if($result==true){
            return 1;
        }
        else{
            return 0;
        }

    }
}

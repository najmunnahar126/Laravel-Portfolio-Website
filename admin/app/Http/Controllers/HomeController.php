<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;
use App\Models\ReviewModel;
use App\Models\ContactModel;
use App\Models\ServicesModel;
use App\Models\CourseModel;
use App\Models\TeamModel;

class HomeController extends Controller
{
    function HomeIndex(){
       
        $TotalVisitor = VisitorModel::count();
        $TotalReview = ReviewModel::count();
        $TotalContact = ContactModel::count();
        $TotalServices = ServicesModel::count();
        $TotalCourse = CourseModel::count();
        $TotalTeam = TeamModel::count();

       return view('Home',[
        'TotalVisitor'=>$TotalVisitor,
        'TotalReview'=>$TotalReview,
        'TotalContact'=>$TotalContact,
        'TotalServices'=>$TotalServices,
        'TotalCourse'=>$TotalCourse,
        'TotalTeam'=>$TotalTeam
       ]);
    }
}

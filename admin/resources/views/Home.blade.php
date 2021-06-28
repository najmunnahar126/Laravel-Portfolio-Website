@extends('Layout.app')
@section('title','Home')
@section('content')

<div class="container m-4"> 
    <div class="row">
        <div class="col-md-3 p-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="count-card-title text-center">{{$TotalVisitor}}</h5>
                    <h5 class="count-card-text text-center">Total Visitor</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3 p-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="count-card-title text-center">{{$TotalServices}}</h5>
                    <h5 class="count-card-text text-center">Total Services</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3 p-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="count-card-title text-center">{{$TotalCourse}}</h5>
                    <h5 class="count-card-text text-center">Total Courses</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3 p-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="count-card-title text-center">{{$TotalTeam}}</h5>
                    <h5 class="count-card-text text-center">Total Team Members</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3 p-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="count-card-title text-center">{{$TotalContact}}</h5>
                    <h5 class="count-card-text text-center">Total Contact</h5>
                </div>
            </div>
        </div>
        <div class="col-md-3 p-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="count-card-title text-center">{{$TotalReview}}</h5>
                    <h5 class="count-card-text text-center">Total Review</h5>
                </div>
            </div>
        </div>
    </div>

</div>














@endsection
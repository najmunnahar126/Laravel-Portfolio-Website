@extends('Layout.app')
@section('title','Home')
@section('content')

@include('Component.HomeBanner')
@include('Component.HomeAbout')
@include('Component.HomeService')
@include('Component.HomeCourse')
@include('Component.HomeTeam')
@include('Component.HomeContact')
@include('Component.HomeReview')

@endsection
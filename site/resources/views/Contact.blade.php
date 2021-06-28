@extends('Layout.app')
@section('title','Contact')
@section('content')

<div class="container-fluid jumbotron mt-3 ">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6  text-center">
            <img class=" page-top-img fadeIn" src="images/ser2.svg">
            <!-- <h1 class="page-top-title mt-3">-Contact-</h1> -->
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-4">
                <div class="card-body">
                    <h5 class="service-card-title  text-center"><i class="fas fa-map-marker-alt"> Address</i></h5>
                    <h6 class="service-card-subTitle p-0 m-0 text-center">Holding #07, Road #25/A,
                    Banani, Dhaka, Bangladesh</h6>
                </div>
        </div>
        <div class="col-md-4">
                <div class="card-body"> 
                    <h5 class="service-card-title  text-center"><i class="fas fa-phone"> Phone Number</i></h5>
                    <h6 class="service-card-subTitle p-0 m-0 text-center">123456778910</h6>
                </div>
        </div>
        <div class="col-md-4">
                <div class="card-body"> 
                    <h5 class="service-card-title  text-center"><i class="fas fa-envelope"> Email</i></h5>
                    <h6 class="service-card-subTitle p-0 m-0 text-center">info@smartfieldservice.com</h6>
                </div>
        </div>
    </div>
</div>
<hr>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
        <iframe style="height:100%; width:100%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d228.16199838513262!2d90.4037796826045!3d23.797539866718225!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c7e84adfa58f%3A0x417600ba3e7c8684!2sLuxerior!5e0!3m2!1sen!2sbd!4v1623560479865!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div class="col-md-6">
        <form id="conForm">
                <h3 class="service-card-title text-center">Get In Touch With Us </h3>
                <div class="form-group ">
                    <input id="contactNameId" type="text" class="form-control w-100" placeholder="Your Name">
                </div>
                <div class="form-group">
                    <input id="contactMobileId" type="text" class="form-control  w-100" placeholder="Mobile No ">
                </div>
                <div class="form-group">
                    <input id="contactEmailId" type="text" class="form-control  w-100" placeholder="Email ">
                </div>
                <div class="form-group">
                    <input id="contactMsgId" type="text" class="form-control  w-100" placeholder="Message ">
                </div>
                <button id="contactSendBtnId" class="btn btn-block normal-btn w-100">Send </button>
                </form>
        </div>
    
    </div>


</div>


@endsection
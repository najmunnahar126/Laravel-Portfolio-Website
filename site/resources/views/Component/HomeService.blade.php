<div id="services" class="p-3 container section-marginTop text-center">
    <h1 class="section-title pt-5 ">Services </h1>
    <h1 class="section-subtitle">Smart Field Service provides a full-cycle software development service <br>that adapts effortlessly to the project requirements and business needs.</h1>
    <div class="row">
        @foreach($ServicesData as $ServicesData)
        <div class="col-md-3 p-2 ">
            <div class="card service-card text text-center w-100">
                <div class="card-body">
                    <img class="service-card-logo " src="{{$ServicesData->service_img}}" alt="Card image cap">
                    <h5 class="service-card-title mt-3">{{$ServicesData->service_name}}</h5>
                    <h6 class="service-card-subTitle p-0 m-0">{{$ServicesData->service_des}}</h6>
                </div>
            </div>
        </div>
        @endforeach
      
    </div>
</div>
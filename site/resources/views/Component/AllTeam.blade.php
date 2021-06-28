<div class="container section-marginTop text-center">
        <!-- <h1 class="section-title">Team Members</h1>
        <h1 class="section-subtitle">When your mission is to be better, you need the best people driving your vision forward
        <br>The talented people behind the scenes</h1> -->
   

            <div class="row">
            @foreach($TeamData as $TeamData)
        <div class="col-md-3 p-2 ">
            <div class="card service-card text text-center w-100">
                <div class="card-body">
                <img class="review-img text-center" src="{{$TeamData->image}}" alt="Card image cap">
                <h5 class="service-card-title mt-4">{{$TeamData->name}}</h5>
                        <h6 class="service-card-subTitle p-0 m-0 mb-2">{{$TeamData->designation}}</h6>
                        <a class=""><i class="icon-cog blackiconcolor fas fa-envelope"></i></a>
                        <a href=""><i class="icon-cog blackiconcolor fab fa-linkedin"></i></a>
                        <a href=""><i class="icon-cog blackiconcolor fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
        @endforeach
      
    </div>

        </div>
        <!-- <div class="d-inline ml-2">
            <i id="customPrevBtn" class="btn normal-btn"><</i>
            <i id="customNextBtn" class="btn normal-btn">></i>
            
        </div> -->
    </div>
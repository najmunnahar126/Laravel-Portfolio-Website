
    <div id="team" class="pt-3 container section-marginTop text-center">
        <h1 class="section-title pt-5">Team</h1>
        <h1 class="section-subtitle">When your mission is to be better, you need the best people driving your vision forward
        <br>The talented people behind the scenes</h1>
        <div class="row">

            <div id="one"  class="owl-carousel mb-4 owl-theme">
            @foreach($TeamData as $TeamData)
                <div class="item m-1 card">
                    <div class="text-center m-4">
                    <img class="review-img text-center" src="{{$TeamData->image}}" alt="Card image cap">
                        <h5 class="service-card-title mt-4">{{$TeamData->name}}</h5>
                        <h6 class="service-card-subTitle p-0 m-0 mb-2">{{$TeamData->designation}}</h6>
                        <a class=""><i class="icon-cog blackiconcolor fas fa-envelope"></i></a>
                        <a href=""><i class="icon-cog blackiconcolor fab fa-linkedin"></i></a>
                        <a href=""><i class="icon-cog blackiconcolor fab fa-twitter"></i></a>
                    </div>
                </div>
                @endforeach
              
            </div>

        </div>
        <div class="d-inline ml-2">
            <i id="customPrevBtn" class="btn normal-btn"><</i>
            <i id="customNextBtn" class="btn normal-btn">></i>
            
        </div>
    </div>
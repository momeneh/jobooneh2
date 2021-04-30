<section class="slider_section">
    <div id="myCarousel" class="carousel slide banner-main" data-ride="carousel">
        <ul class="carousel-indicators">
            @foreach($slider as $i=>$slide_item)
                 <li data-target="#myCarousel" data-slide-to="{{$i}}" class="@if($i==1) active @endif "></li>
            @endforeach
        </ul>
        <div class="carousel-inner">
            @foreach($slider as $i=>$slide_item)
                <div class="carousel-item @if($i==1) active @endif ">
                    <img class="slide" src="{{asset('link_images').'/'.$slide_item->image}}" alt="{{$slide_item->title}}">
                    <div class="container">
                        <div class="carousel-caption relative">
                            <h2>{{$slide_item->title}}</h2>
                            {!!($slide_item->description)!!}
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <i class='fa fa-angle-left'></i>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <i class='fa fa-angle-right'></i>
        </a>
    </div>
</section>

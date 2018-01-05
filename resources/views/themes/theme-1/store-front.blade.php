@extends('layouts.theme.theme-1-layout')

@section('body')
    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <div class="col-lg-3">
          <h3 class="my-4 text-center">{{$business->name}}</h3>
        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

          <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
              <div class="carousel-item active" style="height: 320px; max-height: 320px; background: url({{ $hasPhoto ? asset('/storage/'.$business->photo_path) : ''}}) no-repeat black; background-size: contain; background-position: center; ">
                {{--<img style="max-height: 100%" class="d-block img-fluid" >--}}
              </div>
              @foreach($business->plans() as $plan)
                  @if($plan->featured_photo_path)
                    <div class="carousel-item" style="height: 320px; max-height: 320px; background: url({{ asset('/storage/'.$plan->featured_photo_path) }}) no-repeat black; background-size: contain; background-position: center; ">
                    </div>
                  @endif
              @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>

          <div class="row">

            @foreach($business->plans() as $plan)
              <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                  <a href="#"><img class="card-img-top" src="{{asset('/storage/'.$plan->featured_photo_path)}}" height="160"alt=""></a>
                  <div class="card-body">
                    <h5 class="card-title">
                      <a href="#">{{substr($plan->stripe_plan_name,0,25)}}</a>
                    </h5>
                    <h5>Month: {{formatPrice($plan->month_price)}}</h5>
                    <h5>Annual: {{formatPrice($plan->year_price)}}</h5>
                    <p class="card-text">{{$plan->description}}</p>
                  </div>
                  <div class="card-footer">
                    <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                    <a class="btn btn-dark btn-sm float-right" href="{{itemUrl($business->id,$plan->id)}}">View</a>
                  </div>
                </div>
              </div>
            @endforeach


          </div>
          <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->
@endsection
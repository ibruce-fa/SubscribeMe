@extends('layouts.app')

@section('body')
  <div class="col-12">
    <h3 class="text-center">
      @if($business->logo_path)
        <div class="d-inline-block" style="width: 200px; height: 100px; background: url({{ asset('/storage/'.$business->logo_path) }}) no-repeat; background-size: contain; background-position: center;" ></div></h3>
    @else
      {{$business->name}}
    @endif
  </div>
  @include('partials.base-theme.store-nav')
    <!-- Page Content -->
    <div class="container">

      <div class="row">


        <!-- /.col-lg-3 -->

        <div class="col-lg-12">

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
              <div class="col-sm-12 col-md-4">
                <!-- product card -->
                <div class="product-item bg-light">
                  <div class="card">
                    <div class="thumb-content" style="width: 100%; height: 200px; background: url({{asset('/storage/'.$plan->featured_photo_path)}}) no-repeat; background-size: contain; background-position: center">

                    </div>
                    <div class="card-body">
                      <h4 class="card-title"><a href="">{{$plan->stripe_plan_name}}</a></h4>
                      <ul class="list-inline product-meta">
                        <li class="list-inline-item">
                          <a href=""><i class="fa fa-briefcase"></i>{{$plan->business['name']}}</a>
                        </li>

                        <li class="list-item">
                          <a href=""><i class="fa fa-location-arrow"></i>{{$plan->business['city']}}, {{$plan->business['state']}}</a>
                        </li>
                      </ul>
                      <div class="product-ratings">
                        <ul class="list-inline">
                          <span class="text-warning">
                            {{getRatingStars($plan->ratings())}}
                          </span>
                            <a class=" list-inline-item float-right">{{formatPrice($plan->month_price)}} - {{formatPrice($plan->year_price)}}</a>
                        </ul>

                      </div>
                    </div>
                    <div class="card-header">
                      <a href="/business/viewService/{{$plan->id}}" class="text-info">view service</a>
                    </div>
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
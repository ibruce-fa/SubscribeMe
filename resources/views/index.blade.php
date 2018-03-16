@extends('layouts.app')

@section('body')
<section class="hero-area text-center  bg-white" style="min-height: 100% !important;">
	<!-- Container Start -->
	<div class="container">
		<div class="row">

			<div class="col-md-12">
				<!-- Header Contetnt -->
				<div class="content-block">
				<img src="{{asset('/storage/images/logos/o-logo-w-tagline.png')}}" style="width: 70%; height: auto">
					
				</div>
				<!-- Advance Search -->

			</div>
			{{--<div class="col-3"></div>--}}
			{{--<div class="col-2"><span class="fa fa-coffee fa-2x"></span></div>--}}
			{{--<div class="col-2"><span class="fa fa-server fa-2x"></span></div>--}}
			{{--<div class="col-2"><span class="fa fa-wrench fa-2x"></span></div>--}}
			{{--<div class="col-3"></div>--}}
		</div>
	</div>
	<!-- Container End -->
</section>

<!--===================================
=            Client Slider            =
====================================-->


<!--===========================================
=            Popular deals section            =
============================================-->

<section class="popular-deals section bg-gray theme-background">
	<div class="container">
		<div class="row">
			<div class="col-md-12 mb-0">
				<div class="section-title">
					<h2 class="text-white">How it works</h2>
					<p class="text-white">First, find a service that you use often or just need in general</p>
				</div>
			</div>
		</div>
		<div class="row">
			<!-- offer 01 -->
			<div class="col-6 offset-3 mb-4 mt-0 round-5">
				<span class="fa fa-search fa-2x theme-color" style="position: relative; top: 40px; left: 10px"></span>
				<input class="form-control bg-white theme-color text-center" type="text" placeholder="nails" readonly="">
			</div>
<div class="col-sm-12 col-lg-4 hidden-sm hidden-xs">
				<!-- product card -->
	<div class="product-item bg-light">
		<div class="card">
			<div class="thumb-content">
				<!-- <div class="price">$200</div> -->
				<a href="">
					<img class="card-img-top img-fluid" src="{{asset('classimax/images/products/products-1.jpg')}}" alt="Card image cap">
				</a>
			</div>
			<div class="card-body">
				<h4 class="card-title"><a href="">11inch Macbook Air</a></h4>
				<ul class="list-inline product-meta">
					<li class="list-inline-item">
						<a href=""><i class="fa fa-folder-open-o"></i>Electronics</a>
					</li>
					<li class="list-inline-item">
						<a href=""><i class="fa fa-calendar"></i>26th December</a>
					</li>
				</ul>
				<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo, aliquam!</p>
				<div class="product-ratings">
					<ul class="list-inline">
						<li class="list-inline-item selected"><i class="fa fa-star"></i></li>
						<li class="list-inline-item selected"><i class="fa fa-star"></i></li>
						<li class="list-inline-item selected"><i class="fa fa-star"></i></li>
						<li class="list-inline-item selected"><i class="fa fa-star"></i></li>
						<li class="list-inline-item"><i class="fa fa-star"></i></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
			<div class="col-sm-12 col-lg-4 hidden-sm hidden-xs">
				<!-- product card -->
<div class="product-item bg-light">
	<div class="card">
		<div class="thumb-content">
			<!-- <div class="price">$200</div> -->
			<a href="">
				<img class="card-img-top img-fluid" src="{{asset('classimax/images/products/products-2.jpg')}}" alt="Card image cap">
			</a>
		</div>
		<div class="card-body">
		    <h4 class="card-title"><a href="">Full Study Table Combo</a></h4>
		    <ul class="list-inline product-meta">
		    	<li class="list-inline-item">
		    		<a href=""><i class="fa fa-folder-open-o"></i>Furnitures</a>
		    	</li>
		    	<li class="list-inline-item">
		    		<a href=""><i class="fa fa-calendar"></i>26th December</a>
		    	</li>
		    </ul>
		    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo, aliquam!</p>
		    <div class="product-ratings">
		    	<ul class="list-inline">
		    		<li class="list-inline-item selected"><i class="fa fa-star"></i></li>
		    		<li class="list-inline-item selected"><i class="fa fa-star"></i></li>
		    		<li class="list-inline-item selected"><i class="fa fa-star"></i></li>
		    		<li class="list-inline-item selected"><i class="fa fa-star"></i></li>
		    		<li class="list-inline-item"><i class="fa fa-star"></i></li>
		    	</ul>
		    </div>
		</div>
	</div>
</div>



			</div>
			<div class="col-sm-12 col-lg-4">
				<!-- product card -->
<div class="product-item bg-light">
	<div class="card">
		<div class="thumb-content">
			<!-- <div class="price">$200</div> -->
			<a href="">
				<img class="card-img-top img-fluid" src="{{asset('classimax/images/products/products-3.jpg')}}" alt="Card image cap">
			</a>
		</div>
		<div class="card-body">
		    <h4 class="card-title"><a href="">11inch Macbook Air</a></h4>
		    <ul class="list-inline product-meta">
		    	<li class="list-inline-item">
		    		<a href=""><i class="fa fa-folder-open-o"></i>Electronics</a>
		    	</li>
		    	<li class="list-inline-item">
		    		<a href=""><i class="fa fa-calendar"></i>26th December</a>
		    	</li>
		    </ul>
		    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo, aliquam!</p>
		    <div class="product-ratings">
		    	<ul class="list-inline">
		    		<li class="list-inline-item selected"><i class="fa fa-star"></i></li>
		    		<li class="list-inline-item selected"><i class="fa fa-star"></i></li>
		    		<li class="list-inline-item selected"><i class="fa fa-star"></i></li>
		    		<li class="list-inline-item selected"><i class="fa fa-star"></i></li>
		    		<li class="list-inline-item"><i class="fa fa-star"></i></li>
		    	</ul>
		    </div>
		</div>
	</div>
</div>



			</div>
			
			
		</div>
	</div>
</section>



<!--==========================================
=            All Category Section            =
===========================================-->

<section class=" section">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<div class="col-12">
				<!-- Section title -->
				<div class="section-title">
					<h2>All Categories</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis, provident!</p>
				</div>
				<div class="row">
					<!-- Category list -->
					<div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6 col-6">
						<div class="category-block">
							<div class="header">
								<i class="fa fa-laptop icon-bg-1"></i> 
								<h4>Electronics</h4>
							</div>
							<ul class="category-list" >
								<li><a href="category.html">Laptops <span>93</span></a></li>
								<li><a href="category.html">Iphone <span>233</span></a></li>
								<li><a href="category.html">Microsoft  <span>183</span></a></li>
								<li><a href="category.html">Monitors <span>343</span></a></li>
							</ul>
						</div>
					</div> <!-- /Category List -->
					<!-- Category list -->
					<div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6 col-6">
						<div class="category-block">
							<div class="header">
								<i class="fa fa-apple icon-bg-2"></i> 
								<h4>Restaurants</h4>
							</div>
							<ul class="category-list" >
								<li><a href="category.html">Cafe <span>393</span></a></li>
								<li><a href="category.html">Fast food <span>23</span></a></li>
								<li><a href="category.html">Restaurants  <span>13</span></a></li>
								<li><a href="category.html">Food Track<span>43</span></a></li>
							</ul>
						</div>
					</div> <!-- /Category List -->
					<!-- Category list -->
					<div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6 col-6">
						<div class="category-block">
							<div class="header">
								<i class="fa fa-home icon-bg-3"></i> 
								<h4>Real Estate</h4>
							</div>
							<ul class="category-list" >
								<li><a href="category.html">Farms <span>93</span></a></li>
								<li><a href="category.html">Gym <span>23</span></a></li>
								<li><a href="category.html">Hospitals  <span>83</span></a></li>
								<li><a href="category.html">Parolurs <span>33</span></a></li>
							</ul>
						</div>
					</div> <!-- /Category List -->
					<!-- Category list -->
					<div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6 col-6">
						<div class="category-block">
							<div class="header">
								<i class="fa fa-shopping-basket icon-bg-4"></i> 
								<h4>Shoppings</h4>
							</div>
							<ul class="category-list" >
								<li><a href="category.html">Mens Wears <span>53</span></a></li>
								<li><a href="category.html">Accessories <span>212</span></a></li>
								<li><a href="category.html">Kids Wears <span>133</span></a></li>
								<li><a href="category.html">It & Software <span>143</span></a></li>
							</ul>
						</div>
					</div> <!-- /Category List -->
					<!-- Category list -->
					<div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6 col-6">
						<div class="category-block">
							<div class="header">
								<i class="fa fa-briefcase icon-bg-5"></i> 
								<h4>Jobs</h4>
							</div>
							<ul class="category-list" >
								<li><a href="category.html">It Jobs <span>93</span></a></li>
								<li><a href="category.html">Cleaning & Washing <span>233</span></a></li>
								<li><a href="category.html">Management  <span>183</span></a></li>
								<li><a href="category.html">Voluntary Works <span>343</span></a></li>
							</ul>
						</div>
					</div> <!-- /Category List -->
					<!-- Category list -->
					<div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6 col-6">
						<div class="category-block">
							<div class="header">
								<i class="fa fa-car icon-bg-6"></i> 
								<h4>Vehicles</h4>
							</div>
							<ul class="category-list" >
								<li><a href="category.html">Bus <span>193</span></a></li>
								<li><a href="category.html">Cars <span>23</span></a></li>
								<li><a href="category.html">Motobike  <span>33</span></a></li>
								<li><a href="category.html">Rent a car <span>73</span></a></li>
							</ul>
						</div>
					</div> <!-- /Category List -->
					<!-- Category list -->
					<div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6 col-6">
						<div class="category-block">
							<div class="header">
								<i class="fa fa-paw icon-bg-7"></i> 
								<h4>Pets</h4>
							</div>
							<ul class="category-list" >
								<li><a href="category.html">Cats <span>65</span></a></li>
								<li><a href="category.html">Dogs <span>23</span></a></li>
								<li><a href="category.html">Birds  <span>113</span></a></li>
								<li><a href="category.html">Others <span>43</span></a></li>
							</ul>
						</div>
					</div> <!-- /Category List -->
					<!-- Category list -->
					<div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6 col-6">
						<div class="category-block">
							<div class="header">
								<i class="fa fa-laptop icon-bg-8"></i> 
								<h4>Services</h4>
							</div>
							<ul class="category-list" >
								<li><a href="category.html">Cleaning <span>93</span></a></li>
								<li><a href="category.html">Car Washing <span>233</span></a></li>
								<li><a href="category.html">Clothing  <span>183</span></a></li>
								<li><a href="category.html">Business <span>343</span></a></li>
							</ul>
						</div>
					</div> <!-- /Category List -->
					
					
				</div>
			</div>
		</div>
	</div>
	<!-- Container End -->
</section>


@endsection






@extends('frontend.layouts.app')

@section('content')
    <!--Middle Part Start-->
    <div id="content" class="col-xs-12">
        <!-- Slideshow Start-->
        <div class="slideshow single-slider owl-carousel">
            <div class="item"> <a href="#"><img class="img-responsive" src="frontend/image/slider/banner-2.jpg" alt="banner 2" /></a> </div>
            <div class="item"> <a href="#"><img class="img-responsive" src="frontend/image/slider/banner-1.jpg" alt="banner 1" /></a> </div>
        </div>
        <!-- Slideshow End-->

        <!-- محصولات Tab Start -->
        <div id="product-tab" class="product-tab">
            <ul id="tabs" class="tabs">
                <li><a href="#tab-featured">جدیدترین ها</a></li>
            </ul>
            <div id="tab-featured" class="tab_content">
                <div class="owl-carousel product_carousel_tab">
                    @foreach($latestProducts as $latestProduct)
                    <div class="product-thumb clearfix">
                        <div class="image" style="width: 220px !important; height: 330px !important;"><a href="{{route('frontend.product.get', $latestProduct->slug)}}"><img src="{{$latestProduct->photos[0]->path}}" alt="{{$latestProduct->title}}" title="{{$latestProduct->title}}" class="img-responsive" /></a></div>
                        <div class="caption">
                            <h4><a href="product.html">{{$latestProduct->title}}</a></h4>
                            @if($latestProduct->discount_price == '')
                                <p class="price">{{$latestProduct->price}} تومان</p>
                            @else
                                <p class="price"><span class="price-new">{{$latestProduct->discount_price}} تومان</span> <span class="price-old">{{$latestProduct->price}} تومان</span><span class="saving">{{ round((($latestProduct->price - $latestProduct->discount_price)*100)/$latestProduct->price) }}%</span></p>
                            @endif
                        </div>
                        <div class="button-group">
                            <a class="btn-primary" href="{{route('cart.add', ['id' => $latestProduct->id])}}"><span>افزودن به سبد</span></a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>    <!-- محصولات Tab Start -->
        <!-- Banner Start -->
        <div class="marketshop-banner">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><a href="#"><img src="frontend/image/banner/sample-banner-4-600x250.jpg" alt="2 Block Banner" title="2 Block Banner" /></a></div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><a href="#"><img src="frontend/image/banner/sample-banner-5-600x250.jpg" alt="2 Block Banner 1" title="2 Block Banner 1" /></a></div>
            </div>
        </div>
        <!-- Banner End -->
        <!-- دسته ها محصولات Slider Start-->
        <div class="category-module" id="latest_category">
            <h3 class="subtitle">همه دسته بندی ها </h3>
            <div class="category-module-content">
                <ul id="sub-cat" class="tabs">
                    @foreach($categories as $key => $category)
                    <li><a href="#tab-cat{{$key+1}}">{{$category->name}}</a></li>
                    @endforeach
                </ul>
                @foreach($categories as $key => $category)
                <div id="tab-cat{{$key+1}}" class="tab_content">
                    <div class="owl-carousel latest_category_tabs">
                        @foreach($category->products as $categoryProduct)
                        <div class="product-thumb">
                            <div class="image" style="width: 220px !important; height: 330px !important;"><a href="{{route('frontend.product.get', $categoryProduct->slug)}}"><img src="{{$categoryProduct->photos[0]->path}}" alt="تبلت ایسر" title="تبلت ایسر" class="img-responsive" /></a></div>
                            <div class="caption">
                                <h4><a href="product.html">{{$categoryProduct->title}}</a></h4>
                                @if($categoryProduct->discount_price == '')
                                    <p class="price">{{$categoryProduct->price}} تومان</p>
                                @else
                                    <p class="price"><span class="price-new">{{$categoryProduct->discount_price}} تومان</span> <span class="price-old">{{$categoryProduct->price}} تومان</span><span class="saving">{{ round((($categoryProduct->price - $categoryProduct->discount_price)*100)/$categoryProduct->price) }}%</span></p>
                                @endif
                            </div>
                            <div class="button-group">
                                <button class="btn-primary" type="button" onClick="cart.add({{$categoryProduct->id}})"><span>افزودن به سبد</span></button>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
                @endforeach

            </div>
        </div>
        <!-- دسته ها محصولات Slider End-->

        <!-- برند Logo Carousel Start-->
        <div id="carousel" class="owl-carousel nxt">
            @foreach($brands as $brand)
            <div class="item text-center" style="width: 100px !important; height: 100px !important;"> <a href="#"><img src="{{$brand->photo->path}}" alt="{{$brand->title}}" title="{{$brand->title}}" class="img-responsive" /></a> </div>
            @endforeach
        </div>
        <!-- برند Logo Carousel End -->
    </div>
    <!--Middle Part End-->

@endsection

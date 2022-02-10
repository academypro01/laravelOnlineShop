@extends('frontend.layouts.app')

@section('app-scripts')
    <script type="text/javascript" src="{{asset('frontend/js/jquery.elevateZoom-3.0.8.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/swipebox/lib/ios-orientationchange-fix.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/swipebox/src/js/jquery.swipebox.min.js')}}"></script>
    <script type="text/javascript">
        // Elevate Zoom for Product Page image
        $("#zoom_01").elevateZoom({
            gallery:'gallery_01',
            cursor: 'pointer',
            galleryActiveClass: 'active',
            imageCrossfade: true,
            zoomWindowFadeIn: 500,
            zoomWindowFadeOut: 500,
            zoomWindowPosition : 11,
            lensFadeIn: 500,
            lensFadeOut: 500,
            loadingIcon: 'image/progress.gif'
        });
        //////pass the images to swipebox
        $("#zoom_01").bind("click", function(e) {
            var ez =   $('#zoom_01').data('elevateZoom');
            $.swipebox(ez.getGalleryList());
            return false;
        });
    </script>
@endsection

@section('content')
    <!-- Breadcrumb Start-->
    <ul class="breadcrumb">
        <li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a  itemprop="url"><span itemprop="title"><i class="fa fa-home"></i></span></a></li>
        <li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url"><span itemprop="title">{{$product->categories[0]->name}}</span></a></li>
        <li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url"><span itemprop="title">{{$product->title}}</span></a></li>
    </ul>
    <!-- Breadcrumb End-->
    <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-9">
            <div itemscope="" itemtype="http://schema.org/محصولات">
                <h1 class="title" itemprop="name">{{$product->title}}</h1>
                <div class="row product-info">
                    <div class="col-sm-6">
                        <div class="image"><div style="height:525px;width:350px;" class="zoomWrapper"><img class="img-responsive" itemprop="image" id="zoom_01" src="{{$product->photos[0]->path}}" title="{{$product->title}}" alt="{{$product->title}}" data-zoom-image="{{$product->photos[0]->path}}" style="position: absolute;"></div> </div>
                        <div class="center-block text-center"><span class="zoom-gallery"><i class="fa fa-search"></i> برای مشاهده گالری روی تصویر کلیک کنید</span></div>
                        <div class="image-additional" id="gallery_01">
                            @foreach($product->photos as $photo)
                                <a class="thumbnail" href="#" data-zoom-image="{{$photo->path}}" data-image="{{$photo->path}}" title="{{$product->title}}">
                                    <img src="{{$photo->path}}" title="{{$product->title}}" alt="{{$product->title}}">
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <ul class="list-unstyled description">
                            <li><b>برند :</b> <a href="#"><span itemprop="brand">{{$product->brand->title}}</span></a></li>
                            <li><b>کد محصول :</b> <span itemprop="mpn">{{$product->sku}}</span></li>
                            <li><b>وضعیت موجودی :</b> <span class="instock">
                                    @if ($product->count == 1)
                                        موجود
                                    @else
                                        عدم موجودی
                                    @endif
                                </span></li>
                        </ul>
                        <ul class="price-box">
                            <li class="price" itemprop="offers" itemscope="" >

                            <span class="price-old">{{$product->price}} تومان</span>
                            @if($product->discount_price != null)
                                    <span itemprop="price">{{$product->discount_price}} تومان<span itemprop="availability"></span></span></li>
                            @endif
                            <li></li>
                        </ul>
                        <div id="product">
                            <div class="cart">
                                <div>
                                    <a type="button" id="button-cart" href="{{route('cart.add', $product->id)}}" class="btn btn-primary btn-lg">افزودن به سبد</a>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!-- AddThis Button BEGIN -->
                        <div class="addthis_toolbox addthis_default_style"> <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_button_google_plusone" g:plusone:size="medium"></a> <a class="addthis_button_pinterest_pinit" pi:pinit:layout="horizontal" pi:pinit:url="http://www.addthis.com/features/pinterest" pi:pinit:media="http://www.addthis.com/cms-content/images/features/pinterest-lg.png"></a> <a class="addthis_counter addthis_pill_style"></a> </div>
                        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-514863386b357649"></script>
                        <!-- AddThis Button END -->
                    </div>
                </div>
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab-description" data-toggle="tab">توضیحات</a></li>
                    <li><a href="#tab-specification" data-toggle="tab">مشخصات</a></li>
                    <li><a href="#tab-review" data-toggle="tab">بررسی (2)</a></li>
                </ul>
                <div class="tab-content">
                    <div itemprop="description" id="tab-description" class="tab-pane active">
                        <div>
                        {!! $product->description !!}
                        </div>
                    </div>
                    <div id="tab-specification" class="tab-pane">
                        <div id="tab-specification" class="tab-pane">
                            <table class="table table-bordered">
                                <tbody>
                                @foreach($product->attributesValue as $attribute)
                                <tr>
                                    <td>{{$attribute->attributeGroup->title}}</td>
                                    <td>{{$attribute->title}}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="tab-review" class="tab-pane">
                        <form class="form-horizontal">
                            <div id="review">
                                <div>
                                    <table class="table table-striped table-bordered">
                                        <tbody>
                                        <tr>
                                            <td style="width: 50%;"><strong><span>هاروی</span></strong></td>
                                            <td class="text-right"><span>1395/1/20</span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><p>ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>
                                                <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> </div></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-striped table-bordered">
                                        <tbody>
                                        <tr>
                                            <td style="width: 50%;"><strong><span>اندرسون</span></strong></td>
                                            <td class="text-right"><span>1395/1/20</span></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><p>ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>
                                                <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right"></div>
                            </div>
                            <h2>یک بررسی بنویسید</h2>
                            <div class="form-group required">
                                <div class="col-sm-12">
                                    <label for="input-name" class="control-label">نام شما</label>
                                    <input type="text" class="form-control" id="input-name" value="" name="name">
                                </div>
                            </div>
                            <div class="form-group required">
                                <div class="col-sm-12">
                                    <label for="input-review" class="control-label">بررسی شما</label>
                                    <textarea class="form-control" id="input-review" rows="5" name="text"></textarea>
                                    <div class="help-block"><span class="text-danger">توجه :</span> HTML بازگردانی نخواهد شد!</div>
                                </div>
                            </div>
                            <div class="form-group required">
                                <div class="col-sm-12">
                                    <label class="control-label">رتبه</label>
                                    &nbsp;&nbsp;&nbsp; بد&nbsp;
                                    <input type="radio" value="1" name="rating">
                                    &nbsp;
                                    <input type="radio" value="2" name="rating">
                                    &nbsp;
                                    <input type="radio" value="3" name="rating">
                                    &nbsp;
                                    <input type="radio" value="4" name="rating">
                                    &nbsp;
                                    <input type="radio" value="5" name="rating">
                                    &nbsp;خوب</div>
                            </div>
                            <div class="buttons">
                                <div class="pull-right">
                                    <button class="btn btn-primary" id="button-review" type="button">ادامه</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <h3 class="subtitle">محصولات مرتبط</h3>
                <div class="owl-carousel related_pro">
                    @foreach($relatedProducts as $relatedProduct)
                        <div class="product-thumb">
                                <div class="image" style="height: 330px !important;"><a href="{{route('frontend.product.get', $relatedProduct->slug)}}"><img src="{{$relatedProduct->photos[0]->path}}" alt="{{$product->title}}" title="{{$product->title}}" class="img-responsive"></a></div>
                                <div class="caption">
                                    <h4><a href="{{route('frontend.product.get', $relatedProduct->slug)}}">{{$product->title}}</a></h4>
                                    @if($relatedProduct->discount_price == '')
                                        <p class="price">{{$relatedProduct->price}} تومان</p>
                                    @else
                                        <p class="price"><span class="price-new">{{$relatedProduct->discount_price}} تومان</span> <span class="price-old">{{$relatedProduct->price}} تومان</span><span class="saving">{{ round((($relatedProduct->price - $relatedProduct->discount_price)*100)/$relatedProduct->price) }}%</span></p>
                                    @endif
                                </div>
                                <div class="button-group">
                                    <a href="{{route('cart.add', $relatedProduct->id)}}" class="btn-primary" type="button" ><span>افزودن به سبد</span></a>
                                </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
@endsection

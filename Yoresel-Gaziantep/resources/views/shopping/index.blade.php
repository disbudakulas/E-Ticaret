<!DOCTYPE html>
<html lang="en">
@include('shopping/head')

<body>
@include('shopping/header')
@if($slide)
    <section id="slider"><!--slider-->
        <div class="container container-full">
            <div class="row ">
                <div class="col-sm-12 col-md-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                        <?php $number = 0; ?>
                            @foreach($slide as $resim)
                                <li data-target="#slider-carousel" data-slide-to="{{ $number }}" class="@if($number == 0) active @endif"></li>
                                <?php $number++; ?>
                            @endforeach
                        </ol>
                        <div class="carousel-inner">
                            <?php $number = 1; ?>
                            @foreach($slide as $resim)
                                <div class="item @if($number == 1) active @endif">
                                    <div class="col-xs-6">
                                        <h1><span>{{ substr($resim['title'],0,1) }}</span>{{ substr($resim['title'],1) }}</h1>
                                        <h2>{{ $resim['slogan'] }}</h2>
                                        <p>{{ $resim['description'] }}</p>
                                        <a href="{{ $resim['url'] }}"><button type="button" class="btn btn-default get">Şimdi Git</button></a>
                                    </div>
                                    <div class="col-xs-6">
                                        <img src="storage/uploads/slide/picturecrop/{{ $resim['picture'] }}" class="girl img-responsive" alt="" />
                                    </div>
                                </div>
                                <?php $number++; ?>
                            @endforeach
                        </div>
                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section><!--/slider-->
@endif


<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    @include('shopping/category-accordian')
                    <div class="shipping text-center"><!--shipping-->
                        <img src="shopping/images/home/shipping.jpg" alt="" />
                    </div><!--/shipping-->

                </div>
            </div>
            <div class="col-sm-9">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Yeni Ürünler</h2>
                    @if(isset($yeniurunler))
                        @foreach($yeniurunler as $key=>$yeniurun)
                            <div class="item">
                            <div class=" col-xs-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{ $yeniurun['resim'] }}" alt="" />
                                            <div class="row product-price">
                                                <h2>@if($yeniurun['indirimturu'] != 0){{ number_format($yeniurun['indirimlifiyat'], 2) }} @else {{ number_format($yeniurun['fiyat'], 2) }} @endif
                                                    <i class="fa fa-turkish-lira (alias)"></i>
                                                </h2>
                                                @if($yeniurun['indirimturu'] != 0)<p class="new-item-old-price">{{ number_format($yeniurun['fiyat'], 2) }} <i class="fa fa-turkish-lira (alias)"></i></p>@endif
                                            </div>
                                            <div class="row product-title">
                                                <p title="{{ $yeniurun['ad'] }}">{{ (mb_strlen($yeniurun['ad'])<35)?$yeniurun['ad']:(mb_substr($yeniurun['ad'],0,35).'...') }}</p>
                                            </div>
                                            <div class="row">
                                                @if(\Illuminate\Support\Facades\Auth::user())
                                                    <a href="/sepeteekle/{{ $key }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>{{ __('shopping.sepeteekle') }}</a>
                                                @else
                                                    @include('shopping/login-modal')
                                                @endif
                                                <a href="/urundetay?urun={{ $key }}" class="btn btn-default add-to-cart"><i class="fa fa-search"></i>{{ __('shopping.incele') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        @endforeach
                    @endif
                </div><!--features_items-->
                @include('shopping/firsat-urunleri')
            </div>
        </div>
    </div>
</section>
@include('shopping/footer')
</body>
</html>

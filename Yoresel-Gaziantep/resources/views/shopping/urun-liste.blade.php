<!DOCTYPE html>
<html lang="en">
@include('shopping/head')

<body>
@include('shopping/header')

<section id="advertisement">
    <div class="container">
        <img src="images/shop/advertisement.jpg" alt="" />
    </div>
</section>
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
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <?php
                    $count = 1;
                    $pagerCount = 1;
                    ?>
                    @if($urunler)
                        @foreach($urunler as $urun)
                            @if($count > (($page-1)*12) && $count<=($page*12))
                                <div class="item">
                                    <div class="col-xs-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="{{ $urun['resim'] }}" alt="" />
                                                    <div class="row product-price">
                                                        <h2>@if($urun['indirimturu'] != 0){{ number_format($urun['indirimlifiyat'], 2) }} @else {{ number_format($urun['fiyat'], 2) }} @endif
                                                            <i class="fa fa-turkish-lira (alias)"></i>
                                                        </h2>
                                                        @if($urun['indirimturu'] != 0)<p class="new-item-old-price">{{ number_format($urun['fiyat'], 2) }} <i class="fa fa-turkish-lira (alias)"></i></p>@endif
                                                    </div>
                                                    <div class="row product-title">
                                                        <p title="{{ $urun['ad'] }}">{{ (mb_strlen($urun['ad'])<35)?$urun['ad']:(mb_substr($urun['ad'],0,35).'...') }}</p>
                                                    </div>
                                                    <div class="row">
                                                        @if(\Illuminate\Support\Facades\Auth::user())
                                                            <a href="/sepeteekle/{{ $urun['id'] }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>{{ __('shopping.sepeteekle') }}</a>
                                                        @else
                                                            @include('shopping/login-modal')
                                                        @endif
                                                        <a href="/urundetay?urun={{ $urun['id'] }}" class="btn btn-default add-to-cart"><i class="fa fa-search"></i>{{ __('shopping.incele') }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <?php $count++; ?>
                        @endforeach
                    @endif
                </div><!--features_items-->
                <div class="row" style="text-align: center">
                    <ul class="pagination">
                        @if(($count-1)%12 == 0)
                            <?php $totalPager = $count/12; ?>
                        @else
                            <?php $totalPager = ($count/12)+1; ?>
                        @endif
                        @while($pagerCount < $totalPager)
                            @if($pagerCount == $page)
                                <li class="active"><a class="page-link" href="/urunliste/{{ $kategori }}?sayfa={{ $pagerCount }}">{{ $pagerCount }}</a></li>
                            @else
                                <li><a class="page-link" href="/urunliste/{{ $kategori }}?sayfa={{ $pagerCount }}">{{ $pagerCount }}</a></li>
                            @endif
                            <?php $pagerCount++; ?>
                        @endwhile
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@include('shopping/footer')
</body>
</html>

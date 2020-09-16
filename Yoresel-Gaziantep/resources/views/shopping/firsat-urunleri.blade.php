@if(isset($indirimliurunler))
    <div class="recommended_items"><!--recommended_items-->
        <h2 class="title text-center">Fırsat Ürünleri</h2>
        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php  $count = 0; ?>
                @for($i=0;$i<count($indirimliurunler)/3;$i++)
                    <div class="item @if($i==0) active @endif">
                        @for($j=$count;$j<($i+1)*3;$j++)
                            @if($j<count($indirimliurunler))
                                <div class="col-xs-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="{{ $indirimliurunler[$j]['resim'] }}" alt="" />
                                                <div class="row product-price">
                                                    <h2>@if($indirimliurunler[$j]['indirimturu'] != 0){{ number_format($indirimliurunler[$j]['indirimlifiyat'], 2) }} @else {{ number_format($indirimliurunler[$j]['fiyat'], 2) }} @endif
                                                        <i class="fa fa-turkish-lira (alias)"></i>
                                                    </h2>
                                                    @if($indirimliurunler[$j]['indirimturu'] != 0)<p class="new-item-old-price">{{ number_format($indirimliurunler[$j]['fiyat'], 2) }} <i class="fa fa-turkish-lira (alias)"></i></p>@endif
                                                </div>
                                                <div class="row product-title">
                                                    <p title="{{ $indirimliurunler[$j]['ad'] }}">{{ (mb_strlen($indirimliurunler[$j]['ad'])<35)?$indirimliurunler[$j]['ad']:(mb_substr($indirimliurunler[$j]['ad'],0,35).'...') }}</p>
                                                </div>
                                                <div class="row">
                                                    @if(\Illuminate\Support\Facades\Auth::user())
                                                        <a href="/sepeteekle/{{ $indirimliurunler[$j]['id'] }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>{{ __('shopping.sepeteekle') }}</a>
                                                    @else
                                                        @include('shopping/login-modal')
                                                    @endif
                                                    <a href="/urundetay?urun={{ $indirimliurunler[$j]['id'] }}" class="btn btn-default add-to-cart"><i class="fa fa-search"></i>{{ __('shopping.incele') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <?php $count++; ?>
                        @endfor
                    </div>
                @endfor
            </div>
            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </div><!--/recommended_items-->
@endif

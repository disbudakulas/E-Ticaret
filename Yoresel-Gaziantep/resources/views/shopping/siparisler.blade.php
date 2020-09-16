<!DOCTYPE html>
<html lang="en">
@include('shopping/head')
<link href="{{asset('/adminmaterial/vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet">
<body>
@include('shopping/header')
<section id="cart_items">
    <div class="container container-full">
        <div class="col-sm-3 col-xs-12">
            @include('shopping/account-menu')
        </div>
        <div class="col-sm-9 col-xs-12">
            <div class="table-responsive cart_info">
                <div class="row basket-item-list-container">
                    @if(isset($siparisler) and $siparisler)
                        @foreach($siparisler as $key=>$item)
                            <div class="row basket-item-list">
                                <div class="col-sm-2 col-xs-12 basket-item-img-container">
                                    <img class="basket-item-img" src="{{ isset($item['resim'])?$item['resim']:null }}" alt="">
                                </div>
                                <div class="col-sm-5 col-xs-12 basket-item-description">
                                    <p class="basket-item-name">{{ isset($item['ad'])?$item['ad']:null }}</p>
                                </div>
                                <div class="col-sm-2 col-xs-5">
                                    <p class="basket-item-name">{{ __('tanimlar.siparisdurum.'.$item['durum']) }}</p>
                                </div>
                                <div class="col-sm-2 col-xs-6 text-center">
                                    {{ isset($item['tutar'])?number_format($item['tutar'],2):null }} <i class="fa fa-turkish-lira (alias)"></i>
                                </div>
                            </div>
                            <hr class="basket-item-bar"/>
                        @endforeach
                    @else
                        <div class="row basket-item-list">
                            <div class="col-xs-12">
                                <p class="null-basket">{{ __('shopping.siparisbulunmamakta') }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section> <!--/#cart_items-->
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <div class="shipping text-center"><!--shipping-->
                        <img src="shopping/images/home/shipping.jpg" alt="" />
                    </div><!--/shipping-->

                </div>
            </div>
            <div class="col-sm-9 padding-right">
                @include('shopping/firsat-urunleri')
            </div>
        </div>
    </div>
</section>
@include('shopping/footer')
</body>
</html>

<!DOCTYPE html>
<html lang="en">
@include('shopping/head')

<body>
@include('shopping/header')
<section id="cart_items">
    <div class="container">
        <div class="col-lg-9 col-md-12">
            <div class="table-responsive cart_info">
                <div class="row">
                    <div class="col-xs-12 basket-title">
                        {{ __('shopping.sepetim') }}
                    </div>
                </div>
                <hr class="basket-item-bar"/>
                @if(isset($sepet) and $sepet)
                    @foreach($sepet as $key=>$item)
                        <div class="row basket-item-list">
                            <div class="col-sm-12 text-right">
                                <a class="cart_quantity_delete"  onclick="itembasketnumberdelete({{ $key }})"><i class="fa fa-times"></i></a>
                            </div>
                            <div class="col-sm-2 col-xs-12 basket-item-img-container">
                                <a href=""><img class="basket-item-img" src="{{ isset($item['resim'])?$item['resim']:null }}" alt=""></a>
                            </div>
                            <div class="col-sm-5 col-xs-12 basket-item-description">
                                <p class="basket-item-name"><a href="" style="color: #484848">{{ isset($item['ad'])?$item['ad']:null }}</a></p>
                                <p class="basket-item-seller"><strong>{{ __('shopping.kargoucret') }}: </strong><tag class="basket-item-seller-value">{{ isset($item['kargo'])?number_format($item['kargo'],2):number_format(0,2) }} <i class="fa fa-turkish-lira (alias)"></i></tag></p>
                                <p class="basket-item-seller"><strong>{{ __('shopping.satici') }}: </strong><tag class="basket-item-seller-value">{{ isset($item['satici'])?$item['satici']:null }}</tag></p>
                            </div>
                            <div class="col-sm-2 col-xs-5">
                                <div class="basket--item-number-container">
                                    <div class="basket-item-number-container">
                                        <div class="item-detail-number">
                                            <input class="item-detail-number-input" name="{{ $key }}" type="number" oninput="numberUpdate({{ $key }})" maxlength="3" value="{{ isset($item['adet'])?$item['adet']:1 }}" />
                                            <label class="item-detail-number-label">Adet</label>
                                        </div>
                                        <div class="item-detail-number-prev" onclick="itembasketnumbershow(-1,{{ $key }})">-</div>
                                        <div class="item-detail-number-next" onclick="itembasketnumbershow(1,{{ $key }})">+</div>
                                    </div>
                                </div>
                                <div class="number-update" id="guncelle{{ $key }}" onclick="itembasketnumberupdate({{ $key }})">{{ __('shopping.guncelle') }}</div>
                                <div class="number-update" id="sil{{ $key }}" onclick="itembasketnumberdelete({{ $key }})">{{ __('shopping.urunsil') }}</div>
                            </div>
                            <div class="col-sm-2 col-xs-6 text-center">
                                {{ isset($item['fiyat'])?number_format($item['fiyat'],2):null }} <i class="fa fa-turkish-lira (alias)"></i>
                            </div>
                        </div>
                        <hr class="basket-item-bar"/>
                    @endforeach
                @else
                    <div class="row basket-item-list">
                        <div class="col-xs-12">
                            <p class="null-basket">{{ __('shopping.sepetbos') }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-lg-3 col-md-12">
            @if(isset($sepet) and $sepet)
                <div class="table-responsive cart_info">
                    <div class="row">
                        <div class="col-xs-12 payment-title">
                            {{ __('shopping.tutar') }}
                        </div>
                    </div>
                    <hr class="basket-item-bar"/>
                    <div class="row">
                        <div class="col-xs-12 payment-amount">
                            <p class="col-xs-12 payment-text">{{ __('shopping.sepettutar') }}</p>
                            <label id="total-amount">{{ isset($toplam)?number_format($toplam,2):number_format(0,2) }}</label> <i class="fa fa-turkish-lira (alias)"></i>
                        </div>
                        <div class="col-xs-12 payment-amount">
                            <p class="col-xs-12 payment-text">{{ __('shopping.kdv') }}(%{{ isset($kdvoran)?$kdvoran:0 }})</p>
                            <label id="kdv">{{ isset($kdv)?number_format($kdv,2):number_format(0,2) }}</label> <i class="fa fa-turkish-lira (alias)"></i>
                        </div>
                        <div class="col-xs-12 payment-amount">
                            <p class="col-xs-12 payment-text">{{ __('shopping.geneltoplam') }}</p>
                            <label id="geneltoplam">{{ isset($geneltoplam)?number_format($geneltoplam,2):number_format(0,2) }}</label> <i class="fa fa-turkish-lira (alias)"></i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 payment-amount">
                            <a href="{{ route('alisveristamamla') }}" class="btn btn-default add-to-cart">{{ __('shopping.avtamamla') }} <i class="fa fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            @endif
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

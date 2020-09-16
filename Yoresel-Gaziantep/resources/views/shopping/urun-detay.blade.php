<!DOCTYPE html>
<html lang="en">
@include('shopping/head')


<body>
@include('shopping/header')

<section>
    <div class="container">
        <div class="row">
            @if(isset($urundetay))
                <div class="col-sm-12 padding-right">
                    <div class="product-details"><!--product-details-->
                        <div class="col-sm-7">
                            @if(isset($urunresimleri))
                                <div class="product-details-slide-container" style="max-width:800px">
                                    @foreach($urunresimleri as $resim)
                                        <img class="product-details-slide-image" src="{{ $resim['resim'] }}">
                                    @endforeach
                                    <button class="product-details-slide-prev" onclick="productDetailplusDivs(-1)">❮</button>
                                    <button class="product-details-slide-next" onclick="productDetailplusDivs(1)">❯</button>
                                    <div class="product-details-slide-mini-image-container">
                                        <?php $num = 1; ?>
                                        @foreach($urunresimleri as $resim)
                                            <img class="product-details-slide-mini-image"  onclick="productDetailcurrentDiv({{ $num }})" src="{{ $resim['resim'] }}">
                                            <?php $num++; ?>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-sm-5">
                            <div class="product-information"><!--/product-information-->
                                <h2>{{ $urundetay['ad'] }}</h2>
                                <div class="col-md-12">
                                    <p class="product-details-comment-total">{{ __('shopping.yorum') }} ({{(isset($urunyorum))?count($urunyorum):0  }}) | @if(\Illuminate\Support\Facades\Auth::user())<a class="comment-button" data-toggle="modal" data-target="#commentModal">{{ __('shopping.yorumyap') }}</a>@else{{ __('shopping.yorumyap') }}@endif</p>
                                    <fieldset class="rating">
                                        <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" @if(isset($urunpuan) and $urunpuan>9) style="color: #fdaf00;" @endif></label>
                                        <input type="radio" id="star4half" name="rating" value="4 and a half" /><label class="half" for="star4half" @if(isset($urunpuan) and $urunpuan>8) style="color: #fdaf00;" @endif></label>
                                        <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" @if(isset($urunpuan) and $urunpuan>7) style="color: #fdaf00;" @endif></label>
                                        <input type="radio" id="star3half" name="rating" value="3 and a half" /><label class="half" for="star3half" @if(isset($urunpuan) and $urunpuan>6) style="color: #fdaf00;" @endif></label>
                                        <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" @if(isset($urunpuan) and $urunpuan>5) style="color: #fdaf00;" @endif></label>
                                        <input type="radio" id="star2half" name="rating" value="2 and a half" /><label class="half" for="star2half" @if(isset($urunpuan) and $urunpuan>4) style="color: #fdaf00;" @endif></label>
                                        <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" @if(isset($urunpuan) and $urunpuan>3) style="color: #fdaf00;" @endif></label>
                                        <input type="radio" id="star1half" name="rating" value="1 and a half" /><label class="half" for="star1half" @if(isset($urunpuan) and $urunpuan>2) style="color: #fdaf00;" @endif></label>
                                        <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" @if(isset($urunpuan) and $urunpuan>1) style="color: #fdaf00;" @endif></label>
                                        <input type="radio" id="starhalf" name="rating" value="half"/><label class="half" for="starhalf" @if(isset($urunpuan) and $urunpuan>0) style="color: #fdaf00;" @endif></label>
                                    </fieldset>
                                </div>
                                <div class="col-xs-12 text-right">
                                    <span>
                                        <span>@if($urundetay['indirimturu'] != 0){{ number_format($urundetay['indirimlifiyat'], 2) }} @else {{ number_format($urundetay['fiyat'], 2) }} @endif
                                            <i class="fa fa-turkish-lira (alias)"></i>
                                        </span>
                                        @if($urundetay['indirimturu'] != 0)<p class="item-detail-old-price">{{ number_format($urundetay['fiyat'], 2) }} <i class="fa fa-turkish-lira (alias)"></i></p>@endif
                                    </span>
                                </div>

                                <div class="col-md-12 text-right">
                                    @if(\Illuminate\Support\Facades\Auth::user())
                                        <a href="/sepeteekle/{{ $urundetay['id'] }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>{{ __('shopping.sepeteekle') }}</a>
                                    @else
                                        @include('shopping/login-modal')
                                    @endif
                                </div>
                                <br/><br/><br/>
                                <p><b>{{ __('shopping.kargoucreti') }} :</b> @if(isset($urundetay['kargoucret'])) {{ number_format($urundetay['kargoucret'], 2) }} @else {{ number_format(0, 2) }} @endif <i class="fa fa-turkish-lira (alias)"></i></p>
                                <p><b>{{ __('shopping.satici') }} :</b> {{ isset($urundetay['satici'])?$urundetay['satici']:__('shopping.saticibilgilerimevcutdegil') }}</p>
                            </div><!--/product-information-->
                        </div>
                    </div><!--/product-details-->

                    <div class="category-tab shop-details-tab"><!--category-tab-->
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#aciklama" data-toggle="tab">{{ __('shopping.urunaciklamasi') }}</a></li>
                                <li><a href="#yorum" data-toggle="tab">{{ __('shopping.yorumlar') }} ({{(isset($urunyorum))?count($urunyorum):0  }})</a></li>
                                <li><a href="#kosul" data-toggle="tab">{{ __('shopping.iadekosullari') }}</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="aciklama" >
                                <div class="col-sm-12 item-detail-desc-title">
                                    <p>{{ $urundetay['ad'] }}</p>
                                </div>
                                <div class="col-sm-12 item-detail-desc-text">
                                    <p>{{ $urundetay['aciklama'] }}</p>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="yorum" >
                                @if(isset($urunyorum))
                                    @foreach($urunyorum as $yorum)
                                        <div class="row">
                                            <div class="col-sm-2 item-detail-comment-image-container">
                                                <img class="item-detail-comment-image" src="{{ $yorum['resim'] }}">
                                            </div>
                                            <div class="col-sm-10">
                                                <div class="row">
                                                    <div class="col-sm-6 text-left">
                                                        <label class="left">{{ $yorum['yorumyapan'] }}</label>
                                                    </div>
                                                    <div class="col-xs-6 text-right">
                                                        <label class="text-right item-detail-comment-date">{{ $yorum['tarih'] }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 item-comment-star-container">
                                                    <fieldset class="rating">
                                                        <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" @if(isset($yorum['yorum']) and $yorum['puan']>9) style="color: #fdaf00;" @endif></label>
                                                        <input type="radio" id="star4half" name="rating" value="4 and a half" /><label class="half" for="star4half" @if(isset($yorum['yorum']) and $yorum['puan']>8) style="color: #fdaf00;" @endif></label>
                                                        <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" @if(isset($yorum['yorum']) and $yorum['puan']>7) style="color: #fdaf00;" @endif></label>
                                                        <input type="radio" id="star3half" name="rating" value="3 and a half" /><label class="half" for="star3half" @if(isset($yorum['yorum']) and $yorum['puan']>6) style="color: #fdaf00;" @endif></label>
                                                        <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" @if(isset($yorum['yorum']) and $yorum['puan']>5) style="color: #fdaf00;" @endif></label>
                                                        <input type="radio" id="star2half" name="rating" value="2 and a half" /><label class="half" for="star2half" @if(isset($yorum['yorum']) and $yorum['puan']>4) style="color: #fdaf00;" @endif></label>
                                                        <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" @if(isset($yorum['yorum']) and $yorum['puan']>3) style="color: #fdaf00;" @endif></label>
                                                        <input type="radio" id="star1half" name="rating" value="1 and a half" /><label class="half" for="star1half" @if(isset($yorum['yorum']) and $yorum['puan']>2) style="color: #fdaf00;" @endif></label>
                                                        <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" @if(isset($yorum['yorum']) and $yorum['puan']>1) style="color: #fdaf00;" @endif></label>
                                                        <input type="radio" id="starhalf" name="rating" value="half"/><label class="half" for="starhalf" @if(isset($yorum['yorum']) and $yorum['puan']>0) style="color: #fdaf00;" @endif></label>
                                                    </fieldset>
                                                </div>
                                                <div class="row">
                                                    <label class="item-detail-comment-desc">{{ $yorum['yorum'] }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <hr/>
                                    @endforeach
                                @else
                                    <p>{{ __('shopping.yorumyapilmamis') }}</p>
                                @endif
                            </div>

                            <div class="tab-pane fade" id="kosul" >
                            </div>

                        </div>
                    </div><!--/category-tab-->

                    @include('shopping/firsat-urunleri')
                </div>
            @endif

        </div>
    </div>
    <div class="modal" id="commentModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <div class="row comment-modal-head">
                        <div class="col-xs-4 col-sm-2">
                            <img class="comment-modal-image" src="{{ $urundetay['resim'] }}">
                        </div>
                        <div class="col-xs-8 col-sm-10 pull-left">
                            <p>{{ $urundetay['ad'] }}</p>
                        </div>
                    </div>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{ route('yorumyap') }}" method="POST">
                        @csrf
                        <div class="row">
                            <label>{{ __('shopping.uruneoyver') }}</label>
                            <div id="half-stars-example">
                                <div class="rating-group">
                                    <input class="rating__input rating__input--none" checked name="rating2" id="rating-none" value="0" type="radio">
                                    <label aria-label="0 stars" class="rating__label" for="rating-none"><i class="rating__icon rating__icon--none fa fa-ban"></i></label>
                                    <label aria-label="0.5 stars" class="rating__label rating__label--half" for="rating2-05"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                    <input class="rating__input" name="rating2" id="rating2-05" value="1" type="radio">
                                    <label aria-label="1 star" class="rating__label" for="rating2-10"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                    <input class="rating__input" name="rating2" id="rating2-10" value="2" type="radio">
                                    <label aria-label="1.5 stars" class="rating__label rating__label--half" for="rating2-15"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                    <input class="rating__input" name="rating2" id="rating2-15" value="3" type="radio">
                                    <label aria-label="2 stars" class="rating__label" for="rating2-20"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                    <input class="rating__input" name="rating2" id="rating2-20" value="4" type="radio">
                                    <label aria-label="2.5 stars" class="rating__label rating__label--half" for="rating2-25"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                    <input class="rating__input" name="rating2" id="rating2-25" value="5" type="radio">
                                    <label aria-label="3 stars" class="rating__label" for="rating2-30"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                    <input class="rating__input" name="rating2" id="rating2-30" value="6" type="radio">
                                    <label aria-label="3.5 stars" class="rating__label rating__label--half" for="rating2-35"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                    <input class="rating__input" name="rating2" id="rating2-35" value="7" type="radio">
                                    <label aria-label="4 stars" class="rating__label" for="rating2-40"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                    <input class="rating__input" name="rating2" id="rating2-40" value="8" type="radio">
                                    <label aria-label="4.5 stars" class="rating__label rating__label--half" for="rating2-45"><i class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                    <input class="rating__input" name="rating2" id="rating2-45" value="9" type="radio">
                                    <label aria-label="5 stars" class="rating__label" for="rating2-50"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                    <input class="rating__input" name="rating2" id="rating2-50" value="10" type="radio">
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <input hidden name="id" value="{{ $urundetay['id'] }}">
                            <textarea type="text" class="form-control comment-text" name="yorum" maxlength="500" required autocomplete="name" placeholder="{{ __('shopping.yorumunuz') }}"></textarea>
                        </div>
                        <div class="row">
                            <button type="submit" class="btn btn-primary pull-right">{{ __('shopping.gonder') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@include('shopping/footer')

</body>
</html>

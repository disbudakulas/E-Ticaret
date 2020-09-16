<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                        Türkçe
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="">Türkçe</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                        TL
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="">TL</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="@if(isset($header) and isset($header['facebook'])){{ $header['facebook'] }}@endif"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="@if(isset($header) and isset($header['twitter'])){{ $header['twitter'] }}@endif"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="@if(isset($header) and isset($header['youtube'])){{ $header['youtube'] }}@endif"><i class="fa fa-youtube-play"></i></a></li>
                            <li><a href="@if(isset($header) and isset($header['google'])){{ $header['google'] }}@endif"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->
    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-md-8 clearfix">
                    <div class="logo pull-left">
                        <a href="{{ route('index') }}"><img src="@if(isset($header) and isset($header['logo'])){{ $header['logo'] }}@endif" alt="" class="site-logo" /></a>
                    </div>
                    <div class="pull-right" style="margin-top: 5px">
                        <div class="search_box pull-right">
                            <input type="text" oninput="searchProduct(this.value)" id="searchInput" placeholder="Site İçinde Ara"/>
                            <div class="search-item-list-container">
                            </div>
                        </div>
                        <label class="search-close" onclick="searchClose()"></label>
                    </div>
                </div>
                <div class="col-md-4 clearfix" style="margin-top: 10px">
                    <div class="shop-menu clearfix ">
                        @if(\Illuminate\Support\Facades\Auth::user() and isset($header) and $header)
                            <div class="col-xs-8 text-right">
                                <div class="dropdown">
                                    <label class="dropbtn">{{ __('shopping.hesabim') }} <i class="fa fa-chevron-down"></i> </label>
                                    <div class="dropdown-content text-left">
                                        <a href="/hesabim">{{ __('shopping.hesabim') }}</a>
                                        <a href="/siparisler">{{ __('shopping.siparislerim') }}</a>
                                        <a href="/mesajlarim">{{ __('shopping.mesajlarim') }}</a>
                                        <a href="/yorumlarim">{{ __('shopping.yorumlarim') }}</a>
                                        @if($header['satici'])<a href="/satici">{{ __('shopping.magazam') }}</a> @else <a href="/saticiol">{{ __('shopping.saticibasvuru') }}</a> @endif
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            {{ __('shopping.cikisyap') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-2 text-center">
                                <a href="/sepet">
                                    <div class="basket-button-container">
                                        <i class="fa fa-shopping-cart fa-2x basket-button"></i>
                                        <div class="basket-number-container">
                                            <label class="basket-number-text">
                                                @if(isset($header) and isset($header['sepet'])){{ $header['sepet'] }}@else 0 @endif
                                            </label>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xs-2 text-center">
                                <li role="presentation" class="dropdown notification-button">
                                    <a class="dropdown-toggle notification-info-number" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-envelope-o fa-2x"></i>
                                        <span class="notification-number">@if(isset($header['toplambildirim']) and $header['toplambildirim']) {{ $header['toplambildirim'] }} @else 0 @endif</span>
                                    </a>
                                    <div id="menu1" class="dropdown-menu notification-container" role="menu">
                                        @if(isset($header['bildirimler'][0]) and $header['bildirimler'][0])
                                            @foreach($header['bildirimler'] as $key=>$value)
                                                <div class="notification-link-container">
                                                    <a href="/mesajgoruntule?id={{ $value['id'] }}" class="notification-link">
                                                        <div class="notification-title-container">
                                                            <span class="notification-title">@if(mb_strlen($value['title'])<25){{ $value['title'] }}@else {{ substr($value['title'],0,25).'...' }} @endif</span>
                                                            <span class="notification-time">{{ substr($value['created_at'],0,10) }}</span>
                                                        </div>
                                                        <span class="notification-message pull-left">@if(mb_strlen($value['text'])<100){{ $value['text'] }}@else {{ substr($value['text'],0,100).'...' }} @endif</span>
                                                    </a>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="no-notification-link-container">
                                                <p class="no-notification">Okunmamış bildiriminiz mevcut değil.</p>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="text-center">
                                                <a href="{{ route('mesajlarim') }}" class="all-view">
                                                    <strong>{{ __('shopping.tumunugor') }}</strong>
                                                    <i class="fa fa-angle-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </div>
                        @else
                            <div class="col-md-12 text-right">
                                <a class="login-button" href="{{ route('girisyap') }}">
                                   {{ __('shopping.girisyapuyeol') }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div><!--/header-middle-->
    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row site-top-menu-row">
                <div class="col-sm-12">
                    <div class="site-top-menu" id="site-top-menu">
                        @if(isset($kategoriler))
                            @foreach($kategoriler['ust'] as $kategori=>$value)
                                <div class="site-top-subnav">
                                    <button class="site-top-subnavbtn"><a class="site-top-subnavbtn-url">{{ $value['ad'] }}</a></button></a>
                                    @if(isset($kategoriler[$kategori]))
                                        <div class="site-top-dropdown-content">
                                            <div class="row all-view"><label><a href="/urunliste?kategori={{ $value['id'] }}">{{ __('shopping.tumunugor') }}</a></label></div>
                                            <hr class="category-bar"/>
                                            @foreach($kategoriler[$kategori] as $menu)
                                                <a class="site-top-dropdown-url" href="/urunliste?kategori={{ $menu['id'] }}">{{ $menu['ad'] }}</a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @endif
                        <a href="javascript:void(0);" style="font-size: 25px;color: #FE980F;" class="site-top-menu-icon" onclick="siteTopMenu()">&#9776;</a>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->
<script>
    function searchClose() {
        $("div[class='search-item-list-container']").css("display","none");
        $("label[class='search-close']").css("display","none");
        $('#searchInput').val(null);
    }
    function searchProduct(val) {
        $("div[class='search-item-list-container']").css("display","inline");
        $("label[class='search-close']").css("display","inline");
        if(val === ''){
            $("div[class='search-item-list-container']").css("display","none");
            $("label[class='search-close']").css("display","none");
        }
        $.ajax({
            type: "GET",
            url: '/urunara/'+val,
            dataType : 'Json',
            success: function (data) {
                $("div[name='search-item-row']").remove();
                if(data[0]){
                    $.each(data,function (item) {
                        var name = data[item]['productName'];
                        if(data[item]['productName'].length > 20){
                            var name = data[item]['productName'].substring(0,19)+'...';
                        }
                        if(data[item]['productCatalog']){
                            $("div[class='search-item-list-container']").append(
                                '<a href="/urundetay?urun='+data[item]['productId']+'" title="'+data[item]['productName']+'"><div class="row search-item-row" name="search-item-row"><img class="search-item-img" src="/storage/uploads/products/picturecrop/'+data[item]['productSeller']+'/'+data[item]['productCatalog']+'">' +
                                '<label class="search-item-name" style="font-weight: 400;">'+name+'</label></div></a>'
                            );
                        }else{
                            $("div[class='search-item-list-container']").append(
                                '<a href="/urundetay?urun='+data[item]['productId']+'" title="'+data[item]['productName']+'"><div class="row search-item-row" name="search-item-row"><img class="search-item-img" src="/storage/uploads/products/picture/no-image.png">' +
                                '<label class="search-item-name" style="font-weight: 400;">'+name+'</label></div></a>'
                            );
                        }

                    });
                }else{
                    $("div[class='search-item-list-container']").append(
                        '<div class="row" name="search-item-row"><label class="non-product">{{ __('shopping.urunbulunamadi') }}</label></div>'
                    );
                }

            },
        });
    }
</script>

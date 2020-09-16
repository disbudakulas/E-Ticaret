<div class="table-responsive cart_info">
    <div class="row">
        <div class="col-xs-12 account-name">
            {{ \Illuminate\Support\Facades\Auth::user()->name.' '.\Illuminate\Support\Facades\Auth::user()->surname }}
        </div>
    </div>
    <hr class="basket-item-bar"/>
    <div class="tab-menu-list-container">
        <div class="row">
            <p><a href="/hesabim" class="tab-menu-list-item">{{ __('shopping.hesabim') }}</a></p>
            <p><a href="/siparisler" class="tab-menu-list-item">{{ __('shopping.siparisler') }}</a></p>
            <p><a href="/yorumlarim" class="tab-menu-list-item">{{ __('shopping.yorumlarim') }}</a></p>
            <p><a href="/mesajlarim" class="tab-menu-list-item">{{ __('shopping.mesajlarim') }}</a></p>
            <hr class="tab-menu-list-bar"/>
            @if(!$header['satici'])
                <p><a href="/saticiol" class="tab-menu-list-item">{{ __('shopping.saticibasvuru') }}</a></p>
            @else
                <p><a href="/satici" class="tab-menu-list-item">{{ __('shopping.magazam') }}</a></p>
            @endif
            <p><a href="/basvurularim" class="tab-menu-list-item">{{ __('shopping.basvurularim') }}</a></p>
            <hr class="tab-menu-list-bar"/>
            <p><a href="" class="tab-menu-list-item">{{ __('shopping.uruniade') }}</a></p>
            <p><a href="" class="tab-menu-list-item">{{ __('shopping.bizesorun') }}</a></p>
        </div>
    </div>
    <div class="row">
    </div>
</div>

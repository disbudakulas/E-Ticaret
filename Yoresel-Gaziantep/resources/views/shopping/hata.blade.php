<!DOCTYPE html>
<html lang="en">
@include('shopping/head')
<body>
@include('shopping/header')
<section id="cart_items">
    <div class="container">
        <div class="col-lg-12 col-md-12">
            <div class="table-responsive cart_info">
                <div class="row">
                    <div class="col-xs-12 basket-title">
                        {{ __('shopping.hata') }}
                    </div>
                    <hr class="basket-item-bar"/>
                    <div class="row">
                        <p style="font-size: 15px">{{ __('hata.'.$hatatur) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> <!--/#cart_items-->
@include('shopping/footer')
</body>
</html>

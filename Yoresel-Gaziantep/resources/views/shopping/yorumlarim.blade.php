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
                    Bu Sayfa Şuanda Bakımdadır.
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

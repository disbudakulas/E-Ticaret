<!DOCTYPE html>
<html lang="en">
@include('shopping/head')
<link href="{{asset('/adminmaterial/vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
<body>
@include('shopping/header')
<section id="cart_items">
    <div class="container container-full">
        <div class="col-sm-3 col-xs-12">
            @include('shopping/account-menu')
        </div>
        <div class="col-sm-9 col-xs-12">
            <div class="table-responsive cart_info">
                <div class="row site-form" style="margin-top: 10px;margin-bottom: 10px;">
                    @if(isset($mesaj) and $mesaj)
                        <div class="row">
                            <a href="{{ route('mesajlarim') }}"><label class="message-back"><i class="fa fa-chevron-left"> {{ __('shopping.mesajlarim') }}</i></label></a>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="single_field">
                                    <label class="list-label">{{ __('shopping.konu') }}:</label>
                                    <label class="message-time">{{ substr($mesaj['created_at'],0,10) }}</label>
                                    <label type="text" class="list-control message-title" style="">{{ $mesaj['title'] }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="single_field">
                                    <label class="list-label">{{ __('shopping.mesaj') }}:</label>
                                    <label type="text" class="list-control message-text" style="">{{ $mesaj['text'] }}</label>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="single_field">
                                    <label type="text" class="list-control message-list" style="">{{ __('shopping.icerikbulunamadi') }}</label>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section> <!--/#cart_items-->
@include('shopping/footer')
<script src="{{asset('adminmaterial/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $(":input").inputmask();
    });
</script>
</body>
</html>

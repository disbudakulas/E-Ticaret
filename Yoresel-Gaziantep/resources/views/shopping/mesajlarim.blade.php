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
                <div class="row site-form" style="margin-top: 10px">
                    @if(isset($mesajlar) and $mesajlar)
                        @foreach($mesajlar as $mesaj)
                            <div class="row">
                                <a href="/mesajgoruntule?id={{ $mesaj['id'] }}">
                                    <div class="col-xs-12">
                                        <div class="single_field">
                                            <label type="text" class="list-control message-list" style="">{{ $mesaj['title'] }}</label>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <hr class="message-list-bar"/>
                        @endforeach
                    @else
                        <p>{{ __('shopping.mesajbulunamadi') }}</p>
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

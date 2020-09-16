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
                    @if(isset($basvurular) and $basvurular)
                        @foreach($basvurular as $basvuru)
                            <div class="row">
                                <div class="col-xs-12 col-sm-3">
                                    <div class="single_field">
                                        <label class="list-label">{{ __('shopping.basvuruno') }}:</label>
                                        <label type="text" class="list-control" style="font-weight: 400;height: 25px;font-size: 12px;">{{ $basvuru->id }}</label>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-3">
                                    <div class="single_field">
                                        <label class="list-label">{{ __('shopping.unvan') }}:</label>
                                        <label type="text" class="list-control" style="font-weight: 400;height: 25px;font-size: 12px;">{{ $basvuru->sellerName }}</label>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-3">
                                    <div class="single_field">
                                        <label class="list-label">{{ __('shopping.basvurutarihi') }}:</label>
                                        <label type="text" class="list-control" style="font-weight: 400;height: 25px;font-size: 12px;">{{ $basvuru->created_at }}</label>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-3">
                                    <div class="single_field">
                                        <label class="list-label">{{ __('shopping.durum') }}:</label>
                                        <label type="text" class="list-control" style="font-weight: 400;height: 25px;font-size: 12px;">{{ __('tanimlar.saticibasvuru.'.$basvuru->status) }}</label>
                                    </div>
                                </div>
                            </div>
                            <hr class="apply-list-bar"/>
                        @endforeach
                    @else
                        <p>{{ __('shopping.basvurubulunamadi') }}</p>
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

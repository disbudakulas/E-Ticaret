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
                @if(isset($hesap) and $hesap)
                    <div class="row">
                        <div class="col-xs-12 mail-container">
                            <label class="pull-right" title="{{ __('shopping.maildegisiklik') }}">{{ $hesap['mail'] }}</label>
                        </div>
                        <div class="col-xs-12">
                            <img class="account-image" src="{{ $hesap['resim'] }}">
                        </div>
                    </div>
                    <hr class="basket-item-bar"/>
                    <div class="row site-form">
                        <form method="POST" action="{{ route('hesapkaydet') }}" class="form-horizontal form-label-left">
                            @csrf
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('shopping.ad') }}<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="ad" type="text" id="first-name" required="required"  maxlength="25" class="form-control col-md-7 col-xs-12" value="{{ $hesap['ad'] }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sur-name">{{ __('shopping.sad') }}<span class="required" value="{{ $hesap['sad'] }}">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="sad" type="text" id="sur-name" required="required"  maxlength="25" class="form-control col-md-7 col-xs-12" value="{{ $hesap['sad'] }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gender">{{ __('shopping.cinsiyet') }}:</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="cinsiyet" class="select2_single form-control"  id="gender" tabindex="-1" onchange="countSelection(this.value)">
                                        <option></option>
                                        <option value="0" @if($hesap['cinsiyet'] == "0") selected @endif>{{ __('kullanicilar.kadin') }}</option>
                                        <option value="1" @if($hesap['cinsiyet'] == "1") selected @endif>{{ __('kullanicilar.erkek') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tc">{{ __('shopping.tc') }}
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="tc" type="text" id="tc"  maxlength="11" class="form-control col-md-7 col-xs-12" value="{{ $hesap['tc'] }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tel">{{ __('shopping.tel') }}
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="tel" type="text" id="tel" class="form-control col-md-7 col-xs-12" data-inputmask="'mask' : '0 (999) 999-9999'" value="{{ $hesap['tel'] }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gsm">{{ __('shopping.gsm') }}
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="gsm" type="text" id="gsm" class="form-control col-md-7 col-xs-12" data-inputmask="'mask' : '0 (999) 999-9999'" value="{{ $hesap['gsm'] }}">
                                </div>
                            </div>
                            <div class="row">
                                <button type="submit" class="btn btn-primary pull-right">{{ __('shopping.kaydet') }}</button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section> <!--/#cart_items-->
@include('shopping/footer')
<script src="{{asset('adminmaterial/vendors/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('adminmaterial/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $(":input").inputmask();
    });
</script>
<script>
    $(document).ready(function() {
        $(".select2_single").select2({
            placeholder: "{{ __('shopping.belirtilmedi') }}",
            allowClear: true
        });
    });
</script>
</body>
</html>

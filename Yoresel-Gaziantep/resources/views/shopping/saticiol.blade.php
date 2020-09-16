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
                    <form method="POST" action="{{ route('saticibasvuru') }}" class="form-horizontal form-label-left">
                        @csrf
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="saticiunvan">{{ __('shopping.saticiunvan') }}<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input name="saticiunvan" type="text" id="saticiunvan" required="required"  maxlength="25" class="form-control col-md-7 col-xs-12" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vergidairesi">{{ __('shopping.vergidairesi') }}<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input name="vergidairesi" type="text" id="vergidairesi" required="required"  maxlength="25" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vergino">{{ __('shopping.vergino') }}<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input name="vergino" type="text" id="vergino" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hesapsahibi">{{ __('shopping.hesapsahibi') }}<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input name="hesapsahibi" type="text" id="hesapsahibi" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hesapno">{{ __('shopping.hesapno') }}<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input name="hesapno" type="text" id="hesapno" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="row">
                            @if($durum != 3)
                                <button type="submit" class="btn btn-primary pull-right">{{ __('shopping.basvur') }}</button>
                            @else
                                <p class="pull-right">{{ __('shopping.saticibekleme') }}</p>
                            @endif
                        </div>
                    </form>
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

<!DOCTYPE html>
<html lang="en">
@include('/admin/production/head')
<link href="{{asset('adminmaterial/vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet">
<link href="{{asset('adminmaterial/build/css/custom.min.css')}}" rel="stylesheet">
<body class="nav-md">
<div class="container body">
    <div class="main_container">
    @include('/admin/production/sidebar')

    <!-- top navigation -->
    @include('/admin/production/navbar')
    <!-- /top navigation -->

        <!-- page content -->
        <div class="left_col" role="main">
            <div class="row">
                <!-- page content -->
                <div class="right_col" >
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>{{ __('urunler.saticiurunusec') }}</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <br />
                                <form action="{{ route('urunyorumlari') }}" method="GET" class="form-horizontal form-label-left">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="satici">{{ __('urunler.satici') }} <span class="required">*</span>
                                                </label>
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <select name="satici" class="select2_single form-control" id="satici" tabindex="-1" required="required" onchange="sellerSelect(this)">
                                                        <option></option>
                                                        @foreach($saticilar as $satici)
                                                            <option value="{{ $satici['sellerId'] }}" @if(($satici['sellerId'] ?? 0) == ($icerik->productSeller ?? -1)) selected @endif>{{ $satici['sellerName'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="urun">{{ __('urunler.urun') }} <span class="required">*</span>
                                                </label>
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <select name="urun" class="select2_single form-control" id="urun" tabindex="-1" required="required">
                                                        <option></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-12 text-right">
                                                <button type="submit" class="btn btn-success">{{ __('urunler.yorumlarigor') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
    @include('/admin/production/footer')
    <!-- /footer content -->
    </div>
</div>
<script src="{{asset('adminmaterial/vendors/select2/dist/js/select2.full.min.js')}}"></script>
<script>
    function sellerSelect(val){
        $("option[name='urunler']").remove();
        $.ajax({
            type: "GET",
            url: '/saticiurunler/'+val.value,
            dataType : 'Json',
            success: function (data) {
                $.each(data,function (urun) {
                    $('#urun').append('<option name="urunler" value="'+data[urun]['productId']+'">'+data[urun]['productId']+')  '+data[urun]['productName']+'</option>');
                });
            },
        });
    }
</script>
<!-- Select2 -->
<script>
    $(document).ready(function() {
        $(".select2_single").select2({
            placeholder: "{{ __('siteaciklama.secilmedi') }}",
            allowClear: true
        });
    });
</script>
<!-- /Select2 -->
</body>
</html>

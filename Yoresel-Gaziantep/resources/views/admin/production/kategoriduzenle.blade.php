<!DOCTYPE html>
<html lang="en">
@include('/admin/production/head')
<link href="{{asset('adminmaterial/vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet">

<body class="nav-md">
<div class="container body">
    <div class="main_container">
    @include('admin/production/sidebar')

    <!-- top navigation -->
    @include('admin/production/navbar')
    <!-- /top navigation -->

        <!-- page content -->
        <div class="left_col" role="main">
            <div class="row">
                <!-- page content -->
                <div class="right_col" >
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="x_panel">
                                            <div class="x_title">
                                                <h2>{{ __('kategoriler.kategoriduzenle') }}</h2>
                                                <ul class="nav navbar-right panel_toolbox">
                                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                    </li>
                                                </ul>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content">
                                                <br />
                                                <form action="{{ route('kategoriekle') }}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                    @csrf
                                                    <input type="text" name="id" value="{{ $icerik['id'] ?? null }}" hidden>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('kategoriler.kategoriadi') }}<span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <input name="ad" type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="{{ $icerik['ad'] ?? null }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">{{ __('kategoriler.ustkategori') }}</label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <select name="ust" class="select2_single form-control" tabindex="-1">
                                                                <option></option>
                                                                @foreach($ustkategoriler as $ustkategori)
                                                                    <option value="{{ $ustkategori['categoryId'] }}" @if($ustkategori['categoryId']==($icerik[0]['ust']??0)) selected @endif>{{ $ustkategori['categoryName'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">{{ __('kategoriler.aciklama') }}</label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" name="aciklama" value="{{ $icerik['aciklama'] ?? null }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ __('kategoriler.ikon') }}
                                                        </label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <input name="ikon" id="birthday" class="date-picker form-control col-md-7 col-xs-12" type="text" value="{{ $icerik['ikon'] ?? null }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ __('kategoriler.durum') }}<span class="required">*</span></label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <div id="durum" name="durum" class="btn-group" data-toggle="buttons">
                                                                <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                                    <input type="radio" name="durum" value="1" checked> &nbsp;{{ __('kategoriler.aktif') }}&nbsp;
                                                                </label>
                                                                <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                                    <input type="radio" name="durum" value="0"> {{ __('kategoriler.pasif') }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ln_solid"></div>
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                            <a href="{{ route('kategoriler') }}" class="btn btn-primary">{{ __('kategoriler.iptal') }}</a>
                                                            <button type="submit" class="btn btn-success">{{ __('kategoriler.gonder') }}</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
    @include('admin/production/footer')
    <!-- /footer content -->
    </div>
</div>
<script src="{{asset('adminmaterial/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('adminmaterial/vendors/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('adminmaterial/vendors/moment/min/moment.min.js')}}"></script>
<script src="{{asset('adminmaterial/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('adminmaterial/vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{asset('adminmaterial/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js')}}"></script>
<script src="{{asset('adminmaterial/vendors/select2/dist/js/select2.full.min.js')}}"></script>
<!-- Select2 -->
<script>
    $(document).ready(function() {
        $(".select2_single").select2({
            placeholder: "{{ __('siteaciklama.secilmedi') }}",
            allowClear: true
        });
        $(".select2_group").select2({});
        $(".select2_multiple").select2({
            maximumSelectionLength: 4,
            placeholder: "With Max Selection limit 4",
            allowClear: true
        });
    });
</script>
<!-- /Select2 -->
</body>
</html>

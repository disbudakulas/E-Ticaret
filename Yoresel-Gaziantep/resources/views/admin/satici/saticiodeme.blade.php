<!DOCTYPE html>
<html lang="en">
@include('/admin/satici/head')
<link href="{{asset('adminmaterial/vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet">

<body class="nav-md">
<div class="container body">
    <div class="main_container">
    @include('admin/satici/sidebar')

    <!-- top navigation -->
    @include('admin/satici/navbar')
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
                                                <h2><i class="fa fa-info-circle"></i> {{ __('saticihesap.saticibilgileri') }}</h2>
                                                <ul class="nav navbar-right panel_toolbox">
                                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                    </li>
                                                </ul>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content">
                                                <br />
                                                <form action="{{ route('saticiodemekaydet') }}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                    @csrf
                                                    <input type="text" name="id" value="{{ $icerik[0]['settingId'] ?? null }}" hidden>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('saticihesap.saticiunvani') }}
                                                        </label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <input name="unvan" type="text" id="first-name" class="form-control col-md-7 col-xs-12" value="{{ $icerik['sellerName'] ?? null }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">{{ __('saticihesap.vergidairesi') }}</label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <input id="middle-name" class="form-control col-md-7 col-xs-12" type="text" name="vergidairesi" value="{{ $icerik['taxOffice'] ?? null }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ __('saticihesap.verginumarasi') }}
                                                        </label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <input name="verginumarasi" id="birthday" class="date-picker form-control col-md-7 col-xs-12" type="text" value="{{ $icerik['taxNumber'] ?? null }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ __('saticihesap.hesapsahibi') }}
                                                        </label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <input name="hesapsahibi" id="birthday" placeholder="Ad Soyad" class="date-picker form-control col-md-7 col-xs-12" type="text" value="{{ $icerik['accountName'] ?? null }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ __('saticihesap.hesapno') }}
                                                        </label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <input name="hesapno" type="text" class="form-control" value="{{ $icerik['accountNumber'] }}">
                                                        </div>
                                                    </div>
                                                    <div class="ln_solid"></div>
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                            <button type="submit" class="btn btn-success">{{ __('saticihesap.degisikliktalebi') }}</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            @if($icerik2)
                                                <div class="x_content">
                                                    <div class="col-md-3 col-sm-3 col-xs-12"></div>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                                            <thead>
                                                            <tr>
                                                                <th class="column1" colspan="2">{{ __('saticihesap.bekleyendegisiklik') }}</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr><td class="column1">{{ __('saticihesap.saticiunvani') }}</td><td class="column2">{{ $icerik2['sellerName'] ?? null }}</td></tr>
                                                            <tr><td class="column1">{{ __('saticihesap.vergidairesi') }}</td><td class="column2">{{ $icerik2['taxOffice'] ?? null }}</td></tr>
                                                            <tr><td class="column1">{{ __('saticihesap.verginumarasi') }}</td><td class="column2">{{ $icerik2['taxNumber'] ?? null }}</td></tr>
                                                            <tr><td class="column1">{{ __('saticihesap.hesapsahibi') }}</td><td class="column2">{{ $icerik2['accountName'] ?? null }}</td></tr>
                                                            <tr><td class="column1">{{ __('saticihesap.hesapno') }}</td><td class="column2">{{ $icerik2['accountNumber'] }}</td></tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-xs-12"></div>
                                                </div>
                                            @endif
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
    @include('admin/satici/footer')
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

<script>
    var sel1 = document.querySelector('#sehir');
    var sel2 = document.querySelector('#ilce');
    var options2 = sel2.querySelectorAll('option');
    var pointer = 0;
    var selectedIndex = 0;

    function giveSelection(selValue) {
        sel2.innerHTML = '';
        for (var i = 0; i < options2.length; i++) {
            if (options2[i].dataset.option === selValue) {
                sel2.appendChild(options2[i]);
            }
        }
        if(selValue === "{{ $icerik[0]['settingCity']??null }}"){
            document.getElementById("{{ $icerik[0]['settingDistrict']??null }}").selected="true";
        }
    }
    giveSelection(sel1.value);
</script>

<script>
    $(document).ready(function() {
        $(":input").inputmask();
    });
</script>

</body>
</html>

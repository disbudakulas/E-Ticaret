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
                                    <div class="page-title">
                                        <div class="title_left">
                                            <h3><i class="fa fa-info-circle"></i> {{ __('saticihesap.saticibilgileri') }}</h3>
                                        </div>
                                        <div class="title_right">
                                            @if($errors->any())
                                                <h5 style="color: #f32013;">{{$errors->first()}}</h5>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="x_panel">
                                            <div class="x_content">
                                                <br />
                                                <form action="{{ route('saticihesapkaydet') }}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ __('siteaciklama.sehir') }}</label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <select name="sehir" class="select2_single form-control" id="sehir" tabindex="-1" onchange="giveSelection(this.value)">
                                                                <option></option>
                                                                @foreach($iller as $il)
                                                                    <option value="{{ $il['cityId'] }}" @if($il['cityId']==($icerik['city']??0)) selected @endif>{{ $il['name'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ __('siteaciklama.ilce') }}</label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <select name="ilce" class="select2_single form-control" id="ilce" tabindex="-1">
                                                                <option></option>
                                                                @foreach($ilceler as $ilce)
                                                                    <option data-option="{{ $ilce['cityId'] }}" id="{{ $ilce['districtId'] }}" value="{{ $ilce['districtId'] }}" @if($ilce['districtId']==($icerik['district']??0)) selected @endif>{{ $ilce['name'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ __('siteaciklama.adres') }}
                                                        </label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <textarea name="adres" id="birthday" class="date-picker form-control col-md-7 col-xs-12" type="text" >{{ $icerik['residing'] ?? null }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ __('siteaciklama.tel') }}
                                                        </label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <input name="tel" type="text" class="form-control" data-inputmask="'mask' : '0 (999) 999-9999'" value="{{ $icerik['tel'] ?? null }}">
                                                            <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ __('siteaciklama.gsm') }}
                                                        </label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <input name="gsm"  type="text" class="form-control" data-inputmask="'mask' : '0 (999) 999-9999'" value="{{ $icerik['gsm'] ?? null }}">
                                                            <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ __('siteaciklama.faks') }}
                                                        </label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <input name="faks"  type="text" class="form-control" data-inputmask="'mask' : '0 (999) 999-9999'" value="{{ $icerik['faks'] ?? null }}">
                                                            <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" autocomplete="email">{{ __('siteaciklama.mail') }} <span class="required">*</span></label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <input name="mail" type="email" id="birthday" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" value="{{ $icerik['mail'] ?? null }}">
                                                            <span class="fa fa-envelope-o form-control-feedback right" aria-hidden="true"></span>
                                                        </div>
                                                    </div>

                                                    <div class="ln_solid"></div>
                                                    <div class="form-group">
                                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                            <button type="submit" class="btn btn-success">{{ __('siteaciklama.gonder') }}</button>
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

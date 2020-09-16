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
                                                <h2><i class="fa fa-info-circle"></i> {{ __('siteaciklama.sitebilgileri') }}</h2>
                                                <ul class="nav navbar-right panel_toolbox">
                                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                    </li>
                                                </ul>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content">
                                                <br />
                                                <p class="text-center">{{ __('siteaciklama.ucretlendirmeuyari') }}</p>
                                                <form action="{{ route('ucretlendirmekaydet') }}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                                    @csrf
                                                    <input type="text" name="id" value="{{ $icerik[0]['settingId'] ?? null }}" hidden>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kdv">{{ __('siteaciklama.kdvorani') }}
                                                        </label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <input name="kdv" type="number" id="kdv" class="form-control col-md-7 col-xs-12" oninput="valueControl(this)" value="{{ isset($kdv)?$kdv:null }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="middle-namekomisyon" class="control-label col-md-3 col-sm-3 col-xs-12">{{ __('siteaciklama.komisyonorani') }}</label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <input id="komisyon" class="form-control col-md-7 col-xs-12" type="number" name="komisyon" oninput="valueControl(this)" value="{{ isset($komisyon)?$komisyon:null }}">
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
    @include('admin/production/footer')
    <!-- /footer content -->
    </div>
</div>
<!-- Select2 -->
</body>
<script>
    function valueControl(val) {
        var value = parseInt(val.value);
        var name = val.name;
        if(value < 0){
            $('#'+name).val(0);
        }else if(value > 100){
            $('#'+name).val(100);
        }else{
            $('#'+name).val(value);
        }
    }
</script>
</html>

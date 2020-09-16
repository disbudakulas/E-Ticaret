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
                                <h2>{{ __('indirimliurunler.indirimliurunduzenle') }}</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <form action="{{ route('indirimliurunekle') }}" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                @csrf
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ __('indirimliurunler.urun') }} <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select name="urun" class="select2_single form-control" tabindex="-1" required="required">
                                                <option></option>
                                                @foreach($urunler as $urun)
                                                    <option value="{{ $urun['id'] }}">{{ $urun['ad'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('indirimliurunler.indirimturu') }} <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select name="indirimturu" class="select2_single form-control" id="durum" tabindex="-1" required="required">
                                                <option></option>
                                                <option value="1"  selected>{{ __('tanimlar.indirimturu.1') }}</option>
                                                <option value="2" @if(($urun['indirimturu'] ?? 55) == 2) selected @endif>{{ __('tanimlar.indirimturu.2') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('indirimliurunler.indirim') }} <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input name="indirim" type="number" id="first-name" class="form-control col-md-7 col-xs-12" required="required" min="1" value="{{ $urun['indirim'] ?? null }}">
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <button type="submit" class="btn btn-success">{{ __('indirimliurunler.gonder') }}</button>
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
        @include('admin/production/footer')
        <!-- /footer content -->
      </div>
    </div>
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

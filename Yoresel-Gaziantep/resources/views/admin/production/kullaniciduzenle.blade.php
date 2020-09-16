<!DOCTYPE html>
<html lang="en">
@include('/admin/production/head')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
<link href="{{asset('adminmaterial/vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet">
<link href="{{asset('adminmaterial/vendors/cropper/dist/cropper.min.css')}}" rel="stylesheet">
<link href="{{asset('adminmaterial/build/css/custom.min.css')}}" rel="stylesheet">
<link href="{{asset('adminmaterial/build/css/custom.min.css')}}" rel="stylesheet">

<body class="nav-md">
<div class="container body">
    <div class="main_container">
    @include('admin/production/sidebar')

    <!-- top navigation -->
    @include('admin/production/navbar')
    <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">
                <div class="page-title">
                    <div class="title_left">
                        <h3>{{ __('kullanicilar.kullaniciduzenle') }}</h3>
                    </div>
                    <div class="title_right">
                        @if($errors->any())
                            <h5 style="color: #f32013;">{{$errors->first()}}</h5>
                        @endif
                    </div>
                </div>
                <div class="clearfix"></div>
                <form action="{{ route('kullaniciekle') }}" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                    @csrf
                    <input type="text" name="id" value="{{ $icerik['id'] ?? null }}" hidden>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>{{ __('kullanicilar.profilfotografi') }}</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <br />
                                    <div class="row text-center">
                                        <label class="border-profile-img" id="img-canvas">
                                            <img id="profile-img" src="{{ ($icerik['resim']??null)?$icerik['resim']:'storage/uploads/users/profileimage/no-Image.jpg' }}" style="width: 250px;height: 250px;">
                                        </label>
                                    </div>
                                    <div class="row text-center">
                                        <button id="modalbutton" type="button" class="btn btn-primary" data-toggle="modal" data-target="#getCroppedCanvasModal"><i class="fa fa-upload"></i> {{ __('kullanicilar.resimyukle') }}</button>
                                        <button type="button" class="btn btn-default" id="cancel-img" style="display: none;"><i class="fa fa-close"></i> {{ __('kullanicilar.kaldir') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="getCroppedCanvasTitle">{{ __('kullanicilar.resimduzenle') }}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                                                <input type="file" class="sr-only" id="inputImage" name="logo" accept="image/*">
                                                <span class="docs-tooltip" data-toggle="tooltip">
                                                <span class="fa fa-picture-o"></span> {{  __('kullanicilar.resimsec') }}
                                            </span>
                                            </label>
                                        </div>
                                        <div class="row">
                                            <div class="container cropper col-md-12" id="img-container-visible" style="display: none;">
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <div class="img-container">
                                                            <img id="picture" hidden>
                                                            <img id="image" src="" alt="Picture">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="docs-preview clearfix">
                                                            <div class="img-preview preview-lg"></div>
                                                        </div>
                                                        <div class="docs-data">
                                                            <div class="input-group input-group-sm">
                                                                <label class="input-group-addon" for="dataX">X</label>
                                                                <input name="x" type="text" class="form-control" id="dataX" placeholder="x">
                                                                <span class="input-group-addon">px</span>
                                                            </div>
                                                            <div class="input-group input-group-sm">
                                                                <label class="input-group-addon" for="dataY">Y</label>
                                                                <input name="y" type="text" class="form-control" id="dataY" placeholder="y">
                                                                <span class="input-group-addon">px</span>
                                                            </div>
                                                            <div class="input-group input-group-sm">
                                                                <label class="input-group-addon" for="dataWidth">Width</label>
                                                                <input name="w" type="text" class="form-control" id="dataWidth" placeholder="width">
                                                                <span class="input-group-addon">px</span>
                                                            </div>
                                                            <div class="input-group input-group-sm">
                                                                <label class="input-group-addon" for="dataHeight">Height</label>
                                                                <input name="h" type="text" class="form-control" id="dataHeight" placeholder="height">
                                                                <span class="input-group-addon">px</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="docs-buttons">
                                            <button type="button" id="modalClose" class="btn btn-default" data-dismiss="modal">{{ __('kullanicilar.kapat') }}</button>
                                            <button type="button" id="modalOkay" class="btn btn-primary"  data-method="getCroppedCanvas" data-option="{ &quot;width&quot;: 250, &quot;height&quot;: 250 }">{{ __('kullanicilar.onayla') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>{{ __('kullanicilar.genelbilgiler') }}</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <br />
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('kullanicilar.adi') }}<span class="required">*</span>
                                        </label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input name="ad" type="text" id="first-name" required="required"  maxlength="25" class="form-control col-md-7 col-xs-12" value="{{ $icerik['ad'] ?? null }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('kullanicilar.soyadi') }}</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input name="sad" type="text" id="first-name" class="form-control col-md-7 col-xs-12"  maxlength="16" value="{{ $icerik['sad'] ?? null }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('kullanicilar.tc') }}</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input name="tc" type="text" id="first-name" class="form-control col-md-7 col-xs-12" data-inputmask="'mask': '99999999999'" maxlength="11" value="{{ $icerik['tc'] ?? null }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('kullanicilar.cinsiyet') }}</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <select name="cinsiyet" class="select2_single form-control" id="cinsiyet" tabindex="-1">
                                                <option></option>
                                                    <option value="0">{{ __('kullanicilar.kadin') }}</option>
                                                    <option value="1">{{ __('kullanicilar.erkek') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('kullanicilar.dogumtarihi') }}</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input name="dogumtarihi" type="text" class="form-control" data-inputmask="'mask': '99/99/9999'" value="{{ $icerik['dogumtarihi'] ?? null }}">
                                            <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('kullanicilar.bakiye') }}</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input name="bakiye" type="text" id="first-name" class="money form-control col-md-7 col-xs-12" value="{{ number_format($icerik['bakiye'] ?? 0, 2) }}">
                                            <span class="fa fa-turkish-lira (alias) form-control-feedback right" aria-hidden="true"></span>
                                            <script>
                                                $('.money').mask("#,##0.00", {reverse: true});
                                            </script>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('kullanicilar.durum') }} <span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <select name="durum" class="select2_single form-control" id="durum" tabindex="-1" required="required">
                                                <option></option>
                                                <option value="0" selected>{{ __('tanimlar.engel.0') }}</option>
                                                <option value="1" @if(($icerik['durum'] ?? 0) == 1) selected @endif>{{ __('tanimlar.engel.1') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('kullanicilar.yetki') }} <span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <select name="yetki" class="select2_single form-control" required="required" id="yetki" tabindex="-1">
                                                <option></option>
                                                <option value="5" selected>{{ __('tanimlar.yetki.5') }}</option>
                                                <option value="4" disabled @if(($icerik['yetki'] ?? 0) == 4) selected @endif>{{ __('tanimlar.yetki.4') }}</option>
                                                <option value="3"  @if(($icerik['yetki'] ?? 0) == 3) selected @endif>{{ __('tanimlar.yetki.3') }}</option>
                                                <option value="2"  @if(($icerik['yetki'] ?? 0) == 2) selected @endif>{{ __('tanimlar.yetki.2') }}</option>
                                                <option value="1"  @if(($icerik['yetki'] ?? 0) == 1) selected @endif>{{ __('tanimlar.yetki.1') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"></label>
                                        <div class="checkbox col-md-9 col-sm-9 col-xs-12">
                                            <label>
                                                <input name="kampanyabilgi" type="checkbox" @if(($icerik['kampanyabilgi'] ?? 0)==1) checked @endif> {{ __('kullanicilar.kampanya') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>{{ __('kullanicilar.hesapiletisimbilgileri') }}</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <br />
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('kullanicilar.gsm') }}</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input name="gsm"  type="text" class="form-control" data-inputmask="'mask' : '0 (999) 999-9999'" value="{{ $icerik['gsm'] ?? null }}">
                                            <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" autocomplete="email">{{ __('kullanicilar.mail') }} <span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input name="mail" type="email" id="birthday" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" value="{{ $icerik['mail'] ?? null }}">
                                            <span class="fa fa-envelope-o form-control-feedback right" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                    @if(!($icerik['id']??null))
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('kullanicilar.sifre') }} <span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input name="sifre" type="password" id="birthday" maxlength="16" minlength="8" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" value="">
                                            <span class="fa fa-lock form-control-feedback right" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>{{ __('kullanicilar.adresbilgileri') }}</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <br />
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ __('kullanicilar.sehir') }}</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <select name="sehir" class="select2_single form-control" id="sehir" tabindex="-1" onchange="giveSelection(this.value)">
                                                <option></option>
                                                @foreach($iller as $il)
                                                    <option value="{{ $il['cityId'] }}" @if($il['cityId']==($icerik['sehir']??0)) selected @endif>{{ $il['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">{{ __('kullanicilar.ilce') }}</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <select name="ilce" class="select2_single form-control" id="ilce" tabindex="-1">
                                                <option></option>
                                                @foreach($ilceler as $ilce)
                                                    <option data-option="{{ $ilce['cityId'] }}" id="{{ $ilce['districtId'] }}" value="{{ $ilce['districtId'] }}" @if($ilce['districtId']==($icerik['ilce']??0)) selected @endif>{{ $ilce['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('kullanicilar.adres') }}</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <textarea name="adres" class="resizable_textarea form-control" maxlength="250">{{ $icerik['adres'] ?? null }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12 col-md-offset-5">
                                <a href="{{ route('kullanicilar') }}" class="btn btn-primary">{{ __('kullanicilar.iptal') }}</a>
                                <button type="submit" class="btn btn-success">{{ __('kullanicilar.gonder') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
    @include('admin/production/footer')
    <!-- /footer content -->
    </div>
</div>
<script src="{{asset('adminmaterial/vendors/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('adminmaterial/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js')}}"></script>
{{--
<script src="{{asset('adminmaterial/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
--}}
<script src="{{asset('adminmaterial/vendors/moment/min/moment.min.js')}}"></script>
<script src="{{asset('adminmaterial/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('adminmaterial/vendors/ion.rangeSlider/js/ion.rangeSlider.min.js')}}"></script>
<script src="{{asset('adminmaterial/vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{asset('adminmaterial/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js')}}"></script>
<script src="{{asset('adminmaterial/vendors/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<script src="{{asset('adminmaterial/vendors/cropper/dist/cropper.min.js')}}"></script>

<script>
    $('#modalClose').on('click',function () {
        document.getElementById("img-container-visible").style.display = "none";

    });
    $('#modalOkay').on('click',function () {
        document.getElementById("img-container-visible").style.display = "none";

    });

    $('#inputImage').on('change',function(){
        document.getElementById("img-container-visible").style.display = "inline";
    });
    function selectURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image') .attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>

<script>
    $(document).ready(function() {

        $('#cancel-img').on('click',function () {
            $('#img-canvas').html(null);
            var x = document.createElement("IMG");
            x.setAttribute('src', "{{ ($icerik['resim']??null)?$icerik['resim']:'storage/uploads/users/profileimage/no-Image.jpg'}}");
            $('#img-canvas').html(x);
            x.style.width = "250px";
            x.style.height = "250px";
            document.getElementById("cancel-img").style.display  = "none";
        });

        var $image = $('#image');
        var $download = $('#download');
        var $dataX = $('#dataX');
        var $dataY = $('#dataY');
        var $dataHeight = $('#dataHeight');
        var $dataWidth = $('#dataWidth');
        var options = {
            aspectRatio: 1,
            preview: '.img-preview',
            crop: function (e) {
                $dataX.val(Math.round(e.x));
                $dataY.val(Math.round(e.y));
                $dataHeight.val(Math.round(e.height));
                $dataWidth.val(Math.round(e.width));
            }
        };


        // Tooltip
        $('[data-toggle="tooltip"]').tooltip();

        // Cropper
        $image.on({
            'build.cropper': function (e) {
                console.log(e.type);
            },
            'built.cropper': function (e) {
                console.log(e.type);
            },
            'cropstart.cropper': function (e) {
                console.log(e.type, e.action);
            },
            'cropmove.cropper': function (e) {
                console.log(e.type, e.action);
            },
            'cropend.cropper': function (e) {
                console.log(e.type, e.action);
            },
            'crop.cropper': function (e) {
                console.log(e.type, e.x, e.y, e.width, e.height, e.rotate, e.scaleX, e.scaleY);
            },
            'zoom.cropper': function (e) {
                console.log(e.type, e.ratio);
            }
        }).cropper(options);


        // Buttons
        if (!$.isFunction(document.createElement('canvas').getContext)) {
            $('button[data-method="getCroppedCanvas"]').prop('disabled', true);
        }

        if (typeof document.createElement('cropper').style.transition === 'undefined') {
            $('button[data-method="rotate"]').prop('disabled', true);
            $('button[data-method="scale"]').prop('disabled', true);
        }


        // Options
        $('.docs-toggles').on('change', 'input', function () {
            var $this = $(this);
            var name = $this.attr('name');
            var type = $this.prop('type');
            var cropBoxData;
            var canvasData;

            if (!$image.data('cropper')) {
                return;
            }

            if (type === 'checkbox') {
                options[name] = $this.prop('checked');
                cropBoxData = $image.cropper('getCropBoxData');
                canvasData = $image.cropper('getCanvasData');

                options.built = function () {
                    $image.cropper('setCropBoxData', cropBoxData);
                    $image.cropper('setCanvasData', canvasData);
                };
            } else if (type === 'radio') {
                options[name] = $this.val();
            }

            $image.cropper('destroy').cropper(options);
        });


        // Methods
        $('.docs-buttons').on('click', '[data-method]', function () {
            var $this = $(this);
            var data = $this.data();
            var $target;
            var result;

            if ($this.prop('disabled') || $this.hasClass('disabled')) {
                return;
            }

            if ($image.data('cropper') && data.method) {
                data = $.extend({}, data); // Clone a new one

                if (typeof data.target !== 'undefined') {
                    $target = $(data.target);

                    if (typeof data.option === 'undefined') {
                        try {
                            data.option = JSON.parse($target.val());
                        } catch (e) {
                            console.log(e.message);
                        }
                    }
                }

                result = $image.cropper(data.method, data.option, data.secondOption);

                if (result) {
                    console.log(result);
                    //$('#profile-img').attr('img',result);
                    $('#profile-img').hide();
                    $('#img-canvas').html(result);
                    $('#modalClose').click();
                    $('#cancel-img').show();

                }
                switch (data.method) {
                    case 'scaleX':
                    case 'scaleY':
                        $(this).data('option', -data.option);
                        break;

                    case 'getCroppedCanvas':
                        if (result) {

                            // Bootstrap's Modal
                           /* $('#getCroppedCanvasModal').modal().find('.modal-body').html(result);*/
                            $('#profile-img').attr('src',result);

                            if (!$download.hasClass('disabled')) {
                                $download.attr('href', result.toDataURL());
                            }
                        }

                        break;
                }

                if ($.isPlainObject(result) && $target) {
                    try {
                        $target.val(JSON.stringify(result));
                    } catch (e) {
                        console.log(e.message);
                    }
                }

            }
        });

        // Keyboard
        $(document.body).on('keydown', function (e) {
            if (!$image.data('cropper') || this.scrollTop > 300) {
                return;
            }

            switch (e.which) {
                case 37:
                    e.preventDefault();
                    $image.cropper('move', -1, 0);
                    break;

                case 38:
                    e.preventDefault();
                    $image.cropper('move', 0, -1);
                    break;

                case 39:
                    e.preventDefault();
                    $image.cropper('move', 1, 0);
                    break;

                case 40:
                    e.preventDefault();
                    $image.cropper('move', 0, 1);
                    break;
            }
        });

        // Import image
        var $inputImage = $('#inputImage');
        var URL = window.URL || window.webkitURL;
        var blobURL;

        if (URL) {
            $inputImage.change(function () {
                var files = this.files;
                var file;

                if (!$image.data('cropper')) {
                    return;
                }

                if (files && files.length) {
                    file = files[0];

                    if (/^image\/\w+$/.test(file.type)) {
                        blobURL = URL.createObjectURL(file);
                        $image.one('built.cropper', function () {

                            // Revoke when load complete
                            URL.revokeObjectURL(blobURL);
                        }).cropper('reset').cropper('replace', blobURL);
                    } else {
                        window.alert('Please choose an image file.');
                    }
                }
            });
        } else {
            $inputImage.prop('disabled', true).parent().addClass('disabled');
        }
    });
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
<script>
    function croperModal() {
        $('#modalbutton').click();
    }
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
        if(selValue === "{{ $icerik['city']??null }}"){
            document.getElementById("{{ $icerik['district']??null }}").selected="true";
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

<!DOCTYPE html>
<html lang="en">
@include('/admin/production/head')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
<link href="{{asset('adminmaterial/vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet">
<link href="{{asset('adminmaterial/vendors/cropper/dist/cropper.min.css')}}" rel="stylesheet">
<link href="{{asset('adminmaterial/build/css/custom.min.css')}}" rel="stylesheet">

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
                                <h2>{{ __('urunler.urunduzenle') }}</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <br />
                                <form action="{{ route('urunresmiduzenle') }}" method="POST" enctype="multipart/form-data" class="form-horizontal form-label-left">
                                    @csrf
                                    <input name="id" value="{{ $icerik->productId??null }}" hidden>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="row text-center">
                                                <label class="border-profile-img" id="img-canvas">
                                                    <img id="profile-img" src="{{ $resimkatalog??'storage/uploads/products/picture/no-Image.png' }}" style="width: 250px;height: 250px;">
                                                </label>
                                            </div>
                                            <div class="row text-center">
                                                <button id="modalbutton" type="button" class="btn btn-primary" data-toggle="modal" data-target="#getCroppedCanvasModal"><i class="fa fa-upload"></i> {{ __('urunler.katalogresmiyukle') }}</button>
                                                <button type="button" class="btn btn-default" id="cancel-img" style="display: none;"><i class="fa fa-close"></i> {{ __('urunler.kaldir') }}</button>
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
                                                                    <input type="file" class="sr-only" id="inputImage" name="urunkatalog" accept="image/*">
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
                                        </div>

                                    </div>
                                    <br/><br/><br/>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('urunler.urunadi') }} <span class="required">*</span>
                                                </label>
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <input name="urunadi" type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="{{ $icerik->productName??null }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('urunler.satici') }} <span class="required">*</span>
                                                </label>
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <select name="satici" class="select2_single form-control" id="durum" tabindex="-1" required="required">
                                                        <option></option>
                                                        @foreach($saticilar as $satici)
                                                            <option value="{{ $satici['sellerId'] }}" @if(($satici['sellerId'] ?? 0) == ($icerik->productSeller ?? -1)) selected @endif>{{ $satici['sellerName'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('urunler.kategori') }} <span class="required">*</span>
                                                </label>
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <select name="kategori" class="select2_single form-control" id="durum" tabindex="-1" required="required">
                                                        <option></option>
                                                        @foreach($kategoriler as $kategori)
                                                            <option value="{{ $kategori['categoryId'] }}" @if(($icerik['productCategory'] ?? 0) == ($kategori['categoryId'] ?? -1)) selected @endif>{{ $kategori['categoryName'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('urunler.urunaciklama') }}
                                                </label>
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <textarea name="urunaciklama" id="first-name" class="form-control col-md-7 col-xs-12">{{ $icerik->productExplanation??null }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('urunler.urundurumu') }} <span class="required">*</span>
                                                </label>
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <select name="durum" class="select2_single form-control" id="durum" tabindex="-1" required="required">
                                                        <option></option>
                                                        <option value="0" selected>{{ __('tanimlar.urundurum.0') }}</option>
                                                        <option value="1" @if(($icerik['productStatus'] ?? 0) == 1) selected @endif>{{ __('tanimlar.urundurum.1') }}</option>
                                                        <option value="2" @if(($icerik['productStatus'] ?? 0) == 2) selected @endif>{{ __('tanimlar.urundurum.2') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-36 col-xs-12">
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('urunler.birim') }} <span class="required">*</span>
                                                </label>
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <select name="birim" class="select2_single form-control" tabindex="-1" required="required">
                                                        <option></option>
                                                        <option value="0" @if(($icerik->productUnit ?? 55) == 0) selected @endif>{{ __('tanimlar.birim.0') }}</option>
                                                        <option value="1" @if(($icerik->productUnit ?? 55) == 1) selected @endif>{{ __('tanimlar.birim.1') }}</option>
                                                        <option value="2" @if(($icerik->productUnit ?? 55) == 2) selected @endif>{{ __('tanimlar.birim.2') }}</option>
                                                        <option value="3" @if(($icerik->productUnit ?? 55) == 3) selected @endif>{{ __('tanimlar.birim.3') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('urunler.stok') }} <span class="required">*</span>
                                                </label>
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <input name="stok" type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="{{ $icerik->productNumber??null }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" >{{ __('urunler.birimfiyati') }} <span class="required">*</span>
                                                </label>
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <input name="birimfiyati" type="text" id="first-name" class="money form-control col-md-7 col-xs-12" value="{{ number_format($icerik->productPrice ?? 0, 2) }}">
                                                    <span class="fa fa-turkish-lira (alias) form-control-feedback right" aria-hidden="true"></span>
                                                    <script>
                                                        $('.money').mask("#,##0.00", {reverse: true});
                                                    </script>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('urunler.indirimturu') }}
                                                </label>
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <select name="indirimturu" class="select2_single form-control" id="durum" tabindex="-1" >
                                                        <option></option>
                                                        <option value="0" selected>{{ __('tanimlar.indirimturu.0') }}</option>
                                                        <option value="1" @if(($icerik->discountType ?? 55) == 1) selected @endif>{{ __('tanimlar.indirimturu.1') }}</option>
                                                        <option value="2" @if(($icerik->discountType ?? 55) == 2) selected @endif>{{ __('tanimlar.indirimturu.2') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('urunler.indirim') }}
                                                </label>
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <input name="indirim" type="text" id="first-name"  class="form-control col-md-7 col-xs-12" value="{{ $icerik->productDiscount??null }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('urunler.kargoucreti') }} <span class="required">*</span>
                                                </label>
                                                <div class="col-md-8 col-sm-8 col-xs-12">
                                                    <input name="kargoucreti" type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="{{ $icerik->shippingFee??null }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-12 col-md-offset-5">
                                                <a href="{{ route('urunler') }}" class="btn btn-primary">{{ __('urunler.iptal') }}</a>
                                                <button type="submit" class="btn btn-success">{{ __('urunler.urunresmiduzenle') }}</button>
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
        @include('admin/production/footer')
        <!-- /footer content -->
      </div>
    </div>
    <script src="{{asset('adminmaterial/vendors/select2/dist/js/select2.full.min.js')}}"></script>
    <script src="{{asset('adminmaterial/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('adminmaterial/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('adminmaterial/vendors/ion.rangeSlider/js/ion.rangeSlider.min.js')}}"></script>
    <script src="{{asset('adminmaterial/vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{asset('adminmaterial/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js')}}"></script>
    <script src="{{asset('adminmaterial/vendors/jquery-knob/dist/jquery.knob.min.js')}}"></script>
    <script src="{{asset('adminmaterial/vendors/cropper/dist/cropper.min.js')}}"></script>
    <script>
        function croperModal() {
            $('#modalbutton').click();
        }
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
                x.setAttribute('src', "{{$resimkatalog??'storage/uploads/products/picture/no-Image.png' }}");
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
  </body>
</html>

<!DOCTYPE html>
<html lang="tr">
@include('/admin/production/head')

<link href="{{asset('adminmaterial/vendors/cropper/dist/cropper.min.css')}}" rel="stylesheet">
<link href="{{asset('adminmaterial/build/css/custom.min.css')}}" rel="stylesheet">
<link href="{{asset('adminmaterial/build/css/custom.min.css')}}" rel="stylesheet">

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        @include('admin/production/sidebar')
        @include('admin/production/navbar')
        <div class="right_col" role="main">
            <div class="">
                <div class="row">
                    <div class="col-md-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2><i class="fa fa-image (alias)"></i> {{ __('logoayarla.logoyukle') }}</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                                <br/>
                                <form action="{{ route('logokaydet') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $id??null }}">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <div class="container cropper">
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <div class="img-container">
                                                            <img id="logo" hidden>
                                                            <img id="image" src="{{ $logo }}" alt="Picture">
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
                                                <div class="row">
                                                    <div class="col-md-9 docs-buttons">
                                                        <!-- <h3 class="page-header">Toolbar:</h3> -->
                                                        <div class="row text-center">
                                                            <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                                                                <input type="file" class="sr-only" id="inputImage" name="logo" accept="image/*">
                                                                <span class="docs-tooltip" data-toggle="tooltip">
                                                                    <span class="fa fa-picture-o"></span> {{  __('logoayarla.resimsec') }}
                                                                </span>
                                                            </label>
                                                            <button type="button" class="btn btn-primary" data-method="getCroppedCanvas" data-option="{ &quot;width&quot;: 175, &quot;height&quot;: 85 }">
                                                                <span class="docs-tooltip" data-toggle="tooltip" >
                                                                    <i class="fa fa-upload"></i> {{  __('logoayarla.yukle') }}
                                                                </span>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <!-- Show the cropped image in modal -->
                                                    <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                    <h4 class="modal-title" id="getCroppedCanvasTitle">{{ __('logoayarla.logogorunumu') }}</h4>
                                                                </div>
                                                                <div class="modal-body"></div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('logoayarla.kapat') }}</button>
                                                                    <a class="btn btn-primary" id="download" href="javascript:void(0);" type="submit" style="display:none;">Download</a>
                                                                    <button class="btn btn-primary" type="submit">{{ __('logoayarla.yukle') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.modal -->
                                                </div><!-- /.docs-buttons -->
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
        @include('admin/production/footer')
    </div>
</div>
<script src="{{asset('adminmaterial/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('adminmaterial/vendors/moment/min/moment.min.js')}}"></script>
<script src="{{asset('adminmaterial/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('adminmaterial/vendors/ion.rangeSlider/js/ion.rangeSlider.min.js')}}"></script>
<script src="{{asset('adminmaterial/vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{asset('adminmaterial/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js')}}"></script>
<script src="{{asset('adminmaterial/vendors/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<script src="{{asset('adminmaterial/vendors/cropper/dist/cropper.min.js')}}"></script>

<script>
    function selectClick() {
        $("#inputImage").click();
    }
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
        var $image = $('#image');
        var $download = $('#download');
        var $dataX = $('#dataX');
        var $dataY = $('#dataY');
        var $dataHeight = $('#dataHeight');
        var $dataWidth = $('#dataWidth');
        var options = {
            aspectRatio: 17.5 / 8.5,
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

                switch (data.method) {
                    case 'scaleX':
                    case 'scaleY':
                        $(this).data('option', -data.option);
                        break;

                    case 'getCroppedCanvas':
                        if (result) {

                            // Bootstrap's Modal
                            $('#getCroppedCanvasModal').modal().find('.modal-body').html(result);

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

</body>
</html>


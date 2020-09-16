<!DOCTYPE html>
<html lang="en">
@include('/admin/production/head')
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
        <div class="left_col" role="main">
            <div class="row">
                <!-- page content -->
                <div class="right_col" >
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <form action="{{ route('urunresimekle') }}" method="POST" enctype="multipart/form-data" class="form-horizontal form-label-left">
                                @csrf
                                <input name="id" value="{{ $id??null }}" hidden>
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>{{ __('urunler.urunresimlistesi') }}</h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <br />
                                        <div class="dt-buttons btn-group pull-left">
                                            <a href="/urunduzenle?id={{ $id }}" ><i class="fa fa-long-arrow-left fa-2x" style="border: 1px solid midnightblue;border-radius: 3px;padding-left: 5px;padding-right: 8px"></i></a>
                                        </div>
                                        <div class="dt-buttons btn-group pull-right">
                                            <button  id="modalbutton" type="button" class="btn btn-primary" data-toggle="modal" data-target="#getCroppedCanvasModal"><i class="fa fa-plus"></i> {{ __('urunler.urunresmiyukle') }}</button>
                                        </div>
                                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <th class="column1">{{ __('urunler.id') }}</th>
                                                <th class="column2">{{ __('urunler.resim') }}</th>
                                                <th class="column3">{{ __('urunler.sonduzenlenmetarihi') }}</th>
                                                <th class="column4">{{ __('urunler.yuklendigitarih') }}</th>
                                                <th class="column8"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $count = 1;
                                            $pagerCount = 1;
                                            ?>
                                            @foreach($resimliste as $resim)
                                                @if($count > (($page-1)*10) && $count<=($page*10))
                                                    <tr>
                                                        <td class="column1">{{ $resim->pictureId }}</td>
                                                        <td class="column2 text-center"><img onclick="resimGoruntule(this)" class="product-list-image-admin" style="cursor: pointer" data-toggle="modal" data-target="#resimGoruntule" src="{{ $resim->pictureUrl?'storage/uploads/products/picturecrop/'.(\App\Models\Product::Where('productId',$resim->productId)->first()->productSeller).'/'.$resim->pictureUrl:'storage/uploads/products/picture/no-Image.png' }}"></td>
                                                        <td class="column3">{{ $resim->updated_at }}</td>
                                                        <td class="column4">{{ $resim->created_at }}</td>
                                                        <td class="column8" width="16%">
                                                            <a href="/urunresmisil?id={{ $resim->pictureId }}"><button type="button" class="btn btn-danger btn-sm">{{ __('urunler.sil') }}</button></a>
                                                        </td>
                                                    </tr>
                                                @endif
                                                <?php $count++; ?>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <ul class="pagination pagination-sm justify-content-center ">
                                                    @if(($count-1)%10 == 0)
                                                        <?php $totalPager = $count/10; ?>
                                                    @else
                                                        <?php $totalPager = ($count/10)+1; ?>
                                                    @endif
                                                    @while($pagerCount < $totalPager)
                                                        @if($pagerCount == $page)
                                                            <li class="page-item active"><a class="page-link" href="/urunresmiduzenle?page={{ $pagerCount }}">{{ $pagerCount }}</a></li>
                                                        @else
                                                            <li class="page-item"><a class="page-link" href="/urunresmiduzenle?page={{ $pagerCount }}">{{ $pagerCount }}</a></li>
                                                        @endif
                                                        <?php $pagerCount++; ?>
                                                    @endwhile
                                                </ul>
                                            </div>
                                        </div>
                                        <div id="resimGoruntule" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-body text-center">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <br/><br/>
                                                        <img id="resimgoruntule" src="" style="width: 75%; height: auto">
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
                                                                <input type="file" class="sr-only" id="inputImage" name="urunresim" accept="image/*">
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
                                                            <button type="submit" id="modalOkay" class="btn btn-primary"  data-method="getCroppedCanvas" data-option="{ &quot;width&quot;: 250, &quot;height&quot;: 250 }">{{ __('kullanicilar.onayla') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
        function  resimGoruntule(val) {
            document.getElementById('resimgoruntule').src =val.src
        }
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
                x.setAttribute('src', "{{$resimkatalog->pictureUrl??'storage/uploads/products/picture/no-Image.png' }}");
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
                        $('#modalClose').click();

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

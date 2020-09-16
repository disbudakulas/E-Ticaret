<!DOCTYPE html>
<html lang="en">
@include('/admin/production/head')
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
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>{{ __('slide.slidelistesi') }}</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div id="datatable-buttons_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                    <div class="dt-buttons btn-group pull-right">
                                        <button  id="modalbutton" type="button" class="btn btn-primary" data-toggle="modal" data-target="#getCroppedCanvasModal"  onclick="slideSifirla()"><i class="fa fa-plus"></i> {{ __('slide.slideekle') }}</button>
                                    </div>
                                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th class="column1">{{ __('slide.id') }}</th>
                                            <th class="column2">{{ __('slide.resim') }}</th>
                                            <th class="column3">{{ __('slide.baslik') }}</th>
                                            <th class="column4">{{ __('slide.slogan') }}</th>
                                            <th class="column5">{{ __('slide.yuklendigitarih') }}</th>
                                            <th class="column6"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $count = 1;
                                        $pagerCount = 1;
                                        ?>
                                        @if($resimler)
                                            @foreach($resimler as $resim)
                                                @if($count > (($page-1)*10) && $count<=($page*10))
                                                    <tr>
                                                        <td class="column1">{{ $resim['id'] }}</td>
                                                        <td class="column2 text-center"><img class="slide-list-image-admin" src="{{ 'storage/uploads/slide/picturecrop/'.$resim['picture'] }}" style="width:55px;height: auto"></td>
                                                        <td class="column3">{{ $resim['title'] }}</td>
                                                        <td class="column4">{{ $resim['slogan'] }}</td>
                                                        <td class="column5">{{ $resim['created_at'] }}</td>
                                                        <td class="column6" width="16%">
                                                            <a href="/slidesil?id={{ $resim['id'] }}"><button type="button" class="btn btn-danger btn-sm">{{ __('slide.sil') }}</button></a>
                                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#getCroppedCanvasModal" data-id="{{ $resim['id'] }}" data-url="{{ $resim['url'] }}" data-img="{{ 'storage/uploads/slide/picturecrop/'.$resim['picture'] }}" onclick="slideDuzenle(this)">{{ __('slide.duzenle') }}</button>
                                                        </td>
                                                    </tr>
                                                @endif
                                                <?php $count++; ?>
                                            @endforeach
                                        @endif
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
                                                        <li class="page-item active"><a class="page-link" href="/slide?page={{ $pagerCount }}">{{ $pagerCount }}</a></li>
                                                    @else
                                                        <li class="page-item"><a class="page-link" href="/slide?page={{ $pagerCount }}">{{ $pagerCount }}</a></li>
                                                    @endif
                                                    <?php $pagerCount++; ?>
                                                @endwhile
                                            </ul>
                                        </div>
                                    </div>
                                    <form action="{{ route('slideekle') }}" method="POST" enctype="multipart/form-data" id="demo-form2" class="form-horizontal form-label-left">
                                        @csrf
                                        <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" id="getCroppedCanvasTitle">{{ __('kullanicilar.resimduzenle') }}</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id">
                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <div class="row" style="margin-bottom: 5px">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('slide.slidebasligi') }}
                                                                    </label>
                                                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                                                        <input name="slidebasligi" type="text" class=" col-md-12 col-sm-12 col-xs-12" style="height: 34px;padding: 6px 12px;font-size: 14px;line-height: 1.4;
                                                                        color: #555;background-color: #fff;border:1px solid #ccc;box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
                                                                        transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;">
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="margin-bottom: 5px">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('slide.slideslogani') }}
                                                                    </label>
                                                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                                                        <input name="slideslogani" type="text" class=" col-md-12 col-sm-12 col-xs-12" style="height: 34px;padding: 6px 12px;font-size: 14px;line-height: 1.4;
                                                                        color: #555;background-color: #fff;border:1px solid #ccc;box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
                                                                        transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;">
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="margin-bottom: 5px">
                                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">{{ __('slide.url') }}
                                                                    </label>
                                                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                                                        <input name="url" type="text" class=" col-md-12 col-sm-12 col-xs-12" style="height: 34px;padding: 6px 12px;font-size: 14px;line-height: 1.4;
                                                                        color: #555;background-color: #fff;border:1px solid #ccc;box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
                                                                        transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <div class="row">
                                                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">{{ __('slide.slideaciklama') }}
                                                                    </label>
                                                                    <div class="col-md-10 col-sm-10 col-xs-12">
                                                                        <textarea rows="5" name="slideaciklama" class=" col-md-12 col-sm-12 col-xs-12" style="padding: 6px 12px;font-size: 14px;line-height: 1.4;
                                                                        color: #555;background-color: #fff;border:1px solid #ccc;box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
                                                                        transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br/>
                                                        <div class="row">
                                                            <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                                                                <input type="file" class="sr-only" id="inputImage" name="slideresim" accept="image/*">
                                                                <span class="docs-tooltip" data-toggle="tooltip">
                                                                <span class="fa fa-picture-o"></span> {{  __('kullanicilar.resimsec') }}
                                                            </span>
                                                            </label>
                                                        </div>
                                                        <div class="row">
                                                            <div class="container cropper col-md-12" id="img-slide-visible" style="display: none;">
                                                                <div class="row">
                                                                    <img id="slideImage" src="" alt="Picture" style="width: 100%;height: auto">
                                                                </div>
                                                            </div>
                                                            <div class="container cropper col-md-12" id="img-container-visible" style="display: none;">
                                                                <div class="row">
                                                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                                                        <div class="img-container">
                                                                            <img id="picture" hidden>
                                                                            <img id="image" src="" alt="Picture">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-4 col-xs-12">
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
                                    </form>
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
        document.getElementById("img-slide-visible").style.display = "none";
    });
    $('#modalOkay').on('click',function () {
        document.getElementById("img-container-visible").style.display = "none";
        document.getElementById("img-slide-visible").style.display = "none";
    });

    $('#inputImage').on('change',function(){
        document.getElementById("img-container-visible").style.display = "inline";
        document.getElementById("img-slide-visible").style.display = "none";
    });

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
<script>
    function slideSifirla() {
        document.getElementById("img-slide-visible").style.display = "none";
        $("input[name='id']").val(null);
        $("input[name='slidebasligi']").val(null);
        $("input[name='slideslogani']").val(null);
        $("input[name='url']").val(null);
        $("textarea[name='slideaciklama']").val(null);
    };
    function slideDuzenle(val) {
        var url = $(val).data('url');
        var img = $(val).data('img');
        var id = $(val).data('id');
        $("input[name='id']").val(id);

        $.ajax({
            url: '/slidedetay?id='+id,
            type: 'get',
            dataType: 'json',
            success:function(data)
            {
                $("input[name='slidebasligi']").val(data[0]);
                $("input[name='slideslogani']").val(data[1]);
                $("input[name='url']").val(data[4]);
                $("textarea[name='slideaciklama']").val(data[2]);
            }
        });
        document.getElementById("img-container-visible").style.display = "none";
        document.getElementById("img-slide-visible").style.display = "inline";
        document.getElementById("slideImage").src = img;
    }
</script>
</body>
</html>

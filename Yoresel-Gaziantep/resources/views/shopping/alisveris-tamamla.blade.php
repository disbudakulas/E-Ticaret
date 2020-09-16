<!DOCTYPE html>
<html lang="en">
@include('shopping/head')
<link href="{{asset('/adminmaterial/vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet">
<body>
@include('shopping/header')
<section id="cart_items">
    <div class="container">
        <div class="col-lg-12 col-md-12">
            <div class="table-responsive cart_info">
                <div class="row">
                    <div class="col-xs-12 basket-title">
                        {{ __('shopping.teslimatbilgileri') }}
                    </div>
                </div>
                <hr class="basket-item-bar"/>
                @if(isset($sepeturunler) and $sepeturunler)
                    <div class="row stepwizard-container">
                        <div class="stepwizard">
                            <div class="stepwizard-row setup-panel">
                                <div class="stepwizard-step">
                                    <a href="#step-1" type="button" class="btn btn-primary btn-circle"><i class="fa fa-map-marker"></i></a>
                                    <p>{{ __('shopping.adresbilgileri') }}</p>
                                </div>
                                <div class="stepwizard-step">
                                    <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled"><i class="fa fa-credit-card"></i></a>
                                    <p>{{ __('shopping.odemebilgileri') }}</p>
                                </div>
                                <div class="stepwizard-step">
                                    <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled"><i class="fa fa-list-alt"></i></a>
                                    <p>{{ __('shopping.siparisozeti') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3 col-xs-12"></div>
                            <div class="col-sm-6 col-xs-12">
                                <form role="form" action="{{ route('odemeonayla') }}" method="POST">
                                    @csrf
                                    <div class="row setup-content" id="step-1">
                                        <div class="col-xs-12">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>{{ __('shopping.ad') }}:</label>
                                                    <input type="text" class="form-control" name="ad" required autocomplete="name" placeholder="{{ __('shopping.ad') }}"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('shopping.sad') }}:</label>
                                                    <input type="text" class="form-control" name="sad" required autocomplete="name" placeholder="{{ __('shopping.sad') }}"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('shopping.ulke') }}:</label>
                                                    <select name="ulke" class="select2_single form-control" required id="selectCountry" tabindex="-1" onchange="countSelection(this.value)">
                                                        <option></option>
                                                        @foreach($ulkeler as $ulke)
                                                            <option value="{{ $ulke->id }}">{{ $ulke->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group" id="select-city">
                                                    <label>{{ __('shopping.sehir') }}:</label>
                                                    <select name="il" class="select2_single form-control" required id="selectCity" tabindex="-1" onchange="citySelection(this.value)">
                                                        <option></option>
                                                    </select>
                                                </div>
                                                <div class="form-group" id="select-district">
                                                    <label>{{ __('shopping.ilce') }}:</label>
                                                    <select name="ilce" class="select2_single form-control" required  id="selectDistrict" tabindex="-1">
                                                        <option></option>
                                                    </select>
                                                </div>
                                                <div class="form-group" id="select-city2" style="display:none">
                                                    <label>{{ __('shopping.sehir') }}:</label>
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('shopping.adres') }}:</label>
                                                    <textarea type="text" class="form-control" name="adres" required autocomplete="name" placeholder="{{ __('shopping.adres') }}" ></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('shopping.tel') }}:</label>
                                                    <input type="text" class="form-control" name="tel" required autocomplete="name" placeholder="{{ __('shopping.tel') }}"/>
                                                </div>
                                                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >{{ __('shopping.ileri') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row setup-content" id="step-2">
                                        <div class="col-xs-12">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>{{ __('shopping.karno') }}:</label>
                                                    <input type="text" class="form-control" name="kartno" required data-inputmask="'mask' : '9999-9999-9999-9999'" style="width: 250px;font-size: 16px;letter-spacing: 2px;">
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('shopping.kartisim') }}:</label>
                                                    <input type="text" class="form-control" name="kartad" required autocomplete="name" placeholder="{{ __('shopping.kartisim') }}" style="width: 250px;font-size: 14px;letter-spacing: 2px;"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('shopping.sktarihi') }}:</label>
                                                    <select name="ay" class="select2_single form-control" required tabindex="-1" style="width: 100px;">
                                                        <option></option>
                                                        <option value="01">01</option>
                                                        <option value="02">02</option>
                                                        <option value="03">03</option>
                                                        <option value="04">04</option>
                                                        <option value="05">05</option>
                                                        <option value="06">06</option>
                                                        <option value="07">07</option>
                                                        <option value="08">08</option>
                                                        <option value="09">09</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                    </select>
                                                    <select name="yil" class="select2_single form-control" required tabindex="-1"  style="width: 100px;">
                                                        <option></option>
                                                        @for($i=0;$i<15;$i++)
                                                            <option value="{{ substr(\Carbon\Carbon::now(),0,4)+$i }}">{{ substr(\Carbon\Carbon::now(),0,4)+$i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('shopping.guvenlikkodu') }}:</label>
                                                    <input type="number" class="form-control" name="cvv" required autocomplete="name"  placeholder="{{ __('shopping.cvv') }}" style="width: 60px;font-size: 14px;"/>
                                                </div>
                                                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" onclick="adressSum()">{{ __('shopping.ileri') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row setup-content" id="step-3">
                                        <div class="col-xs-12">
                                            <div class="col-md-12">
                                                <div class="single_field">
                                                    <label>{{ __('shopping.adres') }}:</label>
                                                    <label type="text" class="form-control" id="adresozet" style="font-weight: 400;height: 100%;font-size: 12px;"></label>
                                                </div>
                                                <div class="single_field">
                                                    <label>{{ __('shopping.konum') }}:</label>
                                                    <label type="text" class="form-control" id="konum" style="font-weight: 400;height: 100%;font-size: 12px;"></label>
                                                </div>
                                                <div class="single_field">
                                                    <label>{{ __('shopping.alici') }}:</label>
                                                    <label type="text" class="form-control" id="alici" style="font-weight: 400;height: 100%;font-size: 12px;"></label>
                                                </div>
                                                <div class="single_field">
                                                    <label>{{ __('shopping.tutar').'('.__('shopping.kdvdahil').')' }}:</label>
                                                    <label type="text" class="form-control" id="tutarozet" style="font-weight: 400;height: 100%;font-size: 12px;"></label>
                                                </div>
                                                <button class="btn btn-primary btn-lg pull-right" type="submit">{{ __('shopping.tamamla') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <div class="col-sm-3 col-xs-12"></div>
                        </div>
                    </div>
                @else
                    <p style="margin-left: 15px">Sepetinizde hiçbir ürün bulunmamaktadır.</p>
                @endif
            </div>
        </div>
    </div>
</section> <!--/#cart_items-->
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <div class="shipping text-center"><!--shipping-->
                        <img src="shopping/images/home/shipping.jpg" alt="" />
                    </div><!--/shipping-->

                </div>
            </div>
            <div class="col-sm-9 padding-right">
                @include('shopping/firsat-urunleri')
            </div>
        </div>
    </div>
</section>
@include('shopping/footer')
<script src="{{asset('adminmaterial/vendors/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('adminmaterial/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $(":input").inputmask();
    });
</script>
<script>
    $(document).ready(function() {
        $(".select2_single").select2({
            placeholder: "{{ __('siteaciklama.secilmedi') }}",
            allowClear: true
        });
    });
</script>
<script>
    $(document).ready(function () {

        var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');

        allWells.hide();

        navListItems.click(function (e) {
            e.preventDefault();
            var $target = $($(this).attr('href')),
                $item = $(this);

            if (!$item.hasClass('disabled')) {
                navListItems.removeClass('btn-primary').addClass('btn-default');
                $item.addClass('btn-primary');
                allWells.hide();
                $target.show();
                $target.find('input:eq(0)').focus();
            }
        });

        allNextBtn.click(function(){
            var curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                curInputs = curStep.find("input[type='text'],input[type='url']"),
                isValid = true;

            $(".form-group").removeClass("has-error");
            for(var i=0; i<curInputs.length; i++){
                if (!curInputs[i].validity.valid){
                    isValid = false;
                    $(curInputs[i]).closest(".form-group").addClass("has-error");
                }
            }

            if (isValid)
                nextStepWizard.removeAttr('disabled').trigger('click');
        });

        $('div.setup-panel div a.btn-primary').trigger('click');
    });
</script>
<script>
    function adressSum() {
        var ad = $("input[name='ad']").val();
        var sad = $("input[name='sad']").val();
        var ulke = $("select[name='ulke'] option:selected");
        var adres = $("textarea[name='adres']").val();
        var tel = $("input[name='tel']").val();
        if(ulke.val() === '223') {
            var il = $("select[name='il'] option:selected");
            var ilce = $("select[name='ilce'] option:selected");
            var konum = ulke.text()+'/'+il.text()+'/'+ilce.text();
        }else{
            var il2 = $("input[name='il2']").val();
            var konum = ulke.text()+'/'+il2;
        }
        $('#adresozet').text(adres);
        $.ajax({
            type: "GET",
            url: '/odemehesapla',
            dataType : 'Json',
            success: function (data) {
                $('#tutarozet').text(data);
            },
        });
        $('#konum').text(konum);
        $('#alici').text(ad+' '+sad);
    }
    function orderOkay() {
        var ad = $("input[name='ad']").val();
        var sad = $("input[name='sad']").val();
        var ulke = $("select[name='ulke'] option:selected");
        var adres = $("textarea[name='adres']").val();
        var tel = $("input[name='tel']").val();
        var kartno = $("input[name='kartno']").val();
        var kartad = $("input[name='tel']").val();
        var ay = $("select[name='ay'] option:selected");
        var yil = $("select[name='yil'] option:selected");
        var cvv = $("input[name='cvv']").val();

        if(ulke.val() === '223') {
            var il = $("select[name='il'] option:selected");
            var ilce = $("select[name='ilce'] option:selected");
            var konum = ulke.text()+'/'+il.text()+'/'+ilce.text();
        }else{
            var il2 = $("input[name='il2']").val();
            var konum = ulke.text()+'/'+il2;
        }
        $.ajax({
            type: "POST",
            url: '/odemeonayla',
            dataType : 'Json',
            data: { "_token": "{{ csrf_token() }}", ad: ad, sad: sad, ulke: ulke.val(), adres: adres,
                tel: tel, konum: konum, kartno: kartno, kartad: kartad, ay: ay.text(), yil: yil.text(), cvv: cvv },
            success: function () {
                alert('basarili');
            },
        });
    }
</script>
</body>
</html>

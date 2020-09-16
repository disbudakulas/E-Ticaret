<!DOCTYPE html>
<html lang="en">
@include('/admin/production/head')
<style>
    .tab {
        overflow: hidden;
    }
    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 20px;
        font-weight: 700;
        color: #818181;
    }
    .tab button:hover {
        color: #ffa300;
    }
    .tab button.active {
        color: orange;
    }
    .tabcontent {
        display: none;
        padding: 6px 12px;
    }
</style>
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
                                <h2>{{ __('kullanicilar.kullanicilar') }}</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div id="datatable-buttons_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="column1">{{ __('kullanicilar.id') }}</th>
                                                <th class="column2">{{ __('kullanicilar.unvan') }}</th>
                                                <th class="column3">{{ __('kullanicilar.basvurutipi') }}</th>
                                                <th class="column4">{{ __('kullanicilar.tarih') }}</th>
                                                <th class="column8"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = 1;
                                            $pagerCount = 1;
                                            ?>
                                            @foreach($basvurular as $basvuru)
                                                @if($count > (($page-1)*10) && $count<=($page*10))
                                                    <tr>
                                                        <td class="column1">{{ $basvuru['id'] }}</td>
                                                        <td class="column2">{{ $basvuru['sellerName'] }}</td>
                                                        <td class="column3">{{ __('tanimlar.saticibasvurutip.'.$basvuru['type']) }}</td>
                                                        <td class="column4">{{ substr($basvuru['created_at'],0,10) }}</td>
                                                        <td class="column8" width="16%">
                                                            <a data-toggle="modal" data-target="#sellerDetailModal" data-name="{{ $basvuru['sellerName'] }}" data-id="{{ $basvuru['id'] }}" onclick="sellerDetail(this)"><button type="button" class="btn btn-primary btn-sm">{{ __('kullanicilar.detay') }}</button></a>
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
                                                        <li class="page-item active"><a class="page-link" href="/saticibasvurulari?page={{ $pagerCount }}">{{ $pagerCount }}</a></li>
                                                    @else
                                                        <li class="page-item"><a class="page-link" href="/saticibasvurulari?page={{ $pagerCount }}">{{ $pagerCount }}</a></li>
                                                    @endif
                                                    <?php $pagerCount++; ?>
                                                @endwhile
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="modal" id="sellerDetailModal">
                <div class="modal-dialog">
                    <div class="modal-content modal-lg">
                        <!-- Modal Header -->
                        <div class="modal-header" style="padding: 10px">
                            <label class="order-detail-name">{{ __('kullanicilar.saticibasvurusu') }}</label>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body" style="padding-left: 35px;padding-right: 35px">
                            <div class="row">
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="order-detail-container">
                                            <label class="order-detail-title">{{ __('kullanicilar.mail') }}</label>
                                            <label class="order-detail-text" id="mail"></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="order-detail-container">
                                            <label class="order-detail-title">{{ __('kullanicilar.unvan') }}</label>
                                            <label class="order-detail-text" id="unvan"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="order-detail-container">
                                            <label class="order-detail-title">{{ __('kullanicilar.vergidairesi') }}</label>
                                            <label class="order-detail-text" id="vergidairesi"></label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="order-detail-container">
                                            <label class="order-detail-title">{{ __('kullanicilar.vergino') }}</label>
                                            <label class="order-detail-text" id="vergino"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="order-detail-container">
                                            <label class="order-detail-title">{{ __('kullanicilar.hesapadi') }}</label>
                                            <label class="order-detail-text" id="hesapadi"></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="order-detail-container">
                                            <label class="order-detail-title">{{ __('kullanicilar.hesapno') }}</label>
                                            <label class="order-detail-text" id="hesapno"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="tab">
                                        <button class="tablinks" onclick="openCity(event, 'onayla')" id="defaultOpen">{{ __('kullanicilar.onayla') }}</button>
                                        <button class="tablinks" onclick="openCity(event, 'reddet')">{{ __('kullanicilar.reddet') }}</button>
                                        <button class="tablinks" onclick="openCity(event, 'eksikveri')">{{ __('kullanicilar.eksikveri') }}</button>
                                    </div>
                                    <div id="onayla" class="tabcontent">
                                        <form method="POST" action="{{ route('basvuruonay') }}">
                                            @csrf
                                            <input name="id" hidden>
                                            <div class="order-detail-description-cont">
                                                <label class="order-description-title">{{ __('kullanicilar.aciklama') }}</label>
                                                <textarea name="onayaciklama" class="order-description-text" required maxlength="250">{{ __('kullanicilar.onayaciklama') }}</textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-sm pull-right">{{ __('kullanicilar.kaydet') }}</button>
                                        </form>
                                    </div>
                                    <div id="reddet" class="tabcontent">
                                        <form method="POST" action="{{ route('basvurureddet') }}">
                                            @csrf
                                            <input name="id" hidden>
                                            <div class="order-detail-description-cont">
                                                <label class="order-description-title">{{ __('kullanicilar.aciklama') }}</label>
                                                <textarea name="reddetaciklama" class="order-description-text" required maxlength="250" placeholder="{{ __('kullanicilar.reddetaciklama') }}"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-sm pull-right">{{ __('kullanicilar.kaydet') }}</button>
                                        </form>
                                    </div>
                                    <div id="eksikveri" class="tabcontent">
                                        <form method="POST" action="{{ route('basvurueksikveri') }}">
                                            @csrf
                                            <input name="id" hidden>
                                            <div class="order-detail-description-cont">
                                                <label class="order-description-title">{{ __('kullanicilar.aciklama') }}</label>
                                                <textarea name="eksikveriaciklama" class="order-description-text" required maxlength="250" placeholder="{{ __('kullanicilar.eksikveriaciklama') }}"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-sm pull-right">{{ __('kullanicilar.kaydet') }}</button>
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
  </body>
<script>
    function sellerDetail(val) {
        var ad = $(val).data('name');
        var id = $(val).data('id');
        $.ajax({
            type: "GET",
            url: '/basvurudetay/'+id,
            dataType : 'Json',
            success: function (data) {
                $('#mail').text(data['mail']);
                $('#unvan').text(data['sellerName']);
                $('#vergidairesi').text(data['taxOffice']);
                $('#vergino').text(data['taxNumber']);
                $('#hesapadi').text(data['accountName']);
                $('#hesapno').text(data['accountNumber']);
                $("input[name='id']").val(id);
            },
        });
    }
</script>
<script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>
</html>

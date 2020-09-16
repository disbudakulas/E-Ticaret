<!DOCTYPE html>
<html lang="en">
@include('/admin/satici/head')
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
                                <h2>{{ __('saticiurunler.urunlistesi') }}</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div id="datatable-buttons_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                    @if(isset($siparisler) and $siparisler)
                                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <th class="column2">{{ __('saticisiparisler.id') }}</th>
                                                <th class="column2">{{ __('saticisiparisler.urun') }}</th>
                                                <th class="column3">{{ __('saticisiparisler.alici') }}</th>
                                                <th class="column4">{{ __('saticisiparisler.adet') }}</th>
                                                <th class="column5">{{ __('saticisiparisler.tutar') }}</th>
                                                <th class="column6">{{ __('saticisiparisler.tarih') }}</th>
                                                <th class="column8"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $count = 1;
                                            $pagerCount = 1;
                                            ?>
                                            @foreach($siparisler as $key=>$siparis)
                                                @if($count > (($page-1)*10) && $count<=($page*10))
                                                    <tr>
                                                        <td class="column2">{{ $key }}</td>
                                                        <td class="column2">{{ $siparis['urunid'] }}</td>
                                                        <td class="column3">{{ $siparis['alici'] }}</td>
                                                        <td class="column4">{{ $siparis['adet'] }}</td>
                                                        <td class="column5">{{ number_format($siparis['tutar'],2) }} <i class="fa fa-turkish-lira (alias)"></i></td>
                                                        <td class="column6">{{ $siparis['tarih'] }}</td>
                                                        <td class="column8" width="16%">
                                                            <a data-toggle="modal" data-target="#orderDetailModal" data-name="{{ $siparis['urunid'] }}" data-id="{{ $siparis['id'] }}" onclick="orderDetail(this)"><button type="button" class="btn btn-primary btn-sm">{{ __('saticisiparisler.detay') }}</button></a>
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
                                                            <li class="page-item active"><a class="page-link" href="/saticikargoyaverilecekler?page={{ $pagerCount }}">{{ $pagerCount }}</a></li>
                                                        @else
                                                            <li class="page-item"><a class="page-link" href="/saticikargoyaverilecekler?page={{ $pagerCount }}">{{ $pagerCount }}</a></li>
                                                        @endif
                                                        <?php $pagerCount++; ?>
                                                    @endwhile
                                                </ul>
                                            </div>
                                        </div>
                                    @else
                                        <p>{{ __('saticisiparisler.siparisyok') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="orderDetailModal">
            <div class="modal-dialog">
                <div class="modal-content modal-lg">
                    <!-- Modal Header -->
                    <div class="modal-header" style="padding: 10px">
                        <label class="order-detail-name"></label>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body" style="padding-left: 35px;padding-right: 35px">
                        <div class="row">
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="order-detail-container">
                                        <label class="order-detail-title">{{ __('saticisiparisler.adsoyad') }}</label>
                                        <label class="order-detail-text" id="adsoyad"></label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="order-detail-container">
                                        <label class="order-detail-title">{{ __('saticisiparisler.tel') }}</label>
                                        <label class="order-detail-text" id="tel"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="order-detail-container">
                                        <label class="order-detail-title">{{ __('saticisiparisler.adres') }}</label>
                                        <label class="order-detail-text" id="adres"></label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="order-detail-container">
                                        <label class="order-detail-title">{{ __('saticisiparisler.konum') }}</label>
                                        <label class="order-detail-text" id="konum"></label>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('kargoyaverildi') }}" method="POST">
                                @csrf
                                <input name="id" hidden>
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="order-detail-container">
                                            <label class="order-detail-title">{{ __('saticisiparisler.kargoadi') }}</label>
                                            <input name="kargoadi" class="order-detail-input" required placeholder="{{ __('saticisiparisler.kargoadigir') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="order-detail-container">
                                            <label class="order-detail-title">{{ __('saticisiparisler.takipno') }}</label>
                                            <input name="takipno" class="order-detail-input" required placeholder="{{ __('saticisiparisler.takipnogir') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <button type="submit" class="btn btn-primary btn-sm pull-right">{{ __('saticisiparisler.kaydet') }}</button>
                                </div>
                            </form>
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
</body>
<script>
    function orderDetail(val) {
        var ad = $(val).data('name');
        var id = $(val).data('id');
        $("label[class='order-detail-name']").text(ad);
        $.ajax({
            type: "GET",
            url: '/siparisdetay/'+id,
            dataType : 'Json',
            success: function (data) {
                $('#adsoyad').text(data['name']+' '+data['surname']);
                $('#tel').text(data['tel']);
                $('#adres').text(data['adress']);
                $('#konum').text(data['location']);
                $("input[name='id']").val(id);
            },
        });
    }
</script>
</html>

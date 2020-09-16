<!DOCTYPE html>
<html lang="en">
@include('/admin/production/head')

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
                                <h2>{{ __('toplamsiparisler.satislarlistesi') }}</h2>
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
                                                <th class="column1">{{ __('toplamsiparisler.id') }}</th>
                                                <th class="column2">{{ __('toplamsiparisler.urun') }}</th>
                                                <th class="column3">{{ __('toplamsiparisler.satici') }}</th>
                                                <th class="column4">{{ __('toplamsiparisler.durum') }}</th>
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
                                                        <td class="column1">{{ $key }}</td>
                                                        <td class="column2">{{ $siparis['urunid'] }}</td>
                                                        <td class="column3">{{ $siparis['satici'] }}</td>
                                                        <td class="column4">{{ __('tanimlar.siparisdurum.'.$siparis['durum']) }}</td>
                                                        <td class="column8" width="16%">
                                                            <a data-toggle="modal" data-target="#orderDetailModal" data-name="{{ $siparis['urunid'] }}" data-id="{{ $key }}" onclick="orderDetail(this)"><button type="button" class="btn btn-primary btn-sm">{{ __('toplamsiparisler.detay') }}</button></a>
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
                                                            <li class="page-item active"><a class="page-link" href="/toplamyapilansatislar?page={{ $pagerCount }}">{{ $pagerCount }}</a></li>
                                                        @else
                                                            <li class="page-item"><a class="page-link" href="/toplamyapilansatislar?page={{ $pagerCount }}">{{ $pagerCount }}</a></li>
                                                        @endif
                                                        <?php $pagerCount++; ?>
                                                    @endwhile
                                                </ul>
                                            </div>
                                        </div>
                                    @else
                                        <p>{{ __('toplamsiparisler.tamamlanansiparisyok') }}</p>
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
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header" style="padding: 10px">
                            <h4 class="modal-title" style="font-weight: 700;color: #5d85a9;font-size: 17px">{{ __('toplamsiparisler.satisdetay') }}</h4>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="order-detail-container">
                                        <label class="order-detail-title">{{ __('toplamsiparisler.urun') }}</label>
                                        <label class="order-detail-text" id="urun"></label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="order-detail-container">
                                        <label class="order-detail-title">{{ __('toplamsiparisler.satici') }}</label>
                                        <label class="order-detail-text" id="satici"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="order-detail-container">
                                        <label class="order-detail-title">{{ __('toplamsiparisler.adet') }}</label>
                                        <label class="order-detail-text" id="adet"></label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="order-detail-container">
                                        <label class="order-detail-title">{{ __('toplamsiparisler.tutar') }}</label>
                                        <label class="order-detail-text" id="tutar"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="order-detail-container">
                                        <label class="order-detail-title">{{ __('toplamsiparisler.alici') }}</label>
                                        <label class="order-detail-text" id="alici"></label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="order-detail-container">
                                        <label class="order-detail-title">{{ __('toplamsiparisler.alicitel') }}</label>
                                        <label class="order-detail-text" id="alicitel"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="order-detail-container">
                                        <label class="order-detail-title">{{ __('toplamsiparisler.aliciadres') }}</label>
                                        <label class="order-detail-text" id="aliciadres"></label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="order-detail-container">
                                        <label class="order-detail-title">{{ __('toplamsiparisler.konum') }}</label>
                                        <label class="order-detail-text" id="konum"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="order-detail-container">
                                        <label class="order-detail-title">{{ __('toplamsiparisler.kargo') }}</label>
                                        <label class="order-detail-text" id="kargo"></label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="order-detail-container">
                                        <label class="order-detail-title">{{ __('toplamsiparisler.kargotakip') }}</label>
                                        <label class="order-detail-text" id="kargotakip"></label>
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
    function orderDetail(val) {
        var ad = $(val).data('name');
        var id = $(val).data('id');
        $('#alici').text('asd');
        $('#alicitel').text();
        $('#aliciadres').text();
        $('#satici').text();
        $('#adet').text();
        $('#tutar').text();
        $('#konum').text();
        $('#urun').text();
        $.ajax({
            type: "GET",
            url: '/tumsiparisdetay/'+id,
            dataType : 'Json',
            success: function (data) {
                $('#alici').text(data['name']+' '+data['surname']);
                $('#alicitel').text(data['tel']);
                $('#aliciadres').text(data['adress']);
                $('#satici').text(data['satici']+' / '+data['mail']);
                $('#adet').text(data['adet']);
                $('#tutar').text(data['tutar']+' TL');
                $('#konum').text(data['location']);
                $('#kargo').text(data['kargo']);
                $('#kargotakip').text(data['takipno']);
                $('#urun').text(ad);
            },
        });
    }
</script>
</html>

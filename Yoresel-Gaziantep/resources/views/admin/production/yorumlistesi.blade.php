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
                                <h2>{{ __('saticiurunler.bekleyenyorumlar') }}</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="dt-buttons btn-group pull-left">
                                    <a href="/toplamyorumlar" ><i class="fa fa-long-arrow-left fa-2x" style="border: 1px solid midnightblue;border-radius: 3px;padding-left: 5px;padding-right: 8px"></i></a>
                                </div>
                                <div id="datatable-buttons_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                    @if(isset($yorumlar) and $yorumlar)
                                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <th class="column1">{{ __('saticiurunler.id') }}</th>
                                                <th class="column2">{{ __('saticiurunler.yorum') }}</th>
                                                <th class="column3">{{ __('saticiurunler.puan') }}</th>
                                                <th class="column8"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $count = 1;
                                            $pagerCount = 1;
                                            ?>
                                            @foreach($yorumlar as $key=>$yorum)
                                                @if($count > (($page-1)*10) && $count<=($page*10))
                                                    <tr style="@if($yorum['checked']==2) background : #32cd3261; @elseif($yorum['checked']==3)  background : #ff120042;  @endif">
                                                        <td class="column1">{{ $yorum['commentId'] }}</td>
                                                        <td class="column2">@if(mb_strlen($yorum['commentDetail'])<75) {{ $yorum['commentDetail'] }} @else{{ mb_substr($yorum['commentDetail'],0,75).'...' }} @endif</td>
                                                        <td class="column3">{{ $yorum['point'] }}</td>
                                                        <td class="column8" width="16%">
                                                            <a data-toggle="modal" data-target="#commentDetailModal" data-id="{{ $yorum['commentId'] }}" onclick="commentDetail(this)"><button type="button" class="btn btn-primary btn-sm">{{ __('saticiurunler.detaylarigor') }}</button></a>
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
                                                            <li class="page-item active"><a class="page-link" href="/urunler?page={{ $pagerCount }}">{{ $pagerCount }}</a></li>
                                                        @else
                                                            <li class="page-item"><a class="page-link" href="/urunler?page={{ $pagerCount }}">{{ $pagerCount }}</a></li>
                                                        @endif
                                                        <?php $pagerCount++; ?>
                                                    @endwhile
                                                </ul>
                                            </div>
                                        </div>
                                    @else
                                        <p>{{ __('saticiurunler.onaybekleyenyorumyok') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="commentDetailModal">
            <div class="modal-dialog">
                <div class="modal-content modal-lg">
                    <!-- Modal Header -->
                    <div class="modal-header" style="padding: 10px">
                        <label class="order-detail-name">{{ __('saticiurunler.yorumdetayi') }}</label>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body" style="padding-left: 35px;padding-right: 35px">
                        <div class="row">
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="order-detail-container">
                                        <label class="order-detail-title">{{ __('saticiurunler.adsoyad') }}</label>
                                        <label class="order-detail-text" id="adsoyad"></label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="order-detail-container">
                                        <label class="order-detail-title">{{ __('saticiurunler.puan') }}</label>
                                        <label class="order-detail-text" id="puan"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="order-detail-container">
                                        <label class="order-detail-title">{{ __('saticiurunler.yorum') }}</label>
                                        <label class="order-detail-text" id="yorum"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <form action="{{ route('adminyorumreddet') }}" method="POST" class="pull-right">
                                @csrf
                                <input name="id" hidden>
                                <button type="submit" class="btn btn-danger btn-sm">{{ __('saticiurunler.reddet') }}</button>
                            </form>
                            <form action="{{ route('adminyorumonayla') }}" method="POST" class="pull-right">
                                @csrf
                                <input name="id" hidden>
                                <button type="submit" class="btn btn-primary btn-sm">{{ __('saticiurunler.onayla') }}</button>
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
<script>
    function commentDetail(val) {
        var id = $(val).data('id');
        $('#adsoyad').text();
        $('#puan').text();
        $('#yorum').text();
        $("input[name='id']").val();
        $.ajax({
            type: "GET",
            url: '/adminyorumdetay/'+id,
            dataType : 'Json',
            success: function (data) {
                $('#adsoyad').text(data['ad']);
                $('#puan').text(data['puan']);
                $('#yorum').text(data['yorum']);
                $("input[name='id']").val(id);
            },
        });
    }
</script>
</body>
</html>

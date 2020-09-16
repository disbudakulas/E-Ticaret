<!DOCTYPE html>
<html lang="en">
@include('/admin/satici/head')

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
                                <h2>{{ __('saticiurunler.bekleyenyorumlar') }}</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div id="datatable-buttons_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                    @if(isset($yorumlar) and $yorumlar)
                                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <th class="column1">{{ __('saticiurunler.id') }}</th>
                                                <th class="column2">{{ __('saticiurunler.adi') }}</th>
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
                                                    <tr>
                                                        <td class="column1">{{ $key }}</td>
                                                        <td class="column2">{{ $yorum['adi'] }}</td>
                                                        <td class="column8" width="16%">
                                                            <a href="/saticiyorumlistesi?id={{ $key }}"><button type="button" class="btn btn-primary btn-sm">{{ __('saticiurunler.yorumlarigor') }}</button></a>
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
        <!-- /page content -->

        <!-- footer content -->
    @include('admin/satici/footer')
    <!-- /footer content -->
    </div>
</div>
</body>
</html>

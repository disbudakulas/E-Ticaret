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
                                <h2>{{ __('kullanicilar.yapilacakodemeler') }}</h2>
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
                                                <th class="column3">{{ __('kullanicilar.tutar') }}</th>
                                                <th class="column4">{{ __('kullanicilar.toplamsiparis') }}</th>
                                                <th class="column8"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $count = 1;
                                        $pagerCount = 1;
                                        ?>
                                        @if(isset($odemeler) and $odemeler)
                                            @foreach($odemeler as $basvuru)
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
        <!-- /page content -->

        <!-- footer content -->
        @include('admin/production/footer')
        <!-- /footer content -->
      </div>
    </div>
  </body>
</html>

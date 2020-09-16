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
                                <h2>{{ __('indirimliurunler.indirimliurunlistesi') }}</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div id="datatable-buttons_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                    <div class="dt-buttons btn-group pull-right">
                                        <a class="btn btn-default buttons-copy buttons-html5 btn-sm btn-primary" tabindex="0" aria-controls="datatable-buttons" href="{{ route('indirimliurunduzenle') }}">
                                            <i class="fa fa-plus"></i><span> {{ __('indirimliurunler.indirimliurunekle') }}</span>
                                        </a>
                                    </div>
                                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="column1">{{ __('indirimliurunler.id') }}</th>
                                                <th class="column2">{{ __('indirimliurunler.resim') }}</th>
                                                <th class="column3">{{ __('indirimliurunler.urunadi') }}</th>
                                                <th class="column4">{{ __('indirimliurunler.saticiunvan') }}</th>
                                                <th class="column5">{{ __('indirimliurunler.fiyat') }}</th>
                                                <th class="column6">{{ __('indirimliurunler.stok') }}</th>
                                                <th class="column7">{{ __('indirimliurunler.durum') }}</th>
                                                <th class="column8"></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $count = 1;
                                        $pagerCount = 1;
                                        ?>
                                        @foreach($urunler as $urun)
                                            @if($count > (($page-1)*10) && $count<=($page*10))
                                                <tr>
                                                    <td class="column1">{{ $urun['id'] }}</td>
                                                    <td class="column2 text-center"><img class="product-list-image-admin" src="{{ $urun['resim'] }}"></td>
                                                    <td class="column3">{{ $urun['ad'] }}</td>
                                                    <td class="column4">{{ $urun['satici'] }}</td>
                                                    <td class="column5">
                                                        <del>{{ number_format($urun['fiyat'], 2) }}</del>
                                                        <p style="font-size: 17px">
                                                            {{ number_format($urun['indirimlifiyat'], 2) }}
                                                            <i class="fa fa-turkish-lira (alias)"></i>
                                                        </p>
                                                    </td>
                                                    <td class="column6">{{ $urun['stok'] }} / {{ __('tanimlar.birim.'.$urun['birim']) }}</td>
                                                    <td class="column7">{{ __('tanimlar.urundurum.'.$urun['durum']) }}</td>
                                                    <td class="column8" width="16%">
                                                        <a href="/indirimliurunsil?id={{ $urun['id'] }}"><button type="button" class="btn btn-danger btn-sm">{{ __('indirimliurunler.sil') }}</button></a>
                                                        <a href="/indirimliurunduzenle?id={{ $urun['id'] }}"><button type="button" class="btn btn-primary btn-sm">{{ __('indirimliurunler.duzenle') }}</button></a>
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

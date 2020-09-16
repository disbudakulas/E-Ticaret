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
                                <h2>{{ __('kullanicilar.kullanicilar') }}</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div id="datatable-buttons_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                    <div class="dt-buttons btn-group pull-right">
                                        <a class="btn btn-default buttons-copy buttons-html5 btn-sm btn-primary" tabindex="0" aria-controls="datatable-buttons" href="{{ route('kullaniciduzenle') }}">
                                            <i class="fa fa-plus"></i><span> {{ __('kullanicilar.kullaniciolustur') }}</span>
                                        </a>
                                    </div>
                                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="column1">{{ __('kullanicilar.id') }}</th>
                                                <th class="column2">{{ __('kullanicilar.adisoyadi') }}</th>
                                                <th class="column3">{{ __('kullanicilar.mail') }}</th>
                                                <th class="column4">{{ __('kullanicilar.bakiye') }}</th>
                                                <th class="column5">{{ __('kullanicilar.yetki') }}</th>
                                                <th class="column6">{{ __('kullanicilar.durum') }}</th>
                                                <th class="column8"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = 1;
                                            $pagerCount = 1;
                                            ?>
                                            @foreach($kullanicilar as $kullanici)
                                                @if($count > (($page-1)*10) && $count<=($page*10))
                                                    <tr @if($kullanici->blocked==1)style="background-color: rgba(255,0,0,0.33)"@endif>
                                                        <td class="column1">{{ $kullanici->id }}</td>
                                                        <td class="column2">{{ $kullanici->name }} {{ $kullanici->surname }}</td>
                                                        <td class="column3">{{ $kullanici->email }}</td>
                                                        <td class="column4">{{ number_format($kullanici->purse, 2) }} <i class="fa fa-turkish-lira (alias)"></i></td>
                                                        <td class="column5">{{ __('tanimlar.yetki.'.$kullanici->authority) }}</td>
                                                        <td class="column6">{{ __('tanimlar.engel.'.$kullanici->blocked) }}</td>
                                                        <td class="column8" width="16%">
                                                            @if($kullanici->blocked == 0)<a href="/kullanicisil?id={{ $kullanici->id }}"><button type="button" class="btn btn-danger btn-sm">{{ __('kullanicilar.sil') }}</button></a>
                                                            @else<a href="/kullanicigerial?id={{ $kullanici->id }}"><button type="button" class="btn btn-info btn-sm">{{ __('kullanicilar.gerial') }}</button></a>@endif
                                                            <a href="/kullaniciduzenle?id={{ $kullanici->id }}"><button type="button" class="btn btn-primary btn-sm">{{ __('kullanicilar.duzenle') }}</button></a>
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
                                                        <li class="page-item active"><a class="page-link" href="/kullanicilar?page={{ $pagerCount }}">{{ $pagerCount }}</a></li>
                                                    @else
                                                        <li class="page-item"><a class="page-link" href="/kullanicilar?page={{ $pagerCount }}">{{ $pagerCount }}</a></li>
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

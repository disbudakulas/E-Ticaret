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
                                <h2>{{ __('kategoriler.kategoriler') }}</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div id="datatable-buttons_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                    <div class="dt-buttons btn-group pull-right">
                                        <a class="btn btn-default buttons-copy buttons-html5 btn-sm btn-primary" tabindex="0" aria-controls="datatable-buttons" href="{{ route('kategoriduzenle') }}">
                                            <i class="fa fa-plus"></i><span> {{ __('kategoriler.kategoriolustur') }}</span>
                                        </a>
                                    </div>
                                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="column1">{{ __('kategoriler.id') }}</th>
                                                <th class="column2">{{ __('kategoriler.kategoriadi') }}</th>
                                                <th class="column3">{{ __('kategoriler.ustkategori') }}</th>
                                                <th class="column4">{{ __('kategoriler.url') }}</th>
                                                <th class="column5">{{ __('kategoriler.ikon') }}</th>
                                                <th class="column6">{{ __('kategoriler.duzenlenmetarihi') }}</th>
                                                <th class="column7">{{ __('kategoriler.olusturmatarihi') }}</th>
                                                <th class="column8"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = 1;
                                            $pagerCount = 1;
                                            ?>
                                            @foreach($kategoriler as $kategori)
                                                @if($count > (($page-1)*10) && $count<=($page*10))
                                                    <tr>
                                                        <td class="column1">{{ $kategori->categoryId }}</td>
                                                        <td class="column2">{{ $kategori->categoryName }}</td>
                                                        <td class="column6">{{ \App\Models\Kategori::Where('categoryId',$kategori->categoryTop)->first()->categoryName??null }}</td>
                                                        <td class="column3">{{ $kategori->categoryUrl }}</td>
                                                        <td class="column4">{{ $kategori->icon }}</td>
                                                        <td class="column5">{{ $kategori->updated_at }}</td>
                                                        <td class="column7">{{ $kategori->created_at }}</td>
                                                        <td class="column8" width="13%">
                                                            <a href="/kategorisil?id={{ $kategori->categoryId }}"><button type="button" class="btn btn-danger btn-sm">Sil</button></a>
                                                            <a href="/kategoriduzenle?id={{ $kategori->categoryId }}"><button type="button" class="btn btn-primary btn-sm">Düzenle</button></a>
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
                                                @while($pagerCount <= $totalPager)
                                                    @if($pagerCount == $page)
                                                        <li class="page-item active"><a class="page-link" href="/kategoriler?page={{ $pagerCount }}">{{ $pagerCount }}</a></li>
                                                    @else
                                                        <li class="page-item"><a class="page-link" href="/kategoriler?page={{ $pagerCount }}">{{ $pagerCount }}</a></li>
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

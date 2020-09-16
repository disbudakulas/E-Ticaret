<!DOCTYPE html>
<html lang="tr">
@include('/admin/production/head')

<body class="nav-md">
<div class="container body">
<div class="main_container">
    @include('admin/production/sidebar')
    @include('admin/production/navbar')
    <div class="right_col" role="main">
        <div class="">
            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2><i class="fa fa-image (alias)"></i> {{ __('logoayarla.logoyukle') }}</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                            <br/>
                            <div class="row text-center">
                                <label class="logo-border">
                                    <img src="{{ $logo }}" style="width: 175px;height: 85px">
                                    <div class="logo-text">
                                        <h4>{{ __('logoayarla.mevcutlogo') }}</h4>
                                    </div>
                                </label>
                            </div>
                            <br/><br/>
                            <div class="row">
                                <a href="/logoyukle" class="btn btn-primary" id="duzenle"><i class="fa fa-plus"></i> {{ __('logoayarla.yenilogoyukle') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin/production/footer')
</div>
</div>
</body>
</html>


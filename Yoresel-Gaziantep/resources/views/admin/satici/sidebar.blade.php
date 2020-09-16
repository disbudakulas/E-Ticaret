<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{route('index')}}" class="site_title"><span>{{ __('sidebaradmin.title') }}</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{asset('adminmaterial/production/images/img.jpg')}}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Hoşgeldin</span>
                <h2>{{ Illuminate\Support\Facades\Auth::user()->name }}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>{{ __('sidebarsatici.saticipaneli') }}</h3>
                <ul class="nav side-menu">
                    <li>
                        <a href="{{route('index')}}"><i class="fa fa-home"></i>{{ __('sidebarsatici.siteyegit') }}</a>
                    </li>
                    <li>
                        <a href="{{route('saticiindex')}}"><i class="fa fa-info"></i>{{ __('sidebarsatici.genelbilgi') }}</a>
                    </li>
                    <li><a ><i class="fa fa-cogs"></i>{{ __('sidebarsatici.hesapyonetimi') }}<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('saticihesap')}}">{{ __('sidebarsatici.hesapayarlari') }}</a></li>
                            <li><a href="{{route('saticiodeme')}}">{{ __('sidebarsatici.odemeayarlari') }}</a></li>
                            <li><a href="#">{{ __('sidebarsatici.hesapbakiye') }}</a></li>
                        </ul>
                    </li>
                    <li><a ><i class="fa fa-dropbox"></i>{{ __('sidebarsatici.urunyonetimi') }}<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('saticiurunleri')}}">{{ __('sidebarsatici.urunler') }}</a></li>
                            <li><a href="{{route('saticiindirimliurunler')}}">{{ __('sidebarsatici.indirimliurunler') }}</a></li>
                            <li><a href="{{route('saticibekleyenyorumlar')}}">{{ __('sidebarsatici.bekleyenyorumlar') }}</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-shopping-cart"></i>{{ __('sidebarsatici.satislar') }}<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('saticisiparisler')}}">{{ __('sidebarsatici.siparisler') }}</a></li>
                            <li><a href="{{route('saticikargoyaverilecekler')}}">{{ __('sidebarsatici.kargoyaverilecekler') }}</a></li>
                            <li><a href="{{route('saticiyapilansatislar')}}">{{ __('sidebarsatici.yapilansatislar') }}</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ route('logout') }}" onclick="event.preventDefault();
               document.getElementById('logout-form').submit();"> <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
                <span class="glyphicon glyphicon-off" aria-hidden="true">
                </span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>

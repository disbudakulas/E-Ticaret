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
                <h3>{{ __('sidebaradmin.adminpaneli') }}</h3>
                <ul class="nav side-menu">
                    <li><a href="{{route('index')}}"><i class="fa fa-home"></i>{{ __('sidebaradmin.siteyegit') }}</a>
                    </li>
                    <li><a href="{{route('adminindex')}}"><i class="fa fa-info"></i>{{ __('sidebaradmin.genelbilgi') }}</a>
                    </li>
                    <li><a ><i class="fa fa-edit"></i>{{ __('sidebaradmin.siteayarlari') }}<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('kategoriler')}}">{{ __('sidebaradmin.kategoriler') }}</a></li>
                            <li><a href="{{route('logo')}}">{{ __('sidebaradmin.logoayarla') }}</a></li>
                            <li><a href="{{route('siteaciklama')}}">{{ __('sidebaradmin.siteaciklamalari') }}</a></li>
                            <li><a href="{{route('icerikduzenle')}}">{{ __('sidebaradmin.icerikduzenle') }}</a></li>
                            <li><a href="{{route('slide')}}">{{ __('sidebaradmin.slideekle') }}</a></li>

                        </ul>
                    </li>
                    <li><a ><i class="fa fa-users"></i>{{ __('sidebaradmin.kullaniciyonetimi') }}<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('kullanicilar')}}">{{ __('sidebaradmin.kullanicilar') }}</a></li>
                            <li><a href="{{route('saticibasvurulari')}}">{{ __('sidebaradmin.saticibasvurusu') }}</a></li>
                            <li><a href="{{route('yapilacakodemeler')}}">{{ __('sidebaradmin.yapilacakodemeler') }}</a></li>
                        </ul>
                    </li>
                    <li><a ><i class="fa fa-dropbox"></i>{{ __('sidebaradmin.urunyonetimi') }}<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('urunler')}}">{{ __('sidebaradmin.urunler') }}</a></li>
                            <li><a href="{{route('indirimliurunler')}}">{{ __('sidebaradmin.indirimliurunler') }}</a></li>
                            <li><a href="{{ route('toplamyorumlar') }}">{{ __('sidebaradmin.urunyorumlari') }}</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-shopping-cart"></i>{{ __('sidebaradmin.satislar') }}<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('toplamsiparisler')}}">{{ __('sidebaradmin.siparisler') }}</a></li>
                            <li><a href="{{route('toplamkargoyaverilecekler')}}">{{ __('sidebaradmin.kargoyaverilecekler') }}</a></li>
                            <li><a href="{{route('toplamyapilansatislar')}}">{{ __('sidebaradmin.yapilansatislar') }}</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-desktop"></i> Genel Ayarlar <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="#">Ödeme Ayarlar</a></li>
                            <li><a href="#">Kargo Ayarları</a></li>
                            <li><a href="{{ route('ucretlendirme') }}">Ücretlendirme</a></li>
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

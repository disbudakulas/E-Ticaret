<a type="button" class="btn btn-default add-to-cart" data-toggle="modal" data-target="#loginModal"><i class="fa fa-shopping-cart"></i>{{ __('shopping.sepeteekle') }}</a>

<style>
    .tab {
        overflow: hidden;
    }
    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 20px;
        font-weight: 800;
        color: #818181;
    }
    .tab button:hover {
        color: #ffa300;
    }
    .tab button.active {
        color: orange;
    }
    .tabcontent {
        display: none;
        padding: 6px 12px;
    }
    .tablinks{
        width:50%;
    }
    .form-control{
        margin-bottom: 10px;
    }
    .login-modal-button{
        display: block;
        background: #FE980F;
        color: #ffffff;
        font-weight: 400;
    }
    .login-modal-button:hover{
        color: #5e5e5e;
        background: #FE980F;
        font-weight: 500;
    }
</style>
<div class="modal" id="loginModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header" style="padding: 10px">
                <h4 class="modal-title" style="font-weight: 900;color: orange;font-size: 25px">{{ __('shopping.uyegirisi') }}</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="tab">
                    <button class="tablinks" onclick="openCity(event, 'girisyap')" id="defaultOpen">{{ __('shopping.girisyap') }}</button>
                    <button class="tablinks" onclick="openCity(event, 'uyeol')">{{ __('shopping.uyeol') }}</button>
                </div>
                <div id="girisyap" class="tabcontent">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror"  value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('shopping.email') }}" />
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('shopping.sifre') }}" required autocomplete="current-password" />
                        <span>
                            <a class="forgot-password" href="#">{{ __('shopping.sifremiunuttum') }}</a>
                        </span>
                        <button type="submit" class="btn btn-default login-modal-button">{{ __('shopping.girisyap') }}</button>
                    </form>
                </div>

                <div id="uyeol" class="tabcontent">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"  required autocomplete="name" placeholder="{{ __('shopping.isim') }}"/>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        <input type="text" class="form-control @error('surname') is-invalid @enderror" name="surname"  required autocomplete="surname" placeholder="{{ __('shopping.soyisim') }}"/>
                        @error('surname')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email" placeholder="{{ __('shopping.email') }}"/>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ __('shopping.sifre') }}"/>
                        <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('shopping.sifretekrar') }}"/>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        <label class="form-campaing-check">{{ __('shopping.kampanyahaberdar') }}
                            <input type="checkbox" name="campaing">
                            <div class="form-campaing-check-input"></div>
                        </label>
                        <button type="submit" class="btn btn-default login-modal-button">{{ __('shopping.kayitol') }}</button>
                        <label class="form-read-info">
                            Kişisel verileriniz, Aydınlatma Metni kapsamında işlenmektedir. "Kayıt Ol" butonuna basarak Üyelik Sözleşmesi’ni, Rıza Metni’ni, Gizlilik ve Çerez Politikası’nı okuduğunuzu ve kabul ettiğinizi onaylıyorsunuz.
                        </label>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>

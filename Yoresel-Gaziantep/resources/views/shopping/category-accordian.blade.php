<h2>Kategoriler</h2>
<div class="panel-group category-products" id="accordian"><!--category-productsr-->
    @if(isset($kategoriler))
        @foreach($kategoriler['ust'] as $kategori=>$value)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#{{ $kategori }}">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            {{ $value['ad'] }}
                        </a>
                    </h4>
                </div>
                <div id="{{ $kategori }}" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            @if(isset($kategoriler[$kategori]))
                                @foreach($kategoriler[$kategori] as $menu)
                                    <li><a href="#">{{ $menu['ad'] }} </a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div><!--/category-products-->

/*price range*/

if ($.fn.slider) {
    $('#sl2').slider();
}

var RGBChange = function () {
    $('#RGB').css('background', 'rgb(' + r.getValue() + ',' + g.getValue() + ',' + b.getValue() + ')')
};

/*scroll to top*/

$(document).ready(function () {
    $(function () {
        $.scrollUp({
            scrollName: 'scrollUp', // Element ID
            scrollDistance: 300, // Distance from top/bottom before showing element (px)
            scrollFrom: 'top', // 'top' or 'bottom'
            scrollSpeed: 300, // Speed back to top (ms)
            easingType: 'linear', // Scroll to top easing (see http://easings.net/)
            animation: 'fade', // Fade, slide, none
            animationSpeed: 200, // Animation in speed (ms)
            scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
            //scrollTarget: false, // Set a custom target element for scrolling to the top
            scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
            scrollTitle: false, // Set a custom <a> title if required.
            scrollImg: false, // Set true to use image
            activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
            zIndex: 2147483647 // Z-Index for the overlay
        });
    });
});

function siteTopMenu() {
    var x = document.getElementById("site-top-menu");
    if (x.className === "site-top-menu") {
        x.className += " responsive";
    } else {
        x.className = "site-top-menu";
    }
}

var productDetailsSlideIndex = 1;
productDetailshowDivs(productDetailsSlideIndex);

function productDetailplusDivs(n) {
    productDetailshowDivs(productDetailsSlideIndex += n);
}

function productDetailcurrentDiv(n) {
    productDetailshowDivs(productDetailsSlideIndex = n);
}

function productDetailshowDivs(n) {
    var i;
    var x = document.getElementsByClassName("product-details-slide-image");
    var dots = document.getElementsByClassName("product-details-slide-mini-image");
    if (n > x.length) {productDetailsSlideIndex = 1}
    if (n < 1) {productDetailsSlideIndex = x.length}
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" product-details-slide-mini-image-select", "");
    }
    x[productDetailsSlideIndex-1].style.display = "block";
    dots[productDetailsSlideIndex-1].className += " product-details-slide-mini-image-select";
}

function itembasketnumbershow(n,name) {
    var x = parseInt($("input[name='"+name+"']").val());
    if((x+n) > 0 && (x+n) <= 999){
        $.ajax({
            type: "GET",
            url: '/sepetguncelle/'+name+'?adet='+n,
            dataType : 'Json',
            success: function (data) {
                $("#total-amount").text(data['artifiyat']);
                $("#kdv").text(data['kdv']);
                $("#geneltoplam").text(data['geneltoplam']);
                $("input[name='"+name+"']").val(x+n);
            },
        });
    }
}
function numberUpdate(val) {
    var x = parseInt($("input[name='"+val+"']").val());
    if((x) > 0 && (x) <= 999){
        $('#guncelle'+val).show();
        $('#sil'+val).hide();
    }else if((x)>999){
        $("input[name='"+val+"']").val(999);
    }else if((x) === 0){
        $('#guncelle'+val).hide();
        $('#sil'+val).show();
    }else{
        $("input[name='"+val+"']").val(0);
        $('#guncelle'+val).hide();
        $('#sil'+val).show();
    }
}
function itembasketnumberupdate(name) {
    var x = parseInt($("input[name='"+name+"']").val());
    if((x) > 0 && (x) <= 999){
        $.ajax({
            type: "GET",
            url: '/sepetguncelle2/'+name+'?adet='+x,
            dataType : 'Json',
            success: function (data) {
                $("#total-amount").text(data['artifiyat']);
                $("#kdv").text(data['kdv']);
                $("#geneltoplam").text(data['geneltoplam']);
                $('#guncelle'+name).hide();
                $('#sil'+name).hide();
            },
        });
    }
}
function itembasketnumberdelete(name) {
    $.ajax({
        type: "GET",
        url: '/sepetsil/'+name,
        dataType : 'Json',
    });
    location.reload();
}
function countSelection(val) {
    $('#select-city').hide();
    $('#select-city2').hide();
    $('#selectCity2').remove();
    $('#select-district').hide();
    if(val === '223'){
        $.ajax({
            type: "GET",
            url: '/ulkesec',
            dataType : 'Json',
            success: function (data) {
                $('#select-city').show();
                $("div[class='stepContainer']").height("100%");
                $.each(data,function (city) {
                    $('#selectCity').append('<option value="'+data[city]['cityId']+'">'+data[city]['name']+'</option>');
                });
            },
        });
    }else{
        $('#select-city2').append('<input type="text" class="form-control" name="il2" id="selectCity2" required autocomplete="name"/>');
        $('#select-city2').show();
        $("div[class='stepContainer']").height("100%");
    }
}
function citySelection(val) {
    $('#select-district').hide();
    $('#select-city2').hide();
    $('#selectCity2').remove();
    $.ajax({
        type: "GET",
        url: '/sehirsec/'+val,
        dataType : 'Json',
        success: function (data) {
            $('#select-district').show();
            $("div[class='stepContainer']").height("100%");
            $.each(data,function (district) {
                $('#selectDistrict').append('<option value="'+data[district]['districtId']+'">'+data[district]['name']+'</option>');
            });
        },
    });
}

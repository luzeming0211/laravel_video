var mySwiper  = new Swiper('.sml_menu_box .swiper-container',{
    freeMode: true,
    freeModeMomentumRatio: 0.5,
    slidesPerView: 'auto'
});

swiperWidth = mySwiper.container[0].clientWidth;
maxTranslate = mySwiper.maxTranslate();
maxWidth = -maxTranslate + swiperWidth / 2;

mySwiper.on('tap', function(swiper, e) {
    slide = swiper.slides[swiper.clickedIndex];
    slideLeft = slide.offsetLeft;
    slideWidth = slide.clientWidth;
    slideCenter = slideLeft + slideWidth / 2;

    mySwiper.setWrapperTransition(300);
    if (slideCenter < swiperWidth / 2) {
        mySwiper.setWrapperTranslate(0)
    } else if (slideCenter > maxWidth) {
        mySwiper.setWrapperTranslate(maxTranslate)
    } else {
        nowTlanslate = slideCenter - swiperWidth / 2;

        mySwiper.setWrapperTranslate(-nowTlanslate);
    }

    $(".sml_menu_box .swiper-container  .active").removeClass('active');
    $(".sml_menu_box .swiper-container .swiper-slide a").removeClass('sele');

    $(".sml_menu_box .swiper-container .swiper-slide").eq(swiper.clickedIndex).addClass('active');
    $(".sml_menu_box .swiper-container .swiper-slide").eq(swiper.clickedIndex).find("a").addClass("sele");

});
$(".cover").click(function(){
    $(".menu_open").hide();
    $(".cover").hide();
    $("#nav_all_box").hide();
});
$(".user").click(function(){
    $(".menu_open").show();
    $(".cover").show();
});
var bannerSwiper = new Swiper('.banner_box .swiper-container', {
    pagination: '.banner_box .swiper-pagination',
    paginationType: 'fraction',
    loop : $('.banner_box .swiper-slide').length>1?true:false,
    autoplay : 3000
});

$(function () {
    //“近期直播”时间
    if($('.video_condition').width()<$('.countdown').width()+$('.video_time').width()) {
        $('.video_time').css({"float":"left","text-align":"left"});
    }
    //定义回顾中图片大小
    $('.review_pic img').height($('.review_pic').width()*252/336);
    $('.review_link').height ($('.review_pic').width()*252/336);


    //菜单
    $('.user').click(function () {
        event.stopPropagation();
        $('.menu_box').addClass("menu_open");
        $('.cover').show();
    });

    //科室
    $('.nav_more').click(function () {
        event.stopPropagation();
        $('.nav_all_box').addClass("nav_all_show");
        $('.cover').show();
        $('.nav_all_box').show();
    });
    $('.nav_all_tit').click(function () {
        event.stopPropagation();
        $('.nav_all_box').removeClass("nav_all_show");
        $('.cover').hide();
    });

})

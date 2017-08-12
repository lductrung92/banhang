
// main menu
$(document).ready(function(){
	var list = $('ul.menu_child');
	$.each(list, function(i, value) {
		if($(value).hasClass('levlups')){
			$(value).prev('a').append(' <i class="fa fa-angle-right" aria-hidden="true"></i>');
		} else {
			$(value).prev('a').append(' <i class="fa fa-angle-down" aria-hidden="true"></i>');
		}
	});

	// $('ul.menu_child').hasClass('levlup_2').prev('a').append(' <i class="fa fa-angle-down" aria-hidden="true"></i>');
	
})
// scroll
jQuery(document).ready(function() {

	//Check to see if the window is top if not then display button
	jQuery(window).scroll(function() {
		if ($(this).scrollTop() > 100) {
			$('.fixedItem').fadeIn();
		} else {
			$('.fixedItem').fadeOut();
		}
	});

	//Click event to scroll to top
	jQuery('.backtop a').click(function() {
		$('html, body').animate({
			scrollTop: 0
		}, 600);
		return false;
	});

});

// slide
$(document).ready(function(){
	if($('#slider-menu .owlSlider').children().size() > 1 ){
		$('#slider-menu .owlSlider').owlCarousel({
			items:1,
			loop: false,
			smartSpeed: 800,
			autoplay:false,
			autoplayTimeout:5000,
			nav : true,
			navText: ['‹', '›'],
			autoplayHoverPause:true
		});
	}
	$('#slider-menu .owlSlider').on('changed.owl.carousel', function(event) {
		var index = event.item.index;
		if ( $('#slider-thumb li').hasClass('click-event') ){
			$('#slider-thumb li').removeClass('click-event');
		}else {	
			$('#slider-thumb li').removeClass('active');
			$('#slider-thumb li').eq(index).addClass('active');
		}
		
	})

	var owl_data = jQuery("#slider-menu .owlSlider").data('owlCarousel');
	jQuery('#slider-thumb li .slider-image-thumb').click(function(){
		jQuery(this).parent('li').addClass('click-event');
		jQuery('#slider-thumb li').removeClass('active');
		jQuery(this).parent('li').addClass('active');
		var index = jQuery(this).parent('li').index();
		owl_data.to(index);
	});
	jQuery('#slider-thumb li').hover(
		function(){
			var index = jQuery(this).index();
			var obj = jQuery(this);
			if( obj.hasClass('click-event') ){
			} else {
				obj.addClass('click-event');
				jQuery('#slider-thumb li').removeClass('active');
				obj.addClass('active');
				owl_data.to(index);
			}
		},
		function(){
			var index = jQuery(this).index();
			var obj = jQuery(this);
		}
	);
})

// slide product
jQuery(document).ready(function() {
	jQuery('.owl_product_list').owlCarousel({
		items: 4,
		loop: false,
		autoplay: false,
		margin: 0,
		responsiveClass: true,
		nav : true,
		navText: ['‹', '›'],
		responsive: {
			0: {
				items: 1
			},
			320: {
				items: 2
			},
			768: {
				items: 3
			},
			992: {
				items: 4
			}
		}
	})
	jQuery('.product_deal_slide').owlCarousel({
		items: 5,
		loop: false,
		autoplay: false,
		margin: 0,
		responsiveClass: true,
		nav : true,
		navText: ['‹', '›'],
		responsive: {
			0: {
				items: 1
			},
			319: {
				items: 1
			},
			480: {
				items: 2
			},
			768: {
				items: 3
			},
			992: {
				items: 4
			},
			1200: {
				items: 5
			}
		}
	})
	jQuery('.blogs_home_slide').owlCarousel({
		items: 4,
		loop: false,
		autoplay: false,
		margin: 10,
		responsiveClass: true,
		nav : true,
		navText: ['‹', '›'],
		responsive: {
			0: {
				items: 1
			},
			319: {
				items: 1
			},
			450: {
				items: 2
			},
			767: {
				items: 3
			},
			992: {
				items: 4
			},
			1200: {
				items: 4
			}
		}
	})
})

$(document).on('click', '.tool_bar_menu a', function(){
	$('body').toggleClass('open_drawer');
})

$('body').on('touchstart', '.overlay_chir.menu', function() {
	$('body').toggleClass('open_drawer');
})

$('.chir-page').on('click', '.site_user_xs span.open-user', function(){
	$(this).next().toggleClass('open');
})

$(document).on('click', '.open_tabs a', function(){
	$(this).parent().next().toggleClass('open');
})

$(document).on('click', '.chir_menu_mobile li a i', function(e){
	e.preventDefault();
	$(this).parent().toggleClass('open').next().slideToggle();

})

$(document).on('click','.Addcart', function(e){
	e.preventDefault();
	var id = $(this).data('variantid'),
		qty = 1,
		img = $(this).parents('.loop_item').find('.insImageload').clone(),
		title = $(this).parents('.loop_item').find('.pro-name a').clone(),
		price = $(this).parents('.loop_item').find('.pro-price').clone();
	ajaxAddCartItem(id,qty,img,title,price);
})

$(document).on('click','.addToCartModal', function(e){
	e.preventDefault();
	var id = $('select#product-selectors').val(),
		qty = $('#quick-view-modal .form-input input[type=number]').val(),
		img = $('#quick-view-modal .image-zoom > img').clone(),
		title = $('#quick-view-modal .product-title.p-title h3').clone(),
		price = $('#quick-view-modal .product-price').clone();
	ajaxAddCartItem(id,qty,img,title,price);
	$('#quick-view-modal').modal('hide');
})

// load tab product
$(document).on('click', '.product_tabs .nav-tabs>li>a', function(){
	var _url = $(this).parent().data('url');
	var _div = $(this).attr('href');
	if($(_div).children().size() == 0 ){
		if( _url == null || _url == '' ){
			$(_div).append('<div class="noproduct" ><p class="text-center">Hiện tại chưa có sản phẩm nào trong danh mục này!...</p></div>')
		}else{
			$('.overlay_load').remove();
			Ajax_getProductHome(_div,_url);
		}
	}
})

function Ajax_getProductHome(div,url){
	var $div = $(div);
	$div.parents('.main').append('<div class="overlay_load"><div class="loadding_send"><div class="bounceball"></div><div class="text">Đang tải</div></div></div>');
	$('.overlay_load').width($div.parent().width());
	$.ajax({
		url: url + '?view=view-home',
		beforeSend: function(){
			$('.overlay_load').show();
		},
		complete: function(data){
			$div.html(data.responseText);
			setTimeout(function(){
				$('.overlay_load').fadeOut(500);
			},1000)
		}
	})
}
function ajaxAddCartItem(id,qty,img,title,price){
	var $modalCart = $('#addCartModal'),
		$modalDetail = $modalCart.find('.imgCartDetail'),
		curentCart = parseInt($('span#count_Cart').text());
	$modalCart.find('.imgCartItem').html(img);
	$modalDetail.find('.itemCartTile').html(title);
	$modalDetail.find('.itemCartPrice').html(price);
	$modalDetail.find('.itemCartQty').html('Số lương mua: ' + qty);
	$.ajax({
		type: "POST",
		url: "/cart/add.js",
		data: "quantity=" + qty + "&VariantId=" + id,
		dataType: "json",
		success: function(t) {
			$modalCart.modal('show');
			$('.CartCount').text(curentCart + qty);
		},
		error: function(t, r) {
			Bizweb.onError(t, r)
		}
	})
}

$(window).on('load resize', function(){
	var _w = $(window).height();
	$('ul.chir_menu_mobile').height(_w - 50);
	if($(window).width() < 768){
		$('#left_column .block .block_content.filter_xs').height(_w - 65);
	}
})
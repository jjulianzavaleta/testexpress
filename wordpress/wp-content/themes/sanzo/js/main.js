jQuery(document).ready(function($){
	"use strict";
	var on_touch = ts_is_touch_device();
	
	/** Remove empty paragraph **/
	$('p:empty').remove();
	
	/** Mega menu **/
	ts_mega_menu_change_state($('body').innerWidth());
	$('.widget_nav_menu .menu-item-has-children .sub-menu').before('<span class="ts-menu-drop-icon"></span>');
	
	/** Menu on IPAD **/
	if( on_touch || $(window).width() < 768 ){
		ts_menu_action_on_ipad();
	}
	
	/** Menu on onepage **/
	$('.ts-header .menu a').on('click', function(e){
		var href = $(this).attr('href');
		if( href.indexOf('#') == 0 ){
			var section = $(href);
			if( section.length != 0 ){
				e.preventDefault();
				var offset_top = section.offset().top;
				if( $(window).width() > 1229 && $('header .sticky-wrapper').length > 0 ){ /* sticky menu */
					offset_top -= $('header .sticky-wrapper').height();
				}
				if( $('#wpadminbar').length > 0 ){
					offset_top -= $('#wpadminbar').height();
				}
				$('body, html').animate({
					scrollTop: offset_top
				}, 1000);
				return false;
			}
		}
	});
	
	/** Sticky Menu **/
	if( typeof _ts_enable_sticky_header != 'undefined' && _ts_enable_sticky_header ){
		ts_sticky_menu();
	}
	
	/** Header incline width **/
	ts_header_incline_width();
	
	/** Resize orientationchange action **/
	$(window).on('resize orientationchange', $.throttle(250, function(){
		ts_mega_menu_change_state($('body').innerWidth());
		ts_set_cloud_zoom();
		ts_header_incline_width();
	}));
	
	/** Tini account **/
	if( on_touch ){ /* Tiny account and tiny cart dropdown on IPAD */
		$('.ts-tiny-cart-wrapper span.drop-icon').live('click', function(){
			var dropdown_form = $(this).parent().siblings('.dropdown-container');
			$(this).parent().parent().toggleClass('active');
			
			return false;
		});
	}
	
	/** Header Currency - Language selector on mobile **/
	if( on_touch ){
		$('.header-currency a.wcml_selected_currency').bind('click', function(){
			$('.header-currency').toggleClass('active');
		});
		$('.header-language a.lang_sel_sel').bind('click', function(){
			$('.header-language').toggleClass('active');
			return false;
		});
	}
	
	/** Header Product Categories Slider **/
	ts_header_product_categories_slider();
	
	/** Header Search Popup **/
	if( $('#ts-search-popup').length > 0 ){
		$('header.ts-header .search-wrapper i').on('click', function(){
			$('#ts-search-popup').fadeIn();
			$('#ts-search-popup-overlay').fadeIn();
		});
		$('#ts-search-popup-overlay, #ts-search-popup .ts-button-close').on('click', function(){
			$('#ts-search-popup').fadeOut();
			$('#ts-search-popup-overlay').fadeOut();
		});
	}
	
	/** To Top button **/
	if( $('html').offset().top < 100 ){
		$("#to-top").hide().addClass("off");
	}
	$(window).scroll(function(){
		if( $(this).scrollTop() > 100 ){
			$("#to-top").removeClass("off").addClass("on");
		} else {
			$("#to-top").removeClass("on").addClass("off");
		}
	});
	$('#to-top .scroll-button').click(function(){
		$('body,html').animate({
			scrollTop: '0px'
		}, 1000);
		return false;
	});
	
	/** Quickshop **/
	ts_quickshop_handle();
	
	
	/** Wishlist **/
	$('body').bind('added_to_wishlist', function(){
		ts_update_tini_wishlist();
		$('.yith-wcwl-wishlistaddedbrowse.show, .yith-wcwl-wishlistexistsbrowse.show').closest('.button-in.wishlist').addClass('added');
	});
	
	$(document).on('click', '#yith-wcwl-form table tbody tr td a.remove, #yith-wcwl-form table tbody tr td a.add_to_cart_button', function(){
		var old_num_product = $('#yith-wcwl-form table tbody tr[id^="yith-wcwl-row"]').length;
		var count = 1;
		var time_interval = setInterval(function(){
			count++;
			var new_num_product = $('#yith-wcwl-form table tbody tr[id^="yith-wcwl-row"]').length;
			if( old_num_product != new_num_product || count == 20 ){
				clearInterval(time_interval);
				ts_update_tini_wishlist();
			}
		},500);
	});
	
	/** Compare **/
	if( !on_touch && $(window).width() > 767 ){
		setTimeout(function(){
			ts_compare_change_scroll_bar();
		},1000);
	}
	
	/*** Set Cloud Zoom ***/
	ts_set_cloud_zoom();
	
	if( $('.cloud-zoom, .cloud-zoom-gallery').length > 0 ){
		$('form.variations_form').live('found_variation',function( event, variation ){
			$('.cloud-zoom, .cloud-zoom-gallery').CloudZoom({}); 
		}).live('reset_image',function(){
			$('.cloud-zoom, .cloud-zoom-gallery').CloudZoom({});
		});
	}
	
	/*** Product Image Lightbox ***/
	if( $('body').hasClass('single-product') && typeof PhotoSwipe !== 'undefined' ){
	
		$('.images-thumbnails').on('click', '.woocommerce-product-gallery__image a', function( e ){
			e.preventDefault();
			var items = ts_get_single_product_gallery_items();
			var index = $(this).find('img').attr('data-index');
			var pswpElement = $( '.pswp' )[0];
			var options = {
				index:                 	parseInt(index)
				,shareEl:               false
				,closeOnScroll:         false
				,history:               false
				,hideAnimationDuration: 0
				,showAnimationDuration: 0
			};
			var photoswipe = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options );
			photoswipe.init();
		});
		
	}
	
	function ts_get_single_product_gallery_items(){
		var items = [];
		$('.images-thumbnails .woocommerce-product-gallery__image a').each(function(index, ele){
			if( $(ele).parents('.owl-item.cloned').length == 0 ){
				var img = $(ele).find('img');
				var large_image_src = img.attr( 'data-large_image' );
				var large_image_w   = img.attr( 'data-large_image_width' );
				var large_image_h   = img.attr( 'data-large_image_height' );
				var item            = {
					src: large_image_src,
					w:   large_image_w,
					h:   large_image_h,
					title: img.attr( 'title' )
				};
				items.push( item );
			}
		});
		
		if( $('.vertical-thumbnail').length > 0 && items.length > 1 ){
			var main_thumbnail = items.pop();
			items.unshift( main_thumbnail );
			
			$('.images-thumbnails > .thumbnails img').each(function(index, ele){
				$(ele).attr('data-index', index + 1);
			});
		}
		
		return items;
	}
	
	/*** Product Stock - Variable Product ***/
	function single_variable_product_reset_stock( wrapper ){
		var stock_html = wrapper.find('p.availability').data('original');
		var classes = wrapper.find('p.availability').data('class');
		if( classes == '' ){
			classes = 'in-stock';
		}
		wrapper.find('p.availability span').html(stock_html);
		wrapper.find('p.availability').removeClass('in-stock out-of-stock').addClass(classes);
	}
	
	$(document).on('found_variation', 'form.variations_form', function(){
		var wrapper = $(this).parents('.summary');
		if( wrapper.find('.single_variation .stock').length > 0 ){
			var stock_html = wrapper.find('.single_variation .stock').html();
			var classes = wrapper.find('.single_variation .stock').hasClass('out-of-stock')?'out-of-stock':'in-stock';
			wrapper.find('p.availability span').html(stock_html);
			wrapper.find('p.availability').removeClass('in-stock out-of-stock').addClass(classes);
		}
		else{
			single_variable_product_reset_stock( wrapper );
		}
	});
	
	$(document).on('reset_image', 'form.variations_form', function(){
		var wrapper = $(this).parents('.summary');
		single_variable_product_reset_stock( wrapper );
	});
	
	/*** Hide product attribute if not available ***/
	$(document).on('update_variation_values', 'form.variations_form', function(){
		if( $(this).find('.ts-product-attribute').length > 0 ){
			$(this).find('.ts-product-attribute').each(function(){
				var attr = $(this);
				var values = [];
				attr.siblings('select').find('option').each(function(){
					if( $(this).attr('value') ){
						values.push( $(this).attr('value') );
					}
				});
				attr.find('.option').removeClass('hidden');
				attr.find('.option').each(function(){
					if( $.inArray($(this).attr('data-value'), values) == -1 ){
						$(this).addClass('hidden');
					}
				});
			});
		}
	});
	
	/*** Custom Orderby on Product Page ***/
	$('form.woocommerce-ordering ul.orderby ul a').on('click', function(e){
		e.preventDefault();
		if( $(this).hasClass('current') ){
			return;
		}
		var form = $(this).closest('form.woocommerce-ordering');
		var data = $(this).attr('data-orderby');
		form.find('select.orderby').val(data).trigger('change');
	});
	
	/*** Select2 - Search by Category ***/
	if( typeof $.fn.select2 == 'function' ){
		$('.ts-search-by-category select.select-category').select2();
		
		var MutationObserver = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver;

		$.fn.attrchange = function(callback) {
			if (MutationObserver) {
				var options = {
					subtree: false,
					attributes: true
				};

				var observer = new MutationObserver(function(mutations) {
					mutations.forEach(function(e) {
						callback.call(e.target, e.attributeName);
					});
				});

				return this.each(function() {
					observer.observe(this, options);
				});
			}
		}
		
		$('.ts-header .ts-search-by-category .select2-container').attrchange(function(attrName){
			if( attrName == 'class' ){
				if( $(this).hasClass('select2-container--open') ){
					$('body > .select2-container--open').addClass('category-dropdown');
				}
				else{
					$('body > .select2-container--open').removeClass('category-dropdown');
				}
			}
		});
		
	}
	
	/*** Widget toggle ***/
	$('.widget-title-wrapper a.block-control').bind('click', function(e){
		e.preventDefault();
		$(this).parent().siblings().slideToggle(400);
        $(this).toggleClass('active');
	});
	
	ts_widget_toggle();
	if( !on_touch ){
		$(window).bind('resize', $.throttle(250, function(){
			ts_widget_toggle();
		}));
	}
	/* Background Parallax */
	if( !on_touch ){
		$(window).bind('load', function(){
			ts_parallax_background();
		});
	}
	
	/* Product Image Lazy Load */
	$(window).bind('load', function(){
		$('img.ts-lazy-load').bind('load', function(){
			$(this).parents('.lazy-loading').removeClass('lazy-loading').addClass('lazy-loaded');
			if( $('img.ts-lazy-load').parents('.lazy-loading').length == 0 ){
				ts_parallax_background();
			}
		});
		
		$('img.ts-lazy-load:not(.product-image-back)').each(function(){
			if( $(this).data('src') ){
				$(this).attr('src', $(this).data('src'));
			}
		});
		
		/* Load back image after */
		$('img.ts-lazy-load.product-image-back').each(function(){
			if( $(this).data('src') ){
				$(this).attr('src', $(this).data('src'));
			}
		});
	});
	
	/* WooCommerce Quantity Increment */
	ts_woocommerce_quantity_increment($);
	
	/* Ajax Search */
	if( typeof _ts_enable_ajax_search != 'undefined' && _ts_enable_ajax_search ){
		ts_ajax_search();
	}
	
	$('.header-v7 .search-pc input[type="submit"], .header-v8 .search-pc input[type="submit"]').on('click', function(){
		var submit_button = $(this);
		submit_button.parents('.search-pc').toggleClass('active');
		setTimeout(function(){
			submit_button.parents('form').find('input[name="s"]').focus();
		}, 100);
		return false;
	});
	
	$('.header-v7 .search-pc input[name="s"], .header-v8 .search-pc input[name="s"]').keydown(function(e){
		var key_code = (e.keyCode ? e.keyCode : e.which);
		if( key_code == 13 ){
			$(this).parents('form').submit();
		}
	});
	
	/* Ajax Remove Cart Item */
	if( !$('body').hasClass('woocommerce-cart') && !$('body').hasClass('woocommerce-checkout') ){
		$(document).on('click', '.cart-item-wrapper .remove', function(){
			$(this).closest('li').addClass('loading');
		});
	}
	else{
		$(document.body).off('click', '.remove_from_cart_button');
	}
	
	/* Like post */
	ts_ajax_update_post_like();
	
	/* Single post - Related posts - Gallery slider */
	$(window).bind('load', function(){
		ts_single_related_post_gallery_slider();
	});
	
	/* Single Product - Variable Product options */
	$(document).on('click', '.variations_form .ts-product-attribute .option a', function(){
		var _this = $(this);
		var val = _this.closest('.option').data('value');
		var selector = _this.closest('.ts-product-attribute').siblings('select');
		if( selector.length > 0 ){
			if( selector.find('option[value="' + val + '"]').length > 0 ){
				selector.val(val).change();
				_this.closest('.ts-product-attribute').find('.option').removeClass('selected');
				_this.closest('.option').addClass('selected');
			}
		}
		return false;
	});
	
	$('.variations_form').on('click', '.reset_variations', function(){
		$(this).closest('.variations').find('.ts-product-attribute .option').removeClass('selected');
	});
	
	/* Product thumbnails slider */
	if( $('.single-product').length > 0 ){
		/* Horizontal slider */
		var wrapper = $('.single-product .product:not(.vertical-thumbnail) .images-thumbnails .thumbnails.loading');
		wrapper.find('.product-thumbnails').owlCarousel({
				loop : true
				,nav : true
				,navText : [,]
				,dots : false
				,navSpeed : 1000
				,rtl: $('body').hasClass('rtl')
				,margin: 15
				,navRewind: false
				,autoplay: true
				,autoplayHoverPause: true
				,autoplaySpeed: 1000
				,responsiveBaseElement: wrapper
				,responsiveRefreshRate: 1000
				,responsive:{
					0:{
						items : 1
					},
					150:{
						items : 2
					},
					300:{
						items : 3
					},
					450:{
						items : 4
					},
					600:{
						items : 5
					},
					800:{
						items : 6
					}
				}
				,onInitialized: function(){
					wrapper.addClass('loaded').removeClass('loading');
				}
			});
			
			/* Vertical slider */
			var wrapper = $('.single-product .product.vertical-thumbnail .images-thumbnails .thumbnails.loading');
			
			if( wrapper.length > 0 && typeof $.fn.carouFredSel == 'function' ){
				var items = 3;
				
				var _slider_data = {
						items: items
						,direction: 'up'
						,width: 'auto'
						,height: '150px'
						,infinite: true
						,prev: wrapper.find('.owl-prev').selector
						,next: wrapper.find('.owl-next').selector
						,auto: {
							play: true
							,timeoutDuration: 5000
							,duration: 800
							,delay: 3000
							,items: 1
							,pauseOnHover: true
						}
						,scroll: {
							items: 1
						}
						,swipe: {
							onTouch: true
							,onMouse: true
						}
						,onCreate: function(){
							wrapper.addClass('loaded').removeClass('loading');
						}
					};
					
				wrapper.find('.product-thumbnails').carouFredSel(_slider_data);
				
				$(window).bind('load', function(){
					$(window).trigger('resize');
				});
				
				$(window).bind('resize orientationchange', $.debounce( 250, function(){
					if( $(window).width() < 420 ){
						_slider_data.items = 2;
					}
					else if( $(window).width() < 500 ){
						_slider_data.items = 3;
					}
					else if( $(window).width() < 768 ){
						_slider_data.items = 4;
					}
					else{
						_slider_data.items = items;
					}
					wrapper.find('.product-thumbnails').trigger('configuration', _slider_data);
				} ));
			}
	}
	
	/* Single Product Video */
	jQuery('a.ts-product-video-button').prettyPhoto({
		deeplinking: false
		,opacity: 0.9
		,social_tools: false
		,default_width: 745
		,default_height: 420
		,theme: 'ts-product-video'
		,changepicturecallback: function(){
			jQuery('.ts-product-video').addClass('loaded');
		}
	});
	
	/* Related - Upsell - Crosssell products slider */
	$('.single-product .related .products, .single-product .upsells .products, .woocommerce .cross-sells .products').each(function(){
		var _this = $(this);
		if( _this.find('.product').length > 1 ){
			_this.owlCarousel({
				loop : true
				,nav : true
				,navText : [,]
				,dots : false
				,navSpeed : 1000
				,rtl: $('body').hasClass('rtl')
				,margin: 20
				,navRewind: false
				,responsiveBaseElement: _this
				,responsiveRefreshRate: 1000
				,responsive:{
								0:{
									items : 1
								},
								310:{
									items : 2
								},
								450:{
									items : 3
								},
								750:{
									items : 4
								},
								1170:{
									items : 5
								}
							}
			});
		}
	});
	
	/* Background Video */
	$(window).bind('load', function(){
		/* Background Video - Youtube Video */
		if( typeof $.fn.YTPlayer == 'function' ){
			$('.ts-youtube-video-bg').each(function(index, element){
				var selector = $(this);
				var poster = selector.data('poster');
				var property = selector.data('property') && typeof selector.data('property') == 'string' ? eval('(' + selector.data('property') + ')') : selector.data('property');
				var vol = 50;
				if( property.mute ){
					vol = 0;
				}
				if( ! on_touch ) {
					var player = selector.YTPlayer({mute: property.mute, vol: vol});
					
					player.on('YTPStart',function(){
						selector.removeClass('pausing playing').addClass('playing');
						selector.closest('.vc_row').addClass('playing');
						if( poster ){
							selector.css({'background-image':''});
							selector.find('.mbYTP_wrapper').css({'opacity':1});
						}
						if( property.mute ){
							player.get(0).player.mute();
						}
					});
					
					player.on('YTPPause', function(){
						selector.removeClass('pausing playing').addClass('pausing');
						selector.closest('.vc_row').removeClass('playing');
						if( poster ){
							selector.css({'background-image':'url(' + poster + ')'});
							selector.find('.mbYTP_wrapper').css({'opacity':0});
						}
					});
					
					player.on('YTPChanged', function(){
						if( !property.autoPlay && poster ){
							selector.css({'background-image':'url(' + poster + ')'});
						}
					});
				}
				else if( poster ) {
					selector.css({'background-image':'url(' + poster + ')'});
				}
			});
		}
		
		/* Background Video - Hosted Video */
		$('.ts-hosted-video-bg').each(function(){
			var selector = $(this);
			var video = selector.find('video');
			var video_dom = selector.find('video').get(0);
			if( video.hasClass('loop') ){
				video_dom.loop = true;
			}
			if( video.hasClass('muted') ){
				video_dom.muted = true;
			}
			
			var poster = selector.data('poster');
			if( poster ){
				selector.css({'background-image':'url(' + poster + ')'});
			}
			
			var control = selector.find('.video-control');
			control.bind('click', function(){
				if( ! selector.hasClass('playing') ){
					video_dom.play();
					selector.css({'background-image':''});
					selector.removeClass('pausing').addClass('playing');
					selector.closest('.vc_row').addClass('playing');
				}
				else{
					video_dom.pause();
					if( poster ){
						selector.css({'background-image':'url(' + poster + ')'});
					}
					selector.removeClass('playing').addClass('pausing');
					selector.closest('.vc_row').removeClass('playing');
				}
			});
			if( ! on_touch ){
				selector.addClass('pausing');
				if( video.hasClass('autoplay') ){
					control.trigger('click');
				}
			}
		});
	});
	
	/* Accordion - scroll to activated tab */
	$('.single-product .vc_tta-accordion .vc_tta-panel-heading').bind('click', function(){
		if( $(this).parents('.vc_tta-panel').hasClass('vc_active') ){
			return;
		}
		var acc_header = $(this);
		var header_sticky = 0;
		if( !on_touch ){
			if( $('.is-sticky .header-sticky').length > 0 ){
				header_sticky = $('.is-sticky .header-sticky').height();
			}
			else if( typeof _ts_enable_sticky_header != 'undefined' && _ts_enable_sticky_header && $('.header-sticky').length > 0 ){
				header_sticky = $('.header-sticky').height();
			}
		}
		setTimeout(function(){
			$('body,html').animate({
				scrollTop: acc_header.offset().top - acc_header.height() - header_sticky
			}, 600);
		}, 600);
	});
	
	if( $('.woocommerce-tabs.accordion-tabs').length > 0 ){
		$('a.woocommerce-review-link').bind('click', function(){
			var acc_header = $('#reviews').parents('.vc_tta-panel-body').siblings('.vc_tta-panel-heading');
			if( !acc_header.parents('.vc_tta-panel').hasClass('vc_active') ){
				setTimeout(function(){
					acc_header.trigger('click');
					acc_header.find('.vc_tta-panel-title a').trigger('click');
				}, 100);
			}
		});
	}
	
	/* Custom WP Widget Categories Dropdown */
	$('.widget_categories > ul').each(function(index, ele){
		var _this = $(ele);
		var icon_toggle_html = '<span class="icon-toggle"></span>';
		var ul_child = _this.find('ul.children');
		ul_child.hide();
		ul_child.closest('li').addClass('cat-parent');
		ul_child.before( icon_toggle_html );
	});
	
	$('.widget_categories span.icon-toggle').bind('click', function(){
		var parent_li = $(this).parent('li.cat-parent');
		if( !parent_li.hasClass('active') ){
			parent_li.find('ul.children:first').slideDown();
			parent_li.addClass('active');
		}
		else{
			parent_li.find('ul.children').slideUp();
			parent_li.removeClass('active');
			parent_li.find('li.cat-parent').removeClass('active');
		}
	});
	
	$('.widget_categories li.current-cat').parents('ul.children').siblings('.icon-toggle').trigger('click');
	
	/* Blog widget */
	$('.ts-blogs-widget-wrapper.ts-slider').each(function(){
		var element = $(this);
		var show_nav = element.data('show_nav') == 1;
		var auto_play = element.data('auto_play') == 1;
		
		element.owlCarousel({
				loop : true
				,items : 1
				,nav : show_nav
				,navText: [,]
				,dots : false
				,margin: 10
				,navSpeed : 1000
				,slideBy: 1
				,rtl: $('body').hasClass('rtl')
				,navRewind: false
				,autoplay: auto_play
				,autoplayTimeout: 5000
				,autoplayHoverPause: true
				,autoplaySpeed: false
				,mouseDrag: true
				,touchDrag: true
				,responsiveRefreshRate: 1000
				,responsive:{ /* Fix for mobile */
					0 : {
						items : 1
					}
				}
				,onInitialized: function(){
					element.addClass('loaded').removeClass('loading');
				}
			});
	});
	
	/* Product Categories widget */
	$('.widget-container.ts-product-categories-widget .icon-toggle').bind('click', function(){
		var parent_li = $(this).parent('li.cat-parent');
		if( !parent_li.hasClass('active') ){
			parent_li.addClass('active');
			parent_li.find('ul.children:first').slideDown();
		}
		else{
			parent_li.find('ul.children').slideUp();
			parent_li.removeClass('active');
			parent_li.find('li.cat-parent').removeClass('active');
		}
	});
	$('.widget-container.ts-product-categories-widget').each(function(){
		var element = $(this);
		
		var parent_li = element.find('ul.children').parent('li');
		parent_li.addClass('cat-parent');
		
		element.find('li.current').parents('ul.children').siblings('.icon-toggle').trigger('click');
	});
	
	/* Product Filter By Availability */
	$('.product-filter-by-availability-wrapper > ul input[type="checkbox"]').bind('change', function(){
		$(this).parent('li').siblings('li').find('input[type="checkbox"]').attr('checked', false);
		var val = '';
		if( $(this).is(':checked') ){
			val = $(this).val();
		}
		var form = $(this).closest('ul').siblings('form');
		if( val != '' ){
			form.find('input[name="stock"]').val(val);
		}
		else{
			form.find('input[name="stock"]').remove();
		}
		form.submit();
	});
	
	/* Product Widget */
	$('.ts-products-widget-wrapper.ts-slider').each(function(){
		var element = $(this);
		var show_nav = element.data('show_nav') == 1;
		var auto_play = element.data('auto_play') == 1;
		
		element.owlCarousel({
					loop : true
					,items : 1
					,nav : show_nav
					,navText: [,]
					,dots : false
					,navSpeed : 1000
					,slideBy: 1
					,rtl: $('body').hasClass('rtl')
					,navRewind: false
					,autoplay: auto_play
					,autoplayTimeout: 5000
					,autoplayHoverPause: true
					,autoplaySpeed: false
					,mouseDrag: true
					,touchDrag: true
					,responsiveRefreshRate: 1000
					,responsive:{ /* Fix for mobile */
						0 : {
							items : 1
						}
					}
					,onInitialized: function(){
						element.addClass('loaded').removeClass('loading');
					}
				});
	});
	
	/* Recent Comment Widget */
	$('.ts-recent-comments-widget-wrapper.ts-slider').each(function(){
		var element = $(this);
		var show_nav = element.data('show_nav') == 1;
		var auto_play = element.data('auto_play') == 1;
		
		element.owlCarousel({
					loop : true
					,items : 1
					,margin : 10
					,nav : show_nav
					,navText: [,]
					,dots : false
					,navSpeed : 1000
					,slideBy: 1
					,rtl: $('body').hasClass('rtl')
					,navRewind: false
					,autoplay: auto_play
					,autoplayTimeout: 5000
					,autoplayHoverPause: true
					,autoplaySpeed: false
					,mouseDrag: true
					,touchDrag: true
					,responsiveRefreshRate: 1000
					,responsive:{ /* Fix for mobile */
						0 : {
							items : 1
						}
					}
					,onInitialized: function(){
						element.addClass('loaded').removeClass('loading');
					}
				});
	});
	
	/* Product Category Filter Section */
	$('.ts-product-filter-wrapper > .icons .icon').on('click', function(){
		if( !$(this).hasClass('active') ){
			var id = $(this).data('id');
			$('.ts-product-filter-wrapper > .icons .icon').removeClass('active');
			$(this).addClass('active');
			$('.ts-product-filter-wrapper > .widgets').show();
			$('.ts-product-filter-wrapper > .widgets > section').hide();
			$('.ts-product-filter-wrapper > .widgets > section#' + id).show();
		}
		else{
			$(this).removeClass('active');
			$('.ts-product-filter-wrapper > .widgets').hide();
			$('.ts-product-filter-wrapper > .widgets > section').hide();
		}
	});
	
	/* Single Portfolio */
	if( !on_touch && $('.single-portfolio.layout-1').length > 0 && $('.single-portfolio .thumbnails').length > 0 ){
		$(window).bind('scroll', function(){
			var window_width = $(window).width();
			var scroll_top = $(this).scrollTop();
			var content_height = $('.single-portfolio .entry-content').height();
			var thumbnails_height = $('.single-portfolio .thumbnails').height();
			var thumbnails_top = $('.single-portfolio .thumbnails').offset().top;
			if( scroll_top > thumbnails_top && window_width > 767 ){
				var margin = scroll_top - thumbnails_top;
				if( margin + content_height > thumbnails_height ){
					margin = thumbnails_height - content_height;
				}
				if( margin >= 0 ){
					$('.single-portfolio .entry-content').css('margin-top', margin);
				}
			}
			else{
				$('.single-portfolio .entry-content').css('margin-top', 0);
			}
		});
	}
	
	/* Single Portfolio Lightbox */
	$('.single-portfolio .thumbnails a[rel^="prettyPhoto"]').prettyPhoto({
		show_title: false
		,deeplinking: false
		,social_tools: false
	});
	
	/* Compatible with YITH Infinite Scrolling */
	$(document).bind( 'yith_infs_added_elem', function(){
		ts_quickshop_handle();
	});

	$("input[name='quantity']").change(function() {
		var product_id = $(this).data('product_id');
		var quantity = $(this).val();
		var conversion_rate = parseFloat($('#quantity_' + product_id).data('conversion_rate'));
		var converted_quantity = Math.round(quantity / conversion_rate);
		$('#quantity_' + product_id).val(converted_quantity);
	});

	$("select[name='quantity']").change(function() {
		var product_id = $(this).attr('product_id');
		var quantity = $(this).val();
		var conversion_rate = parseFloat($('#quantity_' + product_id).data('conversion_rate'));
		var converted_quantity = Math.round(quantity / conversion_rate);
		$('#quantity_' + product_id).val(converted_quantity);
	});

	$("input[name='quantity-unit']").change(function() {
		var product_id = $(this).data('product_id_reference');
		var quantity = $(this).val();
		var conversion_rate = parseFloat($(this).data('conversion_rate'));
		var converted_quantity = Math.round((quantity * conversion_rate) * 100) / 100;
		$('*[data-product_id="' + product_id + '"]').val(converted_quantity);
		$('*[product_id="' + product_id + '"]').val(converted_quantity);
	});

	/*$("input:checkbox#pickup-another-person-checkbox").click(function() {
        if(!$(this).is(":checked")){
        	$('.dni-container').css('display','none');
        } else {
        	$('.dni-container').css('display','block');
        }
    });*/

	$("#custom_question_field_rbuton_boleta").prop("checked",true);
	$("[for=custom_question_field_rbuton_boleta]").contents().unwrap();
	$("[for=custom_question_field_rbuton_factura]").contents().unwrap();
	$("[for=custom_question_field_rbuton_boleta_propia]").contents().unwrap();
	$('#billing_last_name').val (function () {
		return this.value.toUpperCase();
	});
	$('#billing_first_name').val (function () {
		return this.value.toUpperCase();
	});

});

/*** Mega menu ***/
function ts_mega_menu_change_state(case_size){
	if( typeof case_size == 'undefined' )
		case_size = jQuery('body').innerWidth();
	case_size += ts_get_scrollbar_width();
	
	/* Hide Mobile Menu */
	jQuery('#page').removeClass('toggle-mobile-active');
	jQuery('.ts-mobile-menu-icon-toggle').removeClass('active');
	/* Hide Group Meta Header */
	jQuery('.group-meta-header').show(); /* Resize window */
	if( case_size < 991 ){
		jQuery('.group-meta-header').hide();
		jQuery('.ts-group-meta-icon-toggle').removeClass('active');
		
		jQuery('.ts-group-meta-icon-toggle').off('click');
		jQuery('.ts-group-meta-icon-toggle').on('click', function(){
			jQuery('.group-meta-header').slideToggle(200);
			jQuery(this).toggleClass('active');
		});
	}
	/* Reset dropdown icon class on Ipad */
	jQuery('span.ts-menu-drop-icon').removeClass('active');
	
	if( case_size > 767 ){
		
		/* Menu click header version 5 */
		jQuery('.ic-menu-button').off('click');
		jQuery('.ic-menu-button').on('click', function(){
			jQuery('#page').addClass('menu-active');
		});
		
		jQuery('.ic-close-menu-button').off('click');
		jQuery('.ic-close-menu-button').on('click', function(){
			jQuery('#page').removeClass('menu-active');
		});
		
		/* Remove hide class after loading */
		jQuery('ul.menu li.menu-item').removeClass('hide');
		
		jQuery('nav.main-menu > ul.menu').show(200);
		var padding_left = 0, container_width = 0;
		var container = jQuery('.header-sticky > .container');
		if( container.length <= 0 ){
			container = jQuery('.header-sticky');
			if( container.length <= 0 ){
				return;
			}
			container_width = container.outerWidth();
		}
		else{
			container_width = container.width();
			padding_left = parseInt(container.css('padding-left'));
		}
		var container_offset = container.offset();
		
		setTimeout(function(){
			jQuery('nav.main-menu > ul.menu').children('.ts-megamenu-fullwidth').each(function(index, element){
				var current_offset = jQuery(element).offset();
				var left = current_offset.left - container_offset.left - padding_left;
				jQuery(element).children('ul.sub-menu').css({'width':container_width+'px','left':-left+'px'});
			});
			
			jQuery('nav.main-menu > ul.menu').children('.ts-megamenu-columns-1, .ts-megamenu-columns-2, .ts-megamenu-columns-3, .ts-megamenu-columns-4').each(function(index, element){	
				jQuery(element).children('ul.sub-menu').css({'max-width':container_width+'px'});
				var sub_menu_width = jQuery(element).children('ul.sub-menu').outerWidth();
				var item_width = jQuery(element).outerWidth();
				jQuery(element).children('ul.sub-menu').css({'left':'-'+(sub_menu_width/2 - item_width/2)+'px'});
				
				
				var container_left = container_offset.left;
				var container_right = container_left + container_width;
				var item_left = jQuery(element).offset().left;
				
				var overflow_left = (sub_menu_width/2 > (item_left + item_width/2 - container_left));
				var overflow_right = ((sub_menu_width/2 + item_left + item_width/2) > container_right);
				if( overflow_left ){
					var left = item_left - container_left - padding_left;
					jQuery(element).children('ul.sub-menu').css({'left':-left+'px'});
				}
				if( overflow_right && !overflow_left ){
					var left = item_left - container_left - padding_left;
					left = left - ( container_width - sub_menu_width );
					jQuery(element).children('ul.sub-menu').css({'left':-left+'px'});
				}
			});
			
			/* Remove hide class after loading */
			jQuery('ul.menu li.menu-item').removeClass('hide');
			
		},800);
		
	}
	else{ /* Mobile menu action */
		
		jQuery('.ic-mobile-menu-button').off('click');
		jQuery('.ic-mobile-menu-button').on('click', function(){
			jQuery('#page').addClass('menu-mobile-active');
		});
		
		jQuery('.ic-mobile-menu-close-button').off('click');
		jQuery('.ic-mobile-menu-close-button').on('click', function(){
			jQuery('#page').removeClass('menu-mobile-active');
		});
		
		jQuery('#wpadminbar').css('position', 'fixed');
		
		/* Remove hide class after loading */
		jQuery('ul.menu li.menu-item').removeClass('hide');
	}
	
}

function ts_menu_action_on_ipad(){
	/* Vertical Menu Heading */
	jQuery('.vertical-menu-heading').bind('click',function(){
		jQuery('nav.pc-menu > ul.menu').find('.sub-menu').hide();
		jQuery('nav.pc-menu > ul.menu li.menu-item').removeClass('active');
		jQuery('span.ts-menu-drop-icon').removeClass('active');
		var is_active = jQuery(this).hasClass('active');
		var vertical_menu = jQuery(this).siblings('.vertical-menu');
		
		jQuery('.vertical-menu-heading').removeClass('active');
		jQuery('.vertical-menu-wrapper > .vertical-menu').hide();
		jQuery(this).parents('.vertical-menu').show();
		
		if( vertical_menu.length > 0 ){
			if( is_active ){
				vertical_menu.fadeOut(250);
				jQuery(this).removeClass('active');
			}
			else{
				vertical_menu.fadeIn(250);
				jQuery(this).addClass('active');
			}
		}
	});
	
	/* Vertical Menu Drop Icon */
	jQuery('.vertical-menu-wrapper span.ts-menu-drop-icon').bind('click', function(){
		var is_active = jQuery(this).hasClass('active');
		var sub_menu = jQuery(this).siblings('.sub-menu');
		
		jQuery('nav.vertical-menu span.ts-menu-drop-icon').removeClass('active');
		jQuery('nav.vertical-menu > ul.menu').find('.sub-menu').hide();
		jQuery(this).parents('.sub-menu').show();
		
		if( sub_menu.length > 0 ){
			if( is_active ){
				sub_menu.fadeOut(250);
				jQuery(this).removeClass('active');
			}
			else{
				sub_menu.fadeIn(250);
				jQuery(this).addClass('active');
			}
			jQuery(this).parents('.sub-menu').siblings('.ts-menu-drop-icon').addClass('active');
		}
	});
	
	/* Widget Menu Drop Icon */
	jQuery('.ts-menus-widget .vertical-menu span.ts-menu-drop-icon').bind('click', function(){
		var is_active = jQuery(this).hasClass('active');
		var sub_menu = jQuery(this).siblings('.sub-menu');
		
		jQuery('nav.vertical-menu span.ts-menu-drop-icon').removeClass('active');
		jQuery('nav.vertical-menu > ul.menu').find('.sub-menu').hide();
		jQuery(this).parents('.sub-menu').show();
		
		if( sub_menu.length > 0 ){
			if( is_active ){
				sub_menu.fadeOut(250);
				jQuery(this).removeClass('active');
			}
			else{
				sub_menu.fadeIn(250);
				jQuery(this).addClass('active');
			}
			jQuery(this).parents('.sub-menu').siblings('.ts-menu-drop-icon').addClass('active');
		}
	});
	
	/* Main Menu Drop Icon */
	jQuery('.main-menu span.ts-menu-drop-icon').bind('click', function(){
		jQuery('.vertical-menu-heading').removeClass('active');
		jQuery('.vertical-menu-wrapper > .vertical-menu').hide();
		
		var is_active = jQuery(this).hasClass('active');
		var sub_menu = jQuery(this).siblings('.sub-menu');
		
		jQuery('nav.main-menu span.ts-menu-drop-icon').removeClass('active');
		jQuery('nav.main-menu li.menu-item').removeClass('active');
		jQuery('nav.main-menu > ul.menu').find('.sub-menu').hide();
		jQuery(this).parents('.sub-menu').show();
		
		if( sub_menu.length > 0 ){
			if( is_active ){
				sub_menu.fadeOut(250);
				jQuery(this).removeClass('active');
				jQuery(this).parent().removeClass('active');
			}
			else{
				sub_menu.fadeIn(250);
				jQuery(this).addClass('active');
				jQuery(this).parent().addClass('active');
			}
			jQuery(this).parents('.sub-menu').siblings('.ts-menu-drop-icon').addClass('active');
		}
	});
	
	/* Mobile Menu Drop Icon */
	jQuery('.mobile-menu .sub-menu').before('<span class="ts-menu-drop-icon"></span>');
	jQuery('.mobile-menu .sub-menu').hide();
	jQuery('.mobile-menu span.ts-menu-drop-icon').bind('click', function(){
		var is_active = jQuery(this).hasClass('active');
		var sub_menu = jQuery(this).siblings('.sub-menu');
		
		if( is_active ){
			sub_menu.slideUp(250);
			sub_menu.find('.sub-menu').hide();
			sub_menu.find('.ts-menu-drop-icon').removeClass('active');
		}
		else{
			sub_menu.slideDown(250);
		}
		jQuery(this).toggleClass('active');
	});
	
}

/*** End Mega menu ***/

/*** Update header incline width ***/
function ts_header_incline_width(){
	if( jQuery('.header-v5').length > 0 ){
		jQuery('style#header-incline-style').remove();
		jQuery('head').append('<style type="text/css" id="header-incline-style">.header-v5 .header-middle:before{border-right-width:'+jQuery(window).width()+'px}</style>');
	}
}

function ts_is_touch_device(){
	return !jQuery('body').hasClass('ts_desktop'); 
}

function ts_get_scrollbar_width() {
    var $inner = jQuery('<div style="width: 100%; height:200px;">test</div>'),
        $outer = jQuery('<div style="width:200px;height:150px; position: absolute; top: 0; left: 0; visibility: hidden; overflow:hidden;"></div>').append($inner),
        inner = $inner[0],
        outer = $outer[0];
     
    jQuery('body').append(outer);
    var width1 = inner.offsetWidth;
    $outer.css('overflow', 'scroll');
    var width2 = outer.clientWidth;
    $outer.remove();
 
    return (width1 - width2);
}

/*** Sticky Menu ***/
function ts_sticky_menu(){
	var on_touch = ts_is_touch_device();
	
	if( !on_touch && jQuery(window).width() > 768 ){
		var top_spacing = 0;
		if( jQuery('body').hasClass('logged-in') && jQuery('body').hasClass('admin-bar') && jQuery('#wpadminbar').length > 0 ){
			top_spacing = jQuery('#wpadminbar').height();
		}
		var top_begin = jQuery('header.ts-header').height() + 30;
		if( jQuery('body').hasClass('display-vertical-menu') && jQuery('nav.vertical-menu').length > 0 ){
			top_begin += jQuery('nav.vertical-menu').height();
		}
		
		setTimeout( function(){
			jQuery('.header-sticky').sticky({
					topSpacing: top_spacing
					,topBegin: top_begin
					,scrollOnTop : function (){
						ts_mega_menu_change_state();
					}
					,scrollOnBottom : function (){
						ts_mega_menu_change_state();
					}					
				});
		}, 200);
		
		var old_scroll_top = 0;
		var extra_space = 650 + top_spacing + top_begin;
		if( jQuery('.top-slideshow').length > 0 ){
			extra_space += jQuery('.top-slideshow').height();
		}
		jQuery(window).scroll(function(){
			if( jQuery('.is-sticky').length > 0 ){
				var scroll_top = jQuery(this).scrollTop();
				if( scroll_top > old_scroll_top && scroll_top > extra_space ){ /* Scroll Down */
					jQuery('.is-sticky .header-sticky').addClass('header-sticky-hide');
				}
				else{ /* Scroll Up */
					if( jQuery('.is-sticky .header-sticky').hasClass('header-sticky-hide') ){
						jQuery('.is-sticky .header-sticky').removeClass('header-sticky-hide');
					}
				}
				old_scroll_top = scroll_top;
			}
		});
	}
}

/*** Quickshop Action ***/
function ts_quickshop_handle(){
	jQuery('a.quickshop').prettyPhoto({
		deeplinking: false
		,opacity: 0.9
		,social_tools: false
		,default_width: 745
		,default_height: 400
		,theme: 'pp_woocommerce'
		,changepicturecallback : function(){
			jQuery('.pp_inline').find('form.variations_form').wc_variation_form();
			jQuery('.pp_inline').find('form.variations_form .variations select').change();
			jQuery('body').trigger('wc_fragments_loaded');
			
			jQuery('.pp_inline .variations_form').on('click', '.reset_variations', function(){
				jQuery(this).closest('.variations').find('.ts-product-attribute .option').removeClass('selected');
			});
			
			jQuery('.pp_woocommerce').addClass('loaded');

			var _this = jQuery('.ts-quickshop-wrapper .thumbnails');
			
			if( _this.find('.image-item').length == 0 ){
				return;
			}
			
			var owl = _this.owlCarousel({
					items: 3
					,loop: true
					,nav: true
					,navText: [,]
					,dots: false
					,navSpeed: 1000
					,slideBy: 1
					,rtl: jQuery('body').hasClass('rtl')
					,margin: 10
					,navRewind: false
					,autoplay: false
					,autoplayTimeout: 5000
					,autoplayHoverPause: false
					,autoplaySpeed: false
					,mouseDrag: true
					,touchDrag: true
					,responsiveBaseElement: _this
					,responsiveRefreshRate: 1000
					,onInitialized: function(){
						_this.addClass('loaded').removeClass('loading');
					}
				});
				
			/* cloud zoom */
			jQuery('.ts-qs-zoom, .ts-qs-zoom-gallery').CloudZoom({});
			
			jQuery('.ts-quickshop-wrapper form.variations_form').bind('found_variation',function( event, variation ){
				jQuery('.ts-qs-zoom, .ts-qs-zoom-gallery').CloudZoom({});
			}).bind('reset_image',function(){
				jQuery('.ts-qs-zoom, .ts-qs-zoom-gallery').CloudZoom({});
			});
		}
	});
	
}
/*** End Quickshop Action ***/

/*** Custom Wishlist ***/
function ts_update_tini_wishlist(){
	if( typeof _ts_ajax_uri == 'undefined' ){
		return;
	}
		
	var wishlist_wrapper = jQuery('.my-wishlist-wrapper');
	if( wishlist_wrapper.length == 0 ){
		return;
	}
	
	wishlist_wrapper.addClass('loading');
	
	jQuery.ajax({
		type : 'POST'
		,url : _ts_ajax_uri	
		,data : {action : 'sanzo_update_tini_wishlist'}
		,success : function(response){
			var first_icon = wishlist_wrapper.children('i.fa:first');
			wishlist_wrapper.html(response);
			if( first_icon.length > 0 ){
				wishlist_wrapper.prepend(first_icon);
			}
			wishlist_wrapper.removeClass('loading');
		}
	});
}

/*** End Custom Wishlist***/

/*** Custom Compare ***/
function ts_compare_change_scroll_bar(){
	var yith_compare_wrapper = jQuery('.DTFC_ScrollWrapper');
	if( yith_compare_wrapper.length > 0 ){
		var div_html = '<div class="ts-scroll-wrapper" style="position: fixed; bottom: 0; overflow-x: auto;"><div class="ts-scroll-content" style="display: inline-block;"></div></div>';
		yith_compare_wrapper.append(div_html);
		var div_temp = yith_compare_wrapper.find(".ts-scroll-wrapper");
		var left = parseInt(yith_compare_wrapper.find(".dataTables_scroll").css("left").replace(/px/gi,"")) + parseInt(yith_compare_wrapper.parents("body").css("padding-left")) + 3; /* 3px = border of body tag + table tag */
		div_temp.css({
			width: yith_compare_wrapper.find(".dataTables_scroll .dataTables_scrollBody").width()
			,height: ts_get_scrollbar_width+"px" 
			,left: left+"px" 
		});
		yith_compare_wrapper.find(".dataTables_scroll .dataTables_scrollBody").css({"overflow":"hidden"});
		div_temp.find(".ts-scroll-content").css({
			width: yith_compare_wrapper.find(".dataTables_scroll .dataTables_scrollBody table").width()
		});
		div_temp.scroll(function(){
			yith_compare_wrapper.find(".dataTables_scrollBody").scrollLeft(jQuery(this).scrollLeft());
		});
		
		/* image row height */
		var image_height = yith_compare_wrapper.find('.compare-list.dataTable:not(.DTFC_Cloned) tbody tr.image').height();
		yith_compare_wrapper.find('.compare-list.dataTable.DTFC_Cloned tbody tr.image').height( image_height );
		
		var content_height = yith_compare_wrapper.find(' > .dataTables_scroll').height();
		yith_compare_wrapper.height(content_height);
		yith_compare_wrapper.find('> .DTFC_LeftWrapper').height(content_height);
		yith_compare_wrapper.find('> .DTFC_LeftWrapper > .DTFC_LeftBodyWrapper').height(content_height);
	}
}
/*** End Custom Compare ***/

/*** Set Cloud Zoom ***/
function ts_set_cloud_zoom(){
	jQuery('.cloud-zoom-wrap .cloud-zoom-big').remove();
	jQuery('.cloud-zoom, .cloud-zoom-gallery').unbind('click');
	var clz_width = jQuery('.cloud-zoom, .cloud-zoom-gallery').width();
	var clz_img_width = jQuery('.cloud-zoom, .cloud-zoom-gallery').children('img').width();
	var cl_zoom = jQuery('.cloud-zoom, .cloud-zoom-gallery').not('.on_pc');
	var temp = (clz_width-clz_img_width)/2;
	if(cl_zoom.length > 0 ){
		cl_zoom.data('zoom',null).siblings('.mousetrap').unbind().remove();
		cl_zoom.CloudZoom({ 
			adjustX:temp	
		});
	}
}

/*** Widget toggle ***/
function ts_widget_toggle(){
	if( typeof _ts_enable_responsive != 'undefined' && ! _ts_enable_responsive ){
		return;
	}
	jQuery('.wpb_widgetised_column .widget-title-wrapper a.block-control, .footer-container .widget-title-wrapper a.block-control').remove();
	var window_width = jQuery(window).width();
	window_width += ts_get_scrollbar_width();
	if( window_width >= 768 ){
		jQuery('.widget-title-wrapper a.block-control').removeClass('active').hide();
		jQuery('.widget-title-wrapper a.block-control').parent().siblings().show();
	}
	else{
		jQuery('.widget-title-wrapper a.block-control').removeClass('active').show();
		jQuery('.widget-title-wrapper a.block-control').parent().siblings().hide();
		jQuery('.wpb_widgetised_column .widget-title-wrapper, .footer-container .widget-title-wrapper').siblings().show();
	}
}

/*** WooCommerce Quantity Increment ***/
function ts_woocommerce_quantity_increment($){
	$( document ).on( 'click', '.plus, .minus', function() {

		// Get values
		var $qty		= $( this ).closest( '.quantity' ).find( '.qty' ),
			currentVal	= parseFloat( $qty.val() ),
			max			= parseFloat( $qty.attr( 'max' ) ),
			min			= parseFloat( $qty.attr( 'min' ) ),
			step		= $qty.attr( 'step' );

		// Format values
		if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
		if ( max === '' || max === 'NaN' ) max = '';
		if ( min === '' || min === 'NaN' ) min = 0;
		if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

		// Change the value
		if ( $( this ).is( '.plus' ) ) {

			if ( max && ( max == currentVal || currentVal > max ) ) {
				$qty.val( max );
			} else {
				$qty.val( currentVal + parseFloat( step ) );
			}

		} else {

			if ( min && ( min == currentVal || currentVal < min ) ) {
				$qty.val( min );
			} else if ( currentVal > 0 ) {
				$qty.val( currentVal - parseFloat( step ) );
			}

		}

		// Trigger change event
		$qty.trigger( 'change' );

	});
}

/*** Ajax search ***/
function ts_ajax_search(){
	if( jQuery('.ts-header .header-v7, .ts-header .header-v8').length > 0 ){
		return;
	}
	
	var search_string = '';
	var search_previous_string = '';
	var search_timeout;
	var search_delay = 500;
	var search_input;
	var search_cache_data = {};
	jQuery('body').append('<div id="ts-search-result-container"></div>');
	var ts_search_result_container = jQuery('#ts-search-result-container');
	
	jQuery('.ts-header .search-content input[name="s"]').bind('keyup', function(e){
		search_input = jQuery(this);
		ts_search_result_container.hide();
		
		search_string = jQuery.trim(jQuery(this).val());
		if( search_string.length < 2 ){
			search_input.parents('.search-content').removeClass('loading');
			return;
		}
		
		if( search_cache_data[search_string] ){
			ts_search_result_container.html(search_cache_data[search_string]);
			ts_search_result_container.show();
			search_previous_string = '';
			search_input.parents('.search-content').removeClass('loading');
			
			ts_search_result_container.find('.view-all-wrapper a').bind('click', function(e){
				e.preventDefault();
				search_input.parents('form').submit();
			});
			
			return;
		}
		
		clearTimeout(search_timeout);
		search_timeout = setTimeout(function(){
			if( search_string == search_previous_string || search_string.length < 2 ){
				return;
			}
			
			search_previous_string = search_string;
		
			search_input.parents('.search-content').addClass('loading');
			
			/* check category */
			var category = '';
			var select_category = search_input.parents('.search-content').siblings('.select-category');
			if( select_category.length > 0 ){
				category = select_category.find(':selected').val();
			}
			
			jQuery.ajax({
				type : 'POST'
				,url : _ts_ajax_uri	
				,data : {action : 'sanzo_ajax_search', search_string: search_string, category: category}
				,error : function(xhr,err){
					search_input.parents('.search-content').removeClass('loading');
				}
				,success : function(response){
					if( response != '' ){
						response = JSON.parse(response);
						if( response.search_string == search_string ){
							ts_search_result_container.html(response.html);
							search_cache_data[search_string] = response.html;
							
							var top = search_input.offset().top + search_input.outerHeight(true);
							var left = Math.ceil(search_input.offset().left);
							var width = search_input.outerWidth(true);
							var border_width = parseInt(search_input.parent('.search-content').css('border-left-width'));
							left -= border_width;
							width += border_width;
							if( width < 300 ){
								width = 300;
							}
							
							window_width = jQuery(window).width(); /* Overflow window */
							if( (left + width) > window_width ){
								left -= (width - search_input.outerWidth(true));
							}
							
							ts_search_result_container.css({
								'position': 'absolute'
								,'top': top
								,'left': left
								,'width': width
								,'display': 'block'
							});
							
							search_input.parents('.search-content').removeClass('loading');
							
							ts_search_result_container.find('.view-all-wrapper a').bind('click', function(e){
								e.preventDefault();
								search_input.parents('form').submit();
							});
						}
					}
					else{
						search_input.parents('.search-content').removeClass('loading');
					}
				}
			});
		}, search_delay);
	});
	
	ts_search_result_container.hover(function(){}, function(){ts_search_result_container.hide();});
	
	jQuery('body').bind('click', function(){
		ts_search_result_container.hide();
	});
	
	jQuery('.ts-search-by-category select.select-category').bind('change', function(){
		search_previous_string = '';
		search_cache_data = {};
		jQuery(this).parents('.ts-search-by-category').find('.search-content input[name="s"]').trigger('keyup');
	});
}

/*** Update post like ***/
function ts_ajax_update_post_like(){
	var wrapper = jQuery('.blog-like-wrapper');
	var post_id = wrapper.find('.post-like-container').data('post_id');
	wrapper.find('.ic-like.allow-like').bind('click', function(){
		wrapper.addClass('loading');
		jQuery.ajax({
			type : 'POST'
			,url : _ts_ajax_uri	
			,data : {action : 'sanzo_update_post_like', post_id: post_id}
			,error : function(xhr,err){
				wrapper.removeClass('loading');
			}
			,success : function(response){
				if( response ){
					wrapper.find('.post-like-container').remove();
					wrapper.append(response);
					ts_ajax_update_post_like();
				}
				wrapper.removeClass('loading');
			}
		});
	});
}

/*** Single post - Related posts - Gallery slider ***/
function ts_single_related_post_gallery_slider(){
	if( jQuery('.single-post .gallery figure, .list-posts .post-item .gallery figure, .ts-blogs-widget .thumbnail.gallery figure, .single-portfolio.layout-2 .thumbnails figure').length > 0 ){
		var _this = jQuery('.single-post .gallery figure, .list-posts .post-item .gallery figure, .ts-blogs-widget .thumbnail.gallery figure, .single-portfolio.layout-2 .thumbnails figure');
		var slider_data = {
			items: 1
			,loop: true
			,nav: false
			,dots: true
			,animateIn: 'fadeIn'
			,animateOut: 'fadeOut'
			,navText: [,]
			,navSpeed: 1000
			,slideBy: 1
			,rtl: jQuery('body').hasClass('rtl')
			,margin: 10
			,navRewind: false
			,autoplay: true
			,autoplayTimeout: 4000
			,autoplayHoverPause: true
			,autoplaySpeed: false
			,autoHeight: true
			,mouseDrag: false
			,touchDrag: true
			,responsive:{
				0:{
					items : 1
				}
			}
			,onInitialized: function(){
				_this.parent('.gallery').addClass('loaded').removeClass('loading');
			}
		};
		_this.each(function(){
			var validate_slider = true;
			
			if( jQuery(this).find('img').length <= 1 ){
				validate_slider = false;
			}
			
			if( validate_slider ){
			
				jQuery(this).owlCarousel(slider_data);
				
				if( jQuery(this).parents('.single-portfolio').length > 0 ){
					jQuery(this).parents('.thumbnails').addClass('gallery');
				}
				
			}
			else{
				jQuery(this).parent('.gallery').removeClass('loading');
			}
		});
	}
	
	if( jQuery('.single-post .related-posts.loading').length > 0 ){
		var _this = jQuery('.single-post .related-posts.loading');
		var slider_data = {
			loop : true
			,nav : true
			,navText : [,]
			,dots : false
			,navSpeed: 1000
			,slideBy: 1
			,rtl: jQuery('body').hasClass('rtl')
			,margin : 30
			,navRewind: false
			,autoplay: false
			,autoplayTimeout: 5000
			,autoplayHoverPause: true
			,autoplaySpeed: false
			,mouseDrag: true
			,touchDrag: true
			,responsiveBaseElement: _this
			,responsiveRefreshRate: 400
			,responsive:{
						0:{
							items : 1
						},
						500:{
							items : 2
						},
						800:{
							items : 3
						},
						1200:{
							items : 4
						}
					}
			,onInitialized: function(){
				_this.addClass('loaded').removeClass('loading');
			}
		};
		_this.find('.content-wrapper .blogs').owlCarousel(slider_data);
	}
	
}

/*** Parallax Background ***/
function ts_parallax_background(){
	jQuery('.ts-parallax-bg').each(function(){
		var prlx_speed = jQuery(this).data('prlx-speed');
		if( typeof prlx_speed == 'undefined' ){
			prlx_speed = 1;
		}
		prlx_speed = parseFloat(prlx_speed);
		
		jQuery(this).parallax('50%', prlx_speed);
	});
}

/*** Header Product Categories Slider ***/
function ts_header_product_categories_slider(){
	var wrapper = jQuery('.ts-header .header-product-categories');
	if( wrapper.length == 0 || wrapper.find('.item').length == 0 ){
		return;
	}
	wrapper.owlCarousel({
		loop : true
		,nav : true
		,navText : [,]
		,dots : false
		,navSpeed : 1000
		,rtl: jQuery('body').hasClass('rtl')
		,margin: 20
		,stagePadding: 9
		,navRewind: false
		,autoplay: true
		,autoplayHoverPause: true
		,autoplaySpeed: 1000
		,responsiveBaseElement: wrapper
		,responsiveRefreshRate: 1000
		,responsive:{
			0:{
				items : 1
			},
			200:{
				items : 2
			},
			350:{
				items : 3
			},
			450:{
				items : 4
			},
			600:{
				items : 5
			},
			700:{
				items : 6
			},
			800:{
				items : 7
			},
			900:{
				items : 8
			}
		}
		,onInitialized: function(){
			setTimeout(function(){
				wrapper.addClass('loaded').removeClass('loading');
			}, 10);
		}
	});
}
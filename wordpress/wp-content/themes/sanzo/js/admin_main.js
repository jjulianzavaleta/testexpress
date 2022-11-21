/** Mega Menu **/
function ts_get_menu_level( class_name ){
	if( typeof(class_name) != "undefined" ){
		if( class_name.indexOf('menu-item-depth-0') >= 0 ){
			return 0;
		}else if( class_name.indexOf('menu-item-depth-1') >= 0 ){
			return 1;
		}else if( class_name.indexOf('menu-item-depth-2') >= 0 ){
			return 2;
		}else{
			return 3;
		}
	}else{
		return -1;
	}
}

function ts_get_menu_top_parent( current_element ){
	li_top_parent = current_element.prevUntil('.menu-item-depth-0');
	if(li_top_parent.length <= 0){
		li_top_parent = current_element.prev();
	}else{
		array_len = li_top_parent.length-1;
		li_top_parent = li_top_parent.eq(array_len).prev();
	}
	return li_top_parent;
}
jQuery(document).ready(function($){
	"use strict";
	
	if( $('p.field-ts-is-megamenu').length > 0 ){
		$('p.field-ts-is-megamenu').each(function(index, element){
			$(element).find('input[type="checkbox"]').bind('change', function(){
				var is_megamenu = $(this).is(':checked');
				var li_parent = $(element).parent().parent();
				var li_parent_class = li_parent.attr('class');
				/* Show - Hide element*/
				var menu_li_child = li_parent.nextUntil('.menu-item-depth-0');
				if( is_megamenu ){
					$(element).siblings('.ts-custom-menu, .wp-editor-wrap').show();
				}
				else{
					$(element).siblings('.ts-custom-menu, .wp-editor-wrap').hide();
				}
				if( menu_li_child.length > 0 ){
					menu_li_child.each(function(index, subelement){
						if( is_megamenu ){
							$(subelement).find('.ts-custom-menu, .wp-editor-wrap').show();
						}
						else{
							$(subelement).find('.ts-custom-menu, .wp-editor-wrap').hide();
						}
					});
				}
			});
		});
		
		$('ul#menu-to-edit li.menu-item a.item-edit').live('mouseup',function(){
			$(this).parents('li.menu-item').trigger('click');
		});
		
		$('ul#menu-to-edit > li').live('click',function(event){
			var item_level = ts_get_menu_level($(this).attr('class'));
			switch( item_level ){
				case 0:
					var is_megamenu = $(this).find('.edit-menu-item-ts-is-megamenu').is(':checked');
					var menu_li_child = $(this).nextUntil('.menu-item-depth-0');
					if( is_megamenu ){
						$(this).find('.wp-editor-wrap, .ts-active-lv0').show();
					}
					else{
						$(this).find('.wp-editor-wrap, .ts-active-lv0').hide();
					}
					$(this).find('.field-ts-is-megamenu').show(); /* Always show checkbox */
					if( menu_li_child.length > 0 ){
						menu_li_child.each(function(index, subelement){
							var sub_item_level = ts_get_menu_level($(subelement).attr('class'));
							if( is_megamenu ){
								$(subelement).find('.ts-custom-menu, .wp-editor-wrap').show();
							}
							else{
								$(subelement).find('.ts-custom-menu, .wp-editor-wrap').hide();
							}
							$(subelement).find('.ts-custom-menu:not(.ts-active-lv'+sub_item_level+')').hide();
						});
					}
				break;
				case 1: case 2:
					var li_parent = ts_get_menu_top_parent($(this));
					var is_megamenu = li_parent.find('.edit-menu-item-ts-is-megamenu').is(':checked');
					var item_level = ts_get_menu_level($(this).attr('class'));
					if( is_megamenu ){
						$(this).find('.ts-custom-menu, .wp-editor-wrap').show();
					}
					else{
						$(this).find('.ts-custom-menu, .wp-editor-wrap').hide();
					}
					$(this).find('.ts-custom-menu:not(.ts-active-lv'+item_level+')').hide();
				break;
			}
		});
		
		$('#menu-to-edit').on('sortstop', function(event, ui){
			var current_item = ui.item;
			setTimeout(function(){
				current_item.trigger('click');
			},100);
		});
		
		/* Upload thumbnail */
		jQuery('.ts_mega_menu_upload_image').live('click',function() {
			var current_add_ele = jQuery(this);
			var current_rmv_ele = jQuery(this).siblings('a.ts_mega_menu_clear_image');
			var preview = jQuery(this).siblings('span.preview-thumbnail-wrapper');
			var thumbnail_id_value = jQuery(this).siblings('.thumbnail-id-hidden');  
			wp.media.editor.send.attachment = function(props, attachment){
				var thumb_id  = attachment.id;
				var thumb_url = '';
				if( typeof(attachment.sizes.thumbnail) !== 'undefined' ){
					thumb_url = attachment.sizes.thumbnail.url;
				}else{
					thumb_url = attachment.sizes[props.size].url;
				}
				var img_html = '<img src="'+thumb_url+'" width="32" height="32" >';
				preview.html(img_html);
				thumbnail_id_value.val(thumb_id);
				
				current_add_ele.hide();
				current_rmv_ele.show();
			}
			wp.media.editor.open(current_add_ele);
		}); 

		jQuery('.ts_mega_menu_clear_image').live('click',function() {  
			var current_rmv_ele = jQuery(this);
			var current_add_ele = jQuery(this).siblings('a.ts_mega_menu_upload_image');
			var preview = jQuery(this).siblings('span.preview-thumbnail-wrapper');
			var thumbnail_id_value = jQuery(this).siblings('.thumbnail-id-hidden');  
			preview.html('');
			thumbnail_id_value.val('');
			current_add_ele.show();
			current_rmv_ele.hide();
			return false;  
		}); 
	}
});
/** End Mega Menu **/

/** Meta Boxes **/
jQuery(document).ready(function($){
	"use strict";
	
	$('.ts_meta_box_upload_button').bind('click',function() {
		var button = $(this);
		var clear_button = $(this).siblings('.ts_meta_box_clear_image_button');
		var input_field = $(this).siblings('input.upload_field');   
		wp.media.editor.send.attachment = function(props, attachment){
			var attachment_url = '';
			attachment_url = attachment.sizes[props.size].url;
			input_field.val(attachment_url);
			if( input_field.siblings('.preview-image').length > 0 ){
				input_field.siblings('.preview-image').attr('src', attachment_url);
			}
			else{
				var img_html = '<img class="preview-image" src="' + attachment_url + '" />';
				input_field.parent().append(img_html);
			}
			clear_button.attr('disabled', false);
		}
		wp.media.editor.open(button);
	}); 
	
	$('.ts_meta_box_clear_image_button').bind('click', function(){
		var button = $(this);
		button.attr('disabled', true);
		button.siblings('input.upload_field').val('');
		button.siblings('.preview-image').fadeOut(250, function(){
			button.siblings('.preview-image').remove();
		});
	});
	
	$('.ts-meta-box-field .upload_field').bind('change', function(){
		var input_field = $(this);
		var input_value = input_field.val().trim();
		if( input_value == '' ){
			input_field.siblings('.ts_meta_box_clear_image_button').trigger('click');
		}
		else{
			if( input_field.siblings('.preview-image').length > 0 ){
				input_field.siblings('.preview-image').attr('src', input_value);
			}
			else{
				var img_html = '<img class="preview-image" src="' + input_value + '" />';
				input_field.parent().append(img_html);
			}
			input_field.siblings('.ts_meta_box_clear_image_button').attr('disabled', false);
		}
	});
	
	/* Gallery */
	var file_frame;
	var _add_img_button;
	$('.ts-gallery-box .add-image').bind('click', function(event){
		event.preventDefault();
		_add_img_button = jQuery(this);
        
        if ( file_frame ) {
            file_frame.open();
            return;
        }

        var _states = [new wp.media.controller.Library({
            filterable: 'uploaded',
            title: 'Select Images',
            multiple: true,
            priority:  20
        })];
			 
        file_frame = wp.media.frames.file_frame = wp.media({
            states: _states,
            button: {
                text: 'Insert URL'
            }
        });

        file_frame.on( 'select', function() {
			var object = file_frame.state().get('selection').toJSON();
			
			var img_html = '';
			if( object.length > 0 ){
				for( var i = 0; i < object.length; i++ ){
					var image_url = object[i].url;
					if( typeof object[i].sizes.thumbnail != "undefined" ){
						image_url = object[i].sizes.thumbnail.url;
					}
					img_html += '<li class="image"><span class="del-image"></span><img src="'+image_url+'" alt="" data-id="'+object[i].id+'"/></li>';
				}
			}
			
			_add_img_button.siblings('ul.images').append(img_html);
			
			var arr_ids = new Array();
			_add_img_button.siblings('ul.images').find('li img').each(function(index, ele){
				arr_ids.push( $(ele).data('id') );
			});
			
			_add_img_button.siblings('.meta-value').val(arr_ids.join(','));
        });
		 
        file_frame.open();
	});
	
	jQuery('.ts-gallery-box .del-image').live('click', function(){
		var image = jQuery(this).parent('.image');
		var container = jQuery(this).parents('.ts-gallery-box');
		image.fadeOut(300, function(){
			image.remove();
			var arr_ids = new Array();
			container.find('.images img').each(function(index, ele){
				arr_ids.push( $(ele).data('id') );
			});
			container.find('.meta-value').val(arr_ids.join(','));
		});
	});
	
	/* Colorpicker */
	if( typeof $.fn.wpColorPicker == 'function' ){
		$('.ts-meta-box-field .colorpicker').wpColorPicker();
	}
	
});
/** End Meta Boxes **/

/** Page Template - Page Options **/
jQuery(document).ready(function($){
	"use strict";
	
	if( $('select#page_template').length > 0 ){
		$('select#page_template').bind('change', function(){
			var template = $(this).val();
			$('#page_options .ts-meta-box-field').show();
			if( template == 'page-templates/fullwidth-template.php' ){
				$('#ts_layout_style, #ts_header_layout_style, #ts_main_content_layout_style, #ts_footer_layout_style, #ts_page_layout, #ts_left_sidebar, #ts_right_sidebar').parents('.ts-meta-box-field').hide();
			}
			else{
				$('#ts_layout_style').trigger('change');
			}
			
			if( template == 'page-templates/blank-page-template.php' ){
				$('#page_options').addClass('ts-hidden');
			}
			else{
				$('#page_options').removeClass('ts-hidden');
			}
		});
		
		setTimeout(function(){
			$('select#page_template').trigger('change');
		}, 300);
	}
	
	/* Advance layout */
	$('#ts_layout_style').on('change', function(){
		var style = $('#ts_layout_style').val();
		if( style == 'advance' ){
			/* Page options */
			$('#ts_header_layout_style').parents('.ts-meta-box-field').fadeIn();
			$('#ts_main_content_layout_style').parents('.ts-meta-box-field').fadeIn();
			$('#ts_footer_layout_style').parents('.ts-meta-box-field').fadeIn();
			/* Theme options */
			$('#ts_header_layout_style').parents('div.section-select').fadeIn();
			$('#ts_main_content_layout_style').parents('div.section-select').fadeIn();
			$('#ts_footer_layout_style').parents('div.section-select').fadeIn();
		}
		else{
			/* Page options */
			$('#ts_header_layout_style').parents('.ts-meta-box-field').fadeOut();
			$('#ts_main_content_layout_style').parents('.ts-meta-box-field').fadeOut();
			$('#ts_footer_layout_style').parents('.ts-meta-box-field').fadeOut();
			/* Theme options */
			$('#ts_header_layout_style').parents('div.section-select').fadeOut();
			$('#ts_main_content_layout_style').parents('div.section-select').fadeOut();
			$('#ts_footer_layout_style').parents('div.section-select').fadeOut();
		}
	});
	$('#ts_layout_style').trigger('change');
});
/** End Page Template **/

/** Custom Sidebar **/
jQuery(document).ready(function($){
	"use strict";
	
	var add_sidebar_form = $('#ts-form-add-sidebar');
	if( add_sidebar_form.length > 0 ){
		var add_sidebar_form_new = add_sidebar_form.clone();
		add_sidebar_form.remove();
		jQuery('#widgets-right').append('<div style="clear:both;"></div>');
		add_sidebar_form = jQuery('#widgets-right').append(add_sidebar_form_new);
		
		$('#ts-add-sidebar').bind('click', function(e){
			e.preventDefault();
			var sidebar_name = $.trim( $(this).siblings('#sidebar_name').val() );
			if( sidebar_name != '' ){
				$(this).attr('disabled', true);
				var data = {
					action: 'sanzo_add_custom_sidebar'
					,sidebar_name: sidebar_name
				};
				
				$.ajax({
					type : 'POST'
					,url : ajaxurl	
					,data : data
					,success : function(response){
						if( response ){
							alert( response );
						}
						window.location.reload(true);
					}
				});
			}
		});
	}
	
	if( $('.sidebar-ts-custom-sidebar').length > 0 ){
		var delete_button = '<span class="delete-sidebar fa fa-trash-o"></span>';
		$('.sidebar-ts-custom-sidebar .sidebar-name').prepend(delete_button);
		
		$('.sidebar-ts-custom-sidebar .delete-sidebar').bind('click', function(){
			var sidebar_name = $(this).parent().find('h2').text();
			var widget_block = $(this).parents('.widgets-holder-wrap');
			var ok = confirm('Do you want to delete this sidebar?');
			if( ok ){
				widget_block.hide();
				var data = {
					action: 'sanzo_delete_custom_sidebar'
					,sidebar_name: sidebar_name
				};
				
				$.ajax({
					type : 'POST'
					,url : ajaxurl	
					,data : data
					,success : function(response){
						if( response == '1' ){
							widget_block.remove();
						}
						else{
							widget_block.show();
							alert( response );
						}
					}
				});
			}
		});
	}
});

/** Product Category **/
jQuery(document).ready(function($){
	"use strict";
	
	/* Only show the "remove image" button when needed */
	$('.ts-product-cat-upload-field').each(function(){
		if( ! $(this).find('.value-field').val() ){
			$(this).find('.remove-button').hide();
		}
	});

	/* Uploading files */
	var file_frame;
	var upload_button;

	$( document ).on( 'click', '.ts-product-cat-upload-field .upload-button', function( event ) {

		event.preventDefault();
		
		upload_button = $(this);

		/* If the media frame already exists, reopen it. */
		if ( file_frame ) {
			file_frame.open();
			return;
		}

		/* Create the media frame. */
		file_frame = wp.media.frames.downloadable_file = wp.media({
			title: 'Choose an image',
			button: {
				text: 'Use image'
			},
			multiple: false
		});

		/* When an image is selected, run a callback. */
		file_frame.on( 'select', function() {
			var attachment = file_frame.state().get( 'selection' ).first().toJSON();
			var thumb_url = attachment.url;
			if( typeof attachment.sizes.thumbnail != 'undefined' ){
				thumb_url = attachment.sizes.thumbnail.url;
			}

			upload_button.siblings('.value-field').val( attachment.id );
			upload_button.parents('.ts-product-cat-upload-field').find('.preview-image img').attr( {'src': thumb_url, 'width': '', 'height': ''} );
			upload_button.siblings('.remove-button').show();
		});

		/* Finally, open the modal. */
		file_frame.open();
	});

	$( document ).on( 'click', '.ts-product-cat-upload-field .remove-button', function() {
		var button = $(this);
		button.parents('.ts-product-cat-upload-field').find('.preview-image img').remove();
		button.parents('.ts-product-cat-upload-field').find('.preview-image').append( '<img src="' + button.siblings('.placeholder-image-url').val() + '" class="woocommerce-placeholder wp-post-image" width="60" height="60" alt="Placeholder" />' );
		button.siblings('.value-field').val('');
		button.hide();
		return false;
	});
	
	if( typeof $.fn.wpColorPicker == 'function' ){
		$('.ts-color-picker').wpColorPicker();
	}
});

/** Product Category Filter **/
jQuery(document).ready(function($){
	if( $('#product-category-filter').length > 0 ){
		$('#product-category-filter .sidebar-name').prepend( '<span class="manage-icons fa fa-cog"></span>' );
		$('body').append( '<div id="ts-product-filter-icons-popup"><div class="container">'
			 + '<h3 class="heading">Icons</h3>' 
			 + '<div class="icons-wrapper"><div class="icons"></div><a href="#" class="add-icon" title="Add Icons"></a></div><input type="hidden" value="" class="icon-ids" />' 
			 + '<h3 class="heading">Hover icons</h3>' 
			 + '<div class="icons-wrapper icons-hover-wrapper"><div class="icons icons-hover"></div><a href="#" class="add-icon" title="Add Icons"></a></div><input type="hidden" value="" class="icon-hover-ids" />' 
			 + '<div class="buttons"><a class="button button-primary save" href="#">Save</a><a class="button cancel" href="#">Cancel</a></div>' 
			 + '</div></div>' );
		$('body').append( '<div id="ts-product-filter-icons-overlay"></div>' );
		
		$('#ts-product-filter-icons-popup a').on('click', function(e){
			e.preventDefault();
		});
		
		$('#product-category-filter .manage-icons').on('click', function(){
			$('#ts-product-filter-icons-popup').fadeIn();
			$('#ts-product-filter-icons-overlay').fadeIn();
			ts_load_product_filter_icons();
		});
		
		$('#ts-product-filter-icons-overlay, #ts-product-filter-icons-popup .cancel').on('click', function(){
			$('#ts-product-filter-icons-popup').fadeOut();
			$('#ts-product-filter-icons-overlay').fadeOut();
		});
		
		/* Add icons */
		var file_frame;
		var add_icon_button;
		$('#ts-product-filter-icons-popup .add-icon').on('click', function(){
			add_icon_button = $(this);
			if ( file_frame ) {
				file_frame.open();
				return;
			}

			var _states = [new wp.media.controller.Library({
				filterable: 'uploaded',
				title: 'Select Images',
				multiple: true,
				priority:  20
			})];
				 
			file_frame = wp.media.frames.file_frame = wp.media({
				states: _states,
				button: {
					text: 'Insert URL'
				}
			});

			file_frame.on( 'select', function() {
				var object = file_frame.state().get('selection').toJSON();
				
				var img_html = '';
				if( object.length > 0 ){
					for( var i = 0; i < object.length; i++ ){
						var image_url = object[i].url;
						if( typeof object[i].sizes.thumbnail != "undefined" ){
							image_url = object[i].sizes.thumbnail.url;
						}
						img_html += '<div class="icon"><img src="'+image_url+'" alt="" data-id="'+object[i].id+'"/></div>';
					}
				}
				
				add_icon_button.siblings('.icons').append(img_html);
				
				update_icon_ids_field();
			});
			 
			file_frame.open();
		});
		
		/* Delete icons */
		$('#ts-product-filter-icons-popup').on('click', '.icon', function(){
			var icon = $(this);
			icon.fadeOut(300, function(){
				icon.remove();
				update_icon_ids_field();
			});
		});
		
		/* Sort */
		if( typeof $.fn.sortable == 'function' ){
			$('#ts-product-filter-icons-popup .icons').sortable({revert: true, update: function(){ update_icon_ids_field(); }});
			$('#ts-product-filter-icons-popup .icons').disableSelection();
		}
		
		function update_icon_ids_field(){
			var arr_ids = new Array();
			var arr_hover_ids = new Array();
			$('#ts-product-filter-icons-popup .icons:not(.icons-hover) img').each(function(index, ele){
				arr_ids.push( $(ele).data('id') );
			});
			$('#ts-product-filter-icons-popup .icons.icons-hover img').each(function(index, ele){
				arr_hover_ids.push( $(ele).data('id') );
			});
			$('#ts-product-filter-icons-popup .icon-ids').val(arr_ids.join(','));
			$('#ts-product-filter-icons-popup .icon-hover-ids').val(arr_hover_ids.join(','));
		}
		
		/* Save icons */
		$('#ts-product-filter-icons-popup .save').on('click', function(){
			$('#ts-product-filter-icons-popup').addClass('loading');
			var icon_ids = $('#ts-product-filter-icons-popup .icon-ids').val();
			var icon_hover_ids = $('#ts-product-filter-icons-popup .icon-hover-ids').val();
			$.ajax({
				type : 'POST'
				,url : ajaxurl	
				,data : {action: 'sanzo_save_product_filter_icons', icon_ids: icon_ids, icon_hover_ids: icon_hover_ids}
				,success : function(response){
					$('#ts-product-filter-icons-popup').removeClass('loading');
					if( response ){
						alert(response);
						$('#ts-product-filter-icons-overlay').trigger('click');
					}
				}
			});
		});
		
		function ts_load_product_filter_icons(){
			$('#ts-product-filter-icons-popup').addClass('loading');
			$.ajax({
				type : 'POST'
				,url : ajaxurl	
				,data : {action: 'sanzo_load_product_filter_icons'}
				,success : function(response){
					if( response ){
						response = JSON.parse(response);
						if( response.icon_ids ){
							$('#ts-product-filter-icons-popup .icon-ids').val(response.icon_ids);
						}
						if( response.icon_hover_ids ){
							$('#ts-product-filter-icons-popup .icon-hover-ids').val(response.icon_hover_ids);
						}
						if( response.icon_html ){
							$('#ts-product-filter-icons-popup .icons:not(.icons-hover) .icon').remove();
							$('#ts-product-filter-icons-popup .icons:not(.icons-hover)').append(response.icon_html);
						}
						if( response.icon_hover_html ){
							$('#ts-product-filter-icons-popup .icons.icons-hover .icon').remove();
							$('#ts-product-filter-icons-popup .icons.icons-hover').append(response.icon_hover_html);
						}
					}
					$('#ts-product-filter-icons-popup').removeClass('loading');
				}
			});
		}
	}
});
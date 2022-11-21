<?php
/*** Comment ***/
function sanzo_list_comments( $comment, $args, $depth ){
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>"  class="comment-wrapper">
			<div class="avatar">
				<?php echo get_avatar( $comment, 90, 'mystery' ); ?>
			</div>
			<div class="comment-detail">														
				<div class="comment-text"><?php comment_text(); ?></div>
				
				<div class="comment-meta">
					<span class="author">
					<?php esc_html_e('Post by ', 'sanzo'); ?>
					<?php echo sprintf( '<a href="%1$s" rel="external nofollow" class="url">%2$s</a>', get_comment_author_url(), get_comment_author() ); ?>
					</span>
					<span class="datetime"><?php echo get_comment_date(); ?></span>
					<?php if( !( $depth == 0 || $args['max_depth'] <= $depth ) ): ?>
					<span class="reply"><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'], 'respond_id' => 'comment-wrapper' ) ) ); ?></span>
					<?php endif; ?>
					
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'sanzo' ); ?></em>
					<?php endif; ?>
					
					<?php edit_comment_link( esc_html__( '(Edit)', 'sanzo' ), ' ' ); ?>
				</div>
			</div>
		</div>

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php esc_html_e( 'Pingback:', 'sanzo' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( '(Edit)', 'sanzo' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}

function sanzo_comment_form( $args = array(), $post_id = null ){
	global $user_identity;

	if( null === $post_id ){
		$post_id = get_the_ID();
	}
	
	$allowed_html = array(
		'span'	=> array( 'class' => array() )
		,'a' 	=> array( 'href' => array(), 'title' => array() )
	);

	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	
	$comment_author = '';
	$comment_author_email = '';
	
	extract(array_filter(array(
		'comment_author'		=>	esc_attr($commenter['comment_author'])
		,'comment_author_email'	=>	esc_attr($commenter['comment_author_email'])
	)), EXTR_OVERWRITE);
	
	$fields =  array(
		'author' => '<p><label>'.wp_kses( __('Your name (<span class="required">*</span>)','sanzo'), $allowed_html ).'</label>' . '<input id="author" class="input-text" name="author" type="text" value="' .$comment_author. '" size="30"' . $aria_req . ' />' . '</p>'
		,'email'  => '<p><label>'.wp_kses( __('Your email address (<span class="required">*</span>)','sanzo'), $allowed_html ).'</label><input id="email" class="input-text" name="email" type="text" value="' . $comment_author_email . '" size="30"' . $aria_req . '/>' . '</p>'
		,'phone'    => '<p><label>'.esc_html__('Your phone number','sanzo').'</label><input id="phone" class="input-text" name="phone" type="text" value="" size="30"/>' . '</p>'
	);

	$required_text = sprintf( ' ' . wp_kses( __('Required fields are marked %s','sanzo'), $allowed_html ), '<span class="required">*</span>' );
	$defaults = array(
		'fields'               => apply_filters( 'comment_form_default_fields', $fields )
		,'fields_before'		   => '<div class="info-wrapper">'
		,'fields_after'		   => '</div>'
		,'comment_field'        => '<div class="message-wrapper"><p><label>'.esc_html__('Your comment', 'sanzo').'</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p></div>'
		,'must_log_in'          => '<p class="must-log-in">' .  sprintf( wp_kses( __( 'You must be <a href="%s">logged in</a> to post a comment.','sanzo' ), $allowed_html ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>'
		,'logged_in_as'         => '<p class="logged-in-as">' . sprintf( wp_kses( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','sanzo' ), $allowed_html ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>'
		,'comment_notes_before' => ''
		,'comment_notes_after'  => ''
		,'id_form'              => 'commentform'
		,'id_submit'            => 'submit'
		,'title_reply'          => esc_html__( 'Leave a comment', 'sanzo' )
		,'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'sanzo')
		,'cancel_reply_link'    => esc_html__( 'Cancel reply', 'sanzo' )
		,'label_submit'         => esc_html__( 'Submit', 'sanzo' )
	);

	$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

	?>
		<?php if ( comments_open() ) : ?>
			<?php do_action( 'comment_form_before' ); ?>
			<section id="comment-wrapper">
				<header class="heading-wrapper">
					<h2 class="heading-title"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small></h2>
				</header>
				
				<?php 
					if( get_option( 'comment_registration' ) && !is_user_logged_in() ):
						echo  $args['must_log_in'];
						do_action( 'comment_form_must_log_in_after' );
					else: 
				?>
					<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>">
						<?php 
							do_action( 'comment_form_top' );
							if ( is_user_logged_in() ){
								echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity );
								do_action( 'comment_form_logged_in_after', $commenter, $user_identity );
							}
							else{
								echo  $args['comment_notes_before'];
								echo  $args['fields_before'];
								do_action( 'comment_form_before_fields' );
								foreach ( (array) $args['fields'] as $name => $field ) {
									echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
								}
								echo  $args['fields_after'];								
							}
							echo apply_filters( 'comment_form_field_comment', $args['comment_field'] );
							echo  $args['comment_notes_after'];
							if ( !is_user_logged_in() ){ 
								do_action( 'comment_form_after_fields' ); 
							}
						?>
						<p class="form-submit">
							<button class="button button-secondary" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>"><?php echo esc_attr( $args['label_submit'] ); ?></button>

							<?php comment_id_fields( $post_id ); ?>
						</p>
						<?php do_action( 'comment_form', $post_id ); ?>
					</form>
				<?php endif; ?>
			</section>
			<?php do_action( 'comment_form_after' ); ?>
		<?php else : ?>
			<?php do_action( 'comment_form_comments_closed' ); ?>
		<?php endif; ?>
<?php
}

/* Save custom comment field on frontend */
add_action('comment_post', 'sanzo_save_custom_comment_fields');
function sanzo_save_custom_comment_fields( $comment_id ){
	if( isset($_POST['phone']) && $_POST['phone'] != '' ){
		$phone = wp_filter_nohtml_kses($_POST['phone']);
		add_comment_meta($comment_id, 'phone', $phone);
	}
}

/* Add custom comment field on backend */
add_action('add_meta_boxes_comment', 'sanzo_add_meta_boxes_comment');
function sanzo_add_meta_boxes_comment(){
	add_meta_box( 'comment_meta_box', esc_html__( 'Extra information', 'sanzo' ), 'sanzo_comment_meta_box_render', 'comment', 'normal', 'high' );
}

function sanzo_comment_meta_box_render( $comment ){
	$comment_id = $comment->comment_ID;
	$phone = get_comment_meta($comment_id, 'phone', true);
	?>
	<table>
		<tr>
			<td class="first"><label for="phone"><?php esc_html_e('Phone', 'sanzo'); ?></label></td>
			<td><input type="text" id="phone" name="phone" value="<?php echo esc_attr($phone) ?>" class="widefat" /></td>
		</tr>
	</table>
	<?php
}

/* Save custom comment field on backend */
add_action('edit_comment', 'sanzo_save_comment_meta_box');
function sanzo_save_comment_meta_box( $comment_id ){
	if( isset($_POST['phone']) && $_POST['phone'] != '' ){
		$phone = wp_filter_nohtml_kses($_POST['phone']);
		update_comment_meta($comment_id, 'phone', $phone);
	}
	else{
		delete_comment_meta($comment_id, 'phone');
	}
}

/* Change footer for the individual page */
add_filter('widget_display_callback', 'sanzo_change_footer_for_individual_page', 10, 3);
function sanzo_change_footer_for_individual_page( $instance, $object, $args ){
	global $post;
	if( is_page() && ($args['name'] == esc_html__('Footer Widget Area', 'sanzo') || $args['name'] == esc_html__('Footer Copyright Widget Area', 'sanzo')) 
		&& get_class($object) == 'TS_Footer_Block_Widget' ){
		if( $args['name'] == esc_html__('Footer Widget Area', 'sanzo') ){
			$block_id = get_post_meta($post->ID, 'ts_footer_id', true);
		}
		else{
			$block_id = get_post_meta($post->ID, 'ts_footer_copyright_id', true);
		}
		if( $block_id ){
			$instance['block_id'] = $block_id;
		}
	}
	return $instance;
}

add_filter('document_title_separator', function(){ return '|'; });

/* Remove bbpress title */
remove_filter('wp_title', 'bbp_title', 10, 3);

/* Body classes filter */
add_filter('body_class', 'sanzo_body_classes_filter');
function sanzo_body_classes_filter( $classes ){
	global $sanzo_theme_options;
	
	$classes[] = ($sanzo_theme_options['ts_layout_style'] == 'advance')?'layout-advance':$sanzo_theme_options['ts_layout_style'];
	
	if( $sanzo_theme_options['ts_layout_style'] == 'advance' ){
		$classes[] = 'header-' . $sanzo_theme_options['ts_header_layout_style'];
		$classes[] = 'main-content-' . $sanzo_theme_options['ts_main_content_layout_style'];
		$classes[] = 'footer-' . $sanzo_theme_options['ts_footer_layout_style'];
	}
	
	if( is_rtl() || ( isset($sanzo_theme_options['ts_enable_rtl']) && $sanzo_theme_options['ts_enable_rtl'] ) ){
		$classes[] = 'rtl';
	}
	
	if( !wp_is_mobile() ){
		$classes[] = 'ts_desktop';
	}
	
	if( is_page() ){
		$page_options = sanzo_get_page_options();
		if( !empty($page_options['ts_display_vertical_menu_by_default']) ){
			$classes[] = 'display-vertical-menu';
		}
	}
	
	if( $sanzo_theme_options['ts_vertical_menu_style'] != 'normal' ){
		$classes[] = 'vertical-menu-' . $sanzo_theme_options['ts_vertical_menu_style'];
	}
	
	return $classes;
}
?>
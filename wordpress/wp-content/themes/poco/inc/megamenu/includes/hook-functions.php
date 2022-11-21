<?php

defined( 'ABSPATH' ) || exit();

/**
 * Hook to delete post elementor related with this menu
 */
add_action( "before_delete_post", "poco_megamenu_on_delete_menu_item", 9 );
function poco_megamenu_on_delete_menu_item( $post_id ) {
	if( is_nav_menu_item($post_id) ){
		$related_id = poco_megamenu_get_post_related_menu( $post_id );
		if( $related_id ){
			wp_delete_post( $related_id, true );
		}
	}
}



add_filter( 'elementor/editor/footer', 'poco_megamenu_add_back_button_inspector' );
function poco_megamenu_add_back_button_inspector() {
	if ( ! isset( $_GET['poco-menu-editable'] ) || ! $_GET['poco-menu-editable'] ) {
		return;
	}
	?>
		<script type="text/javascript">
            (function($){
                 $( '#tmpl-elementor-panel-footer-content' ).remove();
            })(jQuery);
        </script>
        <script type="text/template" id="tmpl-elementor-panel-footer-content">
            <div id="elementor-panel-footer-back-to-admin" class="elementor-panel-footer-tool elementor-leave-open tooltip-target" data-tooltip="<?php esc_attr_e( 'Back', 'poco' ); ?>">
				<i class="fa fa-arrow-left" aria-hidden="true"></i>
			</div>
			<div id="elementor-panel-footer-responsive" class="elementor-panel-footer-tool">
				<i class="eicon-device-desktop tooltip-target" aria-hidden="true" data-tooltip="<?php esc_attr_e( 'Responsive Mode', 'poco' ); ?>"></i>
				<span class="elementor-screen-only">
					<?php echo esc_html__( 'Responsive Mode', 'poco' ); ?>
				</span>
				<div class="elementor-panel-footer-sub-menu-wrapper">
					<div class="elementor-panel-footer-sub-menu">
						<div class="elementor-panel-footer-sub-menu-item" data-device-mode="desktop">
							<i class="elementor-icon eicon-device-desktop" aria-hidden="true"></i>
							<span class="elementor-title"><?php echo esc_html__( 'Desktop', 'poco' ); ?></span>
							<span class="elementor-description"><?php echo esc_html__( 'Default Preview', 'poco' ); ?></span>
						</div>
						<div class="elementor-panel-footer-sub-menu-item" data-device-mode="tablet">
							<i class="elementor-icon eicon-device-tablet" aria-hidden="true"></i>
							<span class="elementor-title"><?php echo esc_html__( 'Tablet', 'poco' ); ?></span>
							<?php $breakpoints = Elementor\Core\Responsive\Responsive::get_breakpoints(); ?>
							<span class="elementor-description"><?php echo sprintf( esc_html__( 'Preview for %s', 'poco' ), $breakpoints['md'] . 'px' ); ?></span>
						</div>
						<div class="elementor-panel-footer-sub-menu-item" data-device-mode="mobile">
							<i class="elementor-icon eicon-device-mobile" aria-hidden="true"></i>
							<span class="elementor-title"><?php echo esc_html__( 'Mobile', 'poco' ); ?></span>
							<span class="elementor-description"><?php echo esc_html__( 'Preview for 360px', 'poco' ); ?></span>
						</div>
					</div>
				</div>
			</div>
			<div id="elementor-panel-footer-history" class="elementor-panel-footer-tool elementor-leave-open tooltip-target" data-tooltip="<?php esc_attr_e( 'History', 'poco' ); ?>">
				<i class="fa fa-history" aria-hidden="true"></i>
				<span class="elementor-screen-only"><?php echo esc_html__( 'History', 'poco' ); ?></span>
			</div>
			<div id="elementor-panel-saver-button-preview" class="elementor-panel-footer-tool tooltip-target" data-tooltip="<?php esc_attr_e( 'Preview Changes', 'poco' ); ?>">
				<span id="elementor-panel-saver-button-preview-label">
					<i class="fa fa-eye" aria-hidden="true"></i>
					<span class="elementor-screen-only"><?php echo esc_html__( 'Preview Changes', 'poco' ); ?></span>
				</span>
			</div>
			<div id="elementor-panel-saver-publish" class="elementor-panel-footer-tool">
				<button id="elementor-panel-saver-button-publish" class="elementor-button elementor-button-success elementor-saver-disabled">
					<span class="elementor-state-icon">
						<i class="fa fa-spin fa-circle-o-notch" aria-hidden="true"></i>
					</span>
					<span id="elementor-panel-saver-button-publish-label">
						<?php echo esc_html__( 'Publish', 'poco' ); ?>
					</span>
				</button>
			</div>
			<div id="elementor-panel-saver-save-options" class="elementor-panel-footer-tool" >
				<button id="elementor-panel-saver-button-save-options" class="elementor-button elementor-button-success tooltip-target elementor-saver-disabled" data-tooltip="<?php esc_attr_e( 'Save Options', 'poco' ); ?>">
					<i class="fa fa-caret-up" aria-hidden="true"></i>
					<span class="elementor-screen-only"><?php echo esc_html__( 'Save Options', 'poco' ); ?></span>
				</button>
				<div class="elementor-panel-footer-sub-menu-wrapper">
					<p class="elementor-last-edited-wrapper">
						<span class="elementor-state-icon">
							<i class="fa fa-spin fa-circle-o-notch" aria-hidden="true"></i>
						</span>
						<span class="elementor-last-edited">
							{{{ elementor.config.document.last_edited }}}
						</span>
					</p>
					<div class="elementor-panel-footer-sub-menu">
						<div id="elementor-panel-saver-menu-save-draft" class="elementor-panel-footer-sub-menu-item elementor-saver-disabled">
							<i class="elementor-icon fa fa-save" aria-hidden="true"></i>
							<span class="elementor-title"><?php echo esc_html__( 'Save Draft', 'poco' ); ?></span>
						</div>
						<div id="elementor-panel-saver-menu-save-template" class="elementor-panel-footer-sub-menu-item">
							<i class="elementor-icon fa fa-folder" aria-hidden="true"></i>
							<span class="elementor-title"><?php echo esc_html__( 'Save as Template', 'poco' ); ?></span>
						</div>
					</div>
				</div>
			</div>
        </script>

	<?php
}

add_action( 'wp_ajax_poco_load_menu_data', 'poco_megamenu_load_menu_data' );
function poco_megamenu_load_menu_data() {
	$nonce = ! empty( $_POST['nonce'] ) ? sanitize_text_field( $_POST['nonce'] ) : '';
	$menu_id = ! empty( $_POST['menu_id'] ) ? absint( $_POST['menu_id'] ) : false;
	if ( ! wp_verify_nonce( $nonce, 'poco-menu-data-nonce' ) || ! $menu_id ) {
		wp_send_json( array(
				'message' => esc_html__( 'Access denied', 'poco' )
			) );
	}

	$data =  poco_megamenu_get_item_data( $menu_id );

	$data = $data ? $data : array();
	if( isset($_POST['istop']) && absint($_POST['istop']) == 1  ){
		if ( class_exists( 'Elementor\Plugin' ) ) {
			if( isset($data['enabled']) && $data['enabled'] ){
				$related_id = poco_megamenu_get_post_related_menu( $menu_id );
				if ( ! $related_id  ) {
					poco_megamenu_create_related_post( $menu_id );
					$related_id = poco_megamenu_get_post_related_menu( $menu_id );
				}

				if ( $related_id && isset($_REQUEST['menu_id']) && is_admin() ) {
					$url = Elementor\Plugin::instance()->documents->get( $related_id )->get_edit_url();
					$data['edit_submenu_url'] = add_query_arg( array( 'poco-menu-editable' => 1 ), $url );
				}
			} else {
				$url = admin_url();
				$data['edit_submenu_url'] = add_query_arg( array( 'poco-menu-createable' => 1, 'menu_id' => $menu_id ), $url );
			}
		}
	}

	$results = apply_filters( 'poco_menu_settings_data', array(
			'status' => true,
			'data' => $data
	) );

	wp_send_json( $results );

}

add_action( 'wp_ajax_poco_update_menu_item_data', 'poco_megamenu_update_menu_item_data' );
function poco_megamenu_update_menu_item_data() {
	$nonce = ! empty( $_POST['nonce'] ) ? sanitize_text_field( $_POST['nonce'] ) : '';
	if ( ! wp_verify_nonce( $nonce, 'poco-update-menu-item' ) ) {
		wp_send_json( array(
				'message' => esc_html__( 'Access denied', 'poco' )
			) );
	}

	$settings = ! empty( $_POST['poco-menu-item'] ) ? ($_POST['poco-menu-item']) : array();
	$menu_id = ! empty( $_POST['menu_id'] ) ? absint( $_POST['menu_id'] ) : false;

	do_action( 'poco_before_update_menu_settings', $settings );


	poco_megamenu_update_item_data( $menu_id, $settings );

	do_action( 'poco_menu_settings_updated', $settings );
	wp_send_json( array( 'status' => true ) );
}

add_action( 'admin_footer', 'poco_megamenu_underscore_template' );
function poco_megamenu_underscore_template() {
	global $pagenow;
	if ( $pagenow === 'nav-menus.php' ) { ?>
		<script type="text/html" id="tpl-poco-menu-item-modal">
			<div id="poco-modal" class="poco-modal">
				<div id="poco-modal-body" class="<%= data.edit_submenu === true ? 'edit-menu-active' : ( data.is_loading ? 'loading' : '' ) %>">
					<% if ( data.edit_submenu !== true && data.is_loading !== true ) { %>
						<form id="menu-edit-form">
					<% } %>
						<div class="poco-modal-content">
							<% if ( data.edit_submenu === true ) { %>
								<iframe src="<%= data.edit_submenu_url %>" />
							<% } else if ( data.is_loading === true ) { %>
								<i class="fa fa-spin fa-spinner"></i>
							<% } else { %>

								<div class="form-group toggle-select-setting">
									<label for="icon"><?php esc_html_e( 'Icon', 'poco' ) ?></label>
									<select id="icon" name="poco-menu-item[icon]" class="form-control icon-picker poco-input-switcher poco-input-switcher-true" data-target=".icon-custom">
										<option value=""<%= data.icon == '' ? ' selected' : '' %>><?php echo esc_html__( "No Use", "poco" ) ?></option>
                                        <option value="1"<%= data.icon == 1 ? ' selected' : '' %>><?php echo esc_html__( "Custom Class", "poco" ) ?></option>
										<?php foreach ( poco_megamenu_get_fontawesome_icons() as $value ) : ?>
											<option value="<?php echo 'poco-icon-'.esc_attr( $value ) ?>"<%= data.icon == '<?php echo 'poco-icon-'.esc_attr( $value ) ?>' ? ' selected' : '' %>><?php echo esc_attr( $value ) ?></option>
										<?php endforeach ?>
									</select>
                                </div>
                                <div class="form-group icon-custom toggle-select-setting" style="display: none">
                                    <label for="icon-custom"><?php esc_html_e( 'Icon Class Name', 'poco' ) ?></label>
                                    <input type="text" name="poco-menu-item[icon-custom]" class="input" id="icon-custom"/>
                                </div>
								<div class="form-group">
									<label for="icon_color"><?php esc_html_e( 'Icon Color', 'poco' ) ?></label>
									<input class="color-picker" name="poco-menu-item[icon_color]" value="<%= data.icon_color %>" id="icon_color" />
								</div>

								<div class="form-group submenu-setting toggle-select-setting">
									<label><?php esc_html_e( 'Mega Submenu Enabled', 'poco' ) ?></label>
									<select name="poco-menu-item[enabled]" class="poco-input-switcher poco-input-switcher-true" data-target=".submenu-width-setting">
										<option value="1" <%= data.enabled == 1? 'selected':'' %>> <?php esc_html_e( 'Yes', 'poco' ) ?></opttion>
										<option value="0" <%= data.enabled == 0? 'selected':'' %>><?php esc_html_e( 'No', 'poco' ) ?></opttion>
									</select>
									<button id="edit-megamenu" class="button button-primary button-large">
										<?php esc_html_e( 'Edit Megamenu Submenu', 'poco' ) ?>
									</button>
								</div>

								<div class="form-group submenu-width-setting toggle-select-setting" style="display: none">
									<label><?php esc_html_e( 'Sub Megamenu Width', 'poco' ) ?></label>
									<select name="poco-menu-item[customwidth]" class="poco-input-switcher poco-input-switcher-true" data-target=".submenu-subwidth-setting">
                                        <option value="1" <%= data.customwidth == 1? 'selected':'' %>> <?php esc_html_e( 'Yes', 'poco' ) ?></opttion>
                                        <option value="0" <%= data.customwidth == 0? 'selected':'' %>><?php esc_html_e( 'Full Width', 'poco' ) ?></opttion>
                                        <option value="2" <%= data.customwidth == 2? 'selected':'' %>><?php esc_html_e( 'Stretch Width', 'poco' ) ?></opttion>
                                        <option value="3" <%= data.customwidth == 3? 'selected':'' %>><?php esc_html_e( 'Container Width', 'poco' ) ?></opttion>
									</select>
								</div>

								<div class="form-group submenu-width-setting submenu-subwidth-setting toggle-select-setting" style="display: none">
									<label for="menu_subwidth"><?php esc_html_e( 'Sub Mega Menu Max Width', 'poco' ) ?></label>
									<input type="text" name="poco-menu-item[subwidth]" value="<%= data.subwidth?data.subwidth:'600' %>" class="input" id="menu_subwidth" />
									<span class="unit">px</span>
								</div>

                                <div class="form-group submenu-width-setting submenu-subwidth-setting toggle-select-setting" style="display: none">
                                    <label><?php esc_html_e( 'Sub Mega Menu Position Left', 'poco' ) ?></label>
                                    <select name="poco-menu-item[menuposition]">
                                        <option value="0" <%= data.menuposition == 0? 'selected':'' %>><?php esc_html_e( 'No', 'poco' ) ?></opttion>
                                        <option value="1" <%= data.menuposition == 1? 'selected':'' %>> <?php esc_html_e( 'Yes', 'poco' ) ?></opttion>
                                    </select>
                                </div>

							<% } %>
						</div>
						<% if ( data.is_loading !== true && data.edit_submenu !== true ) { %>
							<div class="poco-modal-footer">
								<a href="#" class="close button"><%= poco_memgamnu_params.i18n.close %></a>
								<?php wp_nonce_field( 'poco-update-menu-item', 'nonce' ) ?>
								<input name="menu_id" value="<%= data.menu_id %>" type="hidden" />
								<button type="submit" class="button button-primary button-large menu-save pull-right"><%= poco_memgamnu_params.i18n.submit %></button>
							</div>
						<% } %>
					<% if ( data.edit_submenu !== true && data.is_loading !== true ) { %>
						</form>
					<% } %>
				</div>
				<div class="poco-modal-overlay"></div>
			</div>
		</script>
	<?php }
}








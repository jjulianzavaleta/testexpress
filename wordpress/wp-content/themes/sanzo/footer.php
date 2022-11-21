<div class="clear"></div>
</div><!-- #main .wrapper -->
	<?php if( !is_page_template('page-templates/blank-page-template.php') ): ?>
	<footer id="colophon">
		<div class="footer-container">
			<?php if( is_active_sidebar('footer-widget-area') ): ?>
			<div class="first-footer-area footer-area">
				<div class="container no-padding">
					<div class="ts-col-24">
						<?php dynamic_sidebar('footer-widget-area'); ?>
					</div>
				</div>
			</div>
			<?php endif; ?>
			
			<?php if( is_active_sidebar('footer-copyright-widget-area') ): ?>
			<div class="end-footer footer-area">
				<div class="container no-padding">
					<div class="ts-col-24">
						<?php dynamic_sidebar('footer-copyright-widget-area'); ?>
					</div>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</footer>
	<?php endif; ?>
</div><!-- #page -->

<?php 
global $sanzo_theme_options;
if( ( !wp_is_mobile() && $sanzo_theme_options['ts_back_to_top_button'] ) || ( wp_is_mobile() && $sanzo_theme_options['ts_back_to_top_button_on_mobile'] ) ): 
?>
<div id="to-top" class="scroll-button">
	<a class="scroll-button" href="javascript:void(0)" title="<?php esc_html_e('Back to Top', 'sanzo'); ?>"><?php esc_html_e('Top', 'sanzo'); ?></a>
</div>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
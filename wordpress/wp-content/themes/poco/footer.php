
		</div><!-- .col-full -->
	</div><!-- #content -->

	<?php do_action( 'poco_before_footer' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php
		/**
		 * Functions hooked in to poco_footer action
		 *
		 * @see poco_footer_default - 20
         * @see poco_handheld_footer_bar - 25 - woo
		 *
		 */
		do_action( 'poco_footer' );

		?>

	</footer><!-- #colophon -->

	<?php

		/**
		 * Functions hooked in to poco_after_footer action
		 * @see poco_sticky_single_add_to_cart 	- 999 - woo
		 */
		do_action( 'poco_after_footer' );
	?>

</div><!-- #page -->

<?php

/**
 * Functions hooked in to wp_footer action
 * @see poco_template_account_dropdown 	- 1
 * @see poco_mobile_nav - 1
 */

wp_footer();
?>

</body>
</html>

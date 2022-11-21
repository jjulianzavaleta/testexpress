<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	/**
	 * Functions hooked in to poco_loop_post action.
	 *
	 * @see poco_post_thumbnail       - 10
	 * @see poco_post_header          - 15
	 * @see poco_post_content         - 30
	 */
	do_action( 'poco_loop_post' );
	?>

</article><!-- #post-## -->


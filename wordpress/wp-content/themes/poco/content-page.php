<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * Functions hooked in to poco_page action
	 *
	 * @see poco_page_header          - 10
	 * @see poco_page_content         - 20
	 *
	 */
	do_action( 'poco_page' );
	?>
</article><!-- #post-## -->
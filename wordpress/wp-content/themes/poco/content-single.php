<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="single-content">
        <?php
        /**
         * Functions hooked in to poco_single_post_top action
         *
         * @see poco_post_thumbnail       - 10
         */
        do_action('poco_single_post_top');

        /**
         * Functions hooked in to poco_single_post action
         *
         * @see poco_post_header          - 10
         * @see poco_post_content         - 30
         */
        do_action('poco_single_post');
        ?>
    </div>
    <?php
    /**
     * Functions hooked in to poco_single_post_bottom action
     *
     * @see poco_post_taxonomy      - 5
     * @see poco_post_nav            - 10
     * @see poco_display_comments    - 20
     */
    do_action('poco_single_post_bottom');
    ?>

</article><!-- #post-## -->

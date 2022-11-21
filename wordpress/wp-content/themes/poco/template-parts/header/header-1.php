<header id="masthead" class="site-header header-1" role="banner" style="<?php poco_header_styles(); ?>">
    <div class="header-container">
        <div class="container header-main">
            <div class="header-left">
                <?php
                poco_site_branding();
                if (poco_is_woocommerce_activated()) {
                    ?>
                    <div class="site-header-cart header-cart-mobile">
                        <?php poco_cart_link(); ?>
                    </div>
                    <?php
                }
                ?>
                <?php poco_mobile_nav_button(); ?>
            </div>
            <div class="header-center">
                <?php poco_primary_navigation(); ?>
            </div>
            <div class="header-right desktop-hide-down">
                <?php
                poco_header_contact_info();
                ?>
                <div class="header-group-action">
                    <?php
                    poco_header_account();
                    if (poco_is_woocommerce_activated()) {
                        poco_header_wishlist();
                        poco_header_cart();
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</header><!-- #masthead -->

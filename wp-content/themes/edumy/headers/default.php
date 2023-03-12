<header id="apus-header" class="apus-header site-header visible-lg" role="banner">
    <div class="<?php echo (edumy_get_config('keep_header') ? 'main-sticky-header-wrapper' : ''); ?>">
        <div class="<?php echo (edumy_get_config('keep_header') ? 'main-sticky-header' : ''); ?>">
            <div class="container-fluid p-relative">
                <div class="flex-middle">
                    <div class="header-col-left flex-middle">
                        <div class="logo-in-theme pull-left">
                            <?php get_template_part( 'template-parts/logo/logo' ); ?>
                        </div>
                        <?php if ( has_nav_menu( 'primary' ) ) : ?>
                            <div class="pull-left">
                                <div class="main-menu">
                                    <nav data-duration="400" class="apus-megamenu slide animate navbar p-static" role="navigation">
                                    <?php
                                        $args = array(
                                            'theme_location' => 'primary',
                                            'container_class' => 'collapse navbar-collapse no-padding',
                                            'menu_class' => 'nav navbar-nav megamenu effect1',
                                            'fallback_cb' => '',
                                            'menu_id' => 'primary-menu',
                                            'walker' => new Edumy_Nav_Menu()
                                        );
                                        wp_nav_menu($args);
                                    ?>
                                    </nav>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>                    
                    <div class="header-col-right p-static flex-middle">
                        <div class="header-right">

                            <?php if ( defined('EDUMY_WOOCOMMERCE_ACTIVED') && edumy_get_config('show_cartbtn') && !edumy_get_config( 'enable_shop_catalog' ) ): ?>
                                <div class="pull-right">
                                    <?php get_template_part( 'woocommerce/cart/mini-cart-button' ); ?>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
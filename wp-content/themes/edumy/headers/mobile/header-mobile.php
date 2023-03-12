<div id="apus-header-mobile" class="header-mobile hidden-lg clearfix">    
    <div class="container">
        <div class="row flex-middle">            
            <div class="text-center col-xs-6">
                <?php
                    $logo = edumy_get_config('media-mobile-logo');
                ?>
                <?php if( isset($logo['url']) && !empty($logo['url']) ): ?>
                    <div class="logo">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
                            <img src="<?php echo esc_url( $logo['url'] ); ?>" alt="<?php bloginfo( 'name' ); ?>">
                        </a>
                    </div>
                <?php else: ?>
                    <div class="logo logo-theme">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
                            <img src="<?php echo esc_url_raw( get_template_directory_uri().'/images/logo.png'); ?>" alt="<?php bloginfo( 'name' ); ?>">
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="col-xs-6">
                <div class="pull-right margin-left-15">
                    <a href="#navbar-offcanvas" class="btn-showmenu"></a>                            
                </div>
                
                <?php if ( edumy_get_config('show_searchform') ): ?>
                    <div class="pull-right">
                        <div class="clearfix search-mobile">
                            <a href="javascript:void(0);" class="btn-showsearch"><i class="flaticon-magnifying-glass"></i></a>
                            <?php get_template_part( 'template-parts/searchform' ); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>               
        </div>

        <div class="header-bottom-mobile clearfix">
            <div class="flex-middle">
                <div class="setting-account-content">
                    <?php
                    if ( edumy_get_config('show_login_register', false) ) {
                        if ( is_user_logged_in() ) {
                            $user_id = get_current_user_id();
                            $user = get_userdata( $user_id );
                            ?>
                            <div class="setting-account">           
                                <div class="profile-menus flex-middle clearfix">
                                    <div class="profile-avarta"><?php echo get_avatar($user_id, 30); ?></div>
                                    <div class="profile-info">
                                        <span><?php echo esc_html($user->data->display_name); ?></span>
                                        <span class="fa fa-angle-down"></span>
                                    </div>
                                </div>
                                <div class="user-account">
                                    <ul class="user-log">
                                        <?php
                                        if ( has_nav_menu( 'my-account' ) ) {
                                            ?>
                                            <li>
                                                <?php
                                                    $args = array(
                                                        'theme_location'  => 'my-account',
                                                        'menu_class'      => 'list-line',
                                                        'fallback_cb'     => '',
                                                        'walker' => new Edumy_Nav_Menu()
                                                    );
                                                    wp_nav_menu($args);
                                                ?>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                        <li class="last"><a href="<?php echo esc_url(wp_logout_url(home_url('/'))); ?>"><?php esc_html_e('Log out ','edumy'); ?></a></li>
                                    </ul>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="account-login">
                                <ul class="login-account">
                                    <li class="icon-log"><a href="#apus_login_forgot_tab" class="apus-user-login"><i class="flaticon-user"></i></a></li>
                                    <li><a href="#apus_login_forgot_tab" class="apus-user-login wel-user"><?php esc_html_e( 'Login','edumy' ); ?>/</a></li>
                                    <li><a href="#apus_register_tab" class="apus-user-register wel-user"><?php esc_html_e( 'Register','edumy' ); ?></a></li>
                                </ul>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
                <div class="setting-account-intro flex-middle">
                    <?php if ( edumy_get_config('show_vertical_menu') && has_nav_menu( 'vertical-menu' ) ): ?>
                        <a class="text-title mobile-vertical-menu-title"><span><?php echo esc_html__('Library', 'edumy') ?></span><i class="flaticon-down-arrow"></i></a>
                    <?php endif; ?>
                    <?php if ( defined('EDUMY_WOOCOMMERCE_ACTIVED') && edumy_get_config('show_cartbtn') && !edumy_get_config( 'enable_shop_catalog' ) ): ?>
                        <div class="box-right pull-right">                        
                            <div class="top-cart">
                                <?php get_template_part( 'woocommerce/cart/mini-cart-button' ); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>        
    </div>
</div>
<?php if ( edumy_get_config('show_vertical_menu') && has_nav_menu( 'vertical-menu' ) ): ?>
    <div class="mobile-vertical-menu hidden-lg" style="display: none;">
        <div class="container">
            <nav class="navbar navbar-offcanvas navbar-static" role="navigation">
                <?php
                    $args = array(
                        'theme_location' => 'vertical-menu',
                        'container_class' => 'navbar-collapse navbar-offcanvas-collapse no-padding',
                        'menu_class' => 'nav navbar-nav',
                        'fallback_cb' => '',
                        'menu_id' => 'vertical-mobile-menu',
                        'walker' => new Edumy_Mobile_Vertical_Menu()
                    );
                    wp_nav_menu($args);
                ?>
            </nav>
        </div>
    </div>
<?php endif; ?>
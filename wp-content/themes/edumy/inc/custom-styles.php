<?php
if ( !function_exists ('edumy_custom_styles') ) {
	function edumy_custom_styles() {
		global $post;	
		
		ob_start();	
		?>
		
			<?php
				$main_font = edumy_get_config('main_font');
				$main_font = isset($main_font['font-family']) ? $main_font['font-family'] : false;
			?>
			<?php if ( $main_font ): ?>
				/* Main Font */
				body
				{
					font-family: 
					<?php echo '\'' . $main_font . '\','; ?> 
					sans-serif;
				}
			<?php endif; ?>
			
			<?php
				$heading_font = edumy_get_config('heading_font');
				$heading_font = isset($heading_font['font-family']) ? $heading_font['font-family'] : false;
			?>
			<?php if ( $heading_font ): ?>
				/* Heading Font */
				h1, h2, h3, h4, h5, h6, .widget-title,.widgettitle
				{
					font-family:  <?php echo '\'' . $heading_font . '\','; ?> sans-serif;
				}			
			<?php endif; ?>


			<?php if ( edumy_get_config('main_color') != "" ) : ?>
				/* seting background main */			
				.wishlist-icon .count, .mini-cart .count,.bg-theme,
				.widget-category-banner:hover::before,
				.btn-theme, .viewmore-products-btn,
				.apus-topcart .buttons .wc-forward:hover,
				.apus-topcart .buttons .wc-forward:focus,
				.apus-topcart .buttons .wc-forward:active,
				.nav-tabs.tabs-course > li.active a::after,		
				.nav-tabs.tabs-course > li > a:hover::after,	
				.mfp-content .apus_login_register_form .mfp-close,
				.learnpress .learn-press-checkout + a,
				.learnpress .learn-press-checkout + a:hover,
				.learnpress .learn-press-checkout + a:focus,
				.learnpress .learn-press-checkout + a:active,
				#commentform #submit,	
				.add-fix-top,
				.header-mobile .mobile-vertical-menu-title,
				.header-mobile .mobile-vertical-menu-title:hover,
				.header-mobile .mobile-vertical-menu-title:active,
				.header-mobile .mobile-vertical-menu-title:focus,
				.detail-post .apus-social-share a:hover,
				.detail-post .apus-social-share a:focus,
				.detail-post .apus-social-share a:active,
				.tagcloud a:hover, ul.tags li a:hover,
				.tagcloud a:focus, ul.tags li a:focus,
				.tagcloud a:active, ul.tags li a:active,
				.tagcloud a:active, ul.tags li a:active,
				.vertical-wrapper .title-vertical,
				.slick-carousel .slick-dots li.slick-active button,
				.apus-mfp-zoom-in .mfp-content .apus_login_register_form .mfp-close,
				.apus-mfp-zoom-in .mfp-content .apus_login_register_form .mfp-close:hover,
				.apus-mfp-zoom-in .mfp-content .apus_login_register_form .mfp-close:focus,
				.apus-mfp-zoom-in .mfp-content .apus_login_register_form .mfp-close:active,
				.widget.widget-call-to-action.style3 .btn, .widget.widget-call-to-action.style3 .viewmore-products-btn,
				.apus-mfp-zoom-in .mfp-content .apus_login_register_form .form-login-register-inner .btn-block,
				.apus-mfp-zoom-in .mfp-content .apus_login_register_form .form-login-register-inner .btn-block:hover,
				.apus-mfp-zoom-in .mfp-content .apus_login_register_form .form-login-register-inner .btn-block:focus,
				.apus-mfp-zoom-in .mfp-content .apus_login_register_form .form-login-register-inner .btn-block:active,
				.widget-testimonials.style2 .slick-carousel .slick-slide.slick-active .description,
				.mfp-content .apus_login_register_form .form-login-register-inner .btn-block,
				button, input[type="button"], input[type="reset"], input[type="submit"], button[type="button"], button[type="reset"], button[type="submit"],
				.apus-mfp-zoom-in .mfp-content .apus-register-form .list-roles .role-wrapper input[type="radio"]:checked + label::after,
				.widget.widget-mailchimp .btn:hover, .widget.widget-mailchimp .viewmore-products-btn:hover,
				.widget.widget-mailchimp .btn:focus, .widget.widget-mailchimp .viewmore-products-btn:focus,
				.widget.widget-mailchimp .btn:active, .widget.widget-mailchimp .viewmore-products-btn:active,
				.elementor-288 .elementor-element.elementor-element-db209ec > .elementor-background-overlay,
				.elementor-1451 .elementor-element.elementor-element-5711a65 > .elementor-background-overlay,
				.widget.widget-events .event-thumb:hover .entry-thumb .post-thumbnail .image-wrapper:before,
				.post.post-grid-v2:hover .entry-thumb .post-thumbnail .image-wrapper:before,
				.widget.widget-courses.courses-carousel-2 .slick-arrow:hover,
				.widget.widget-courses.courses-carousel-2 .slick-arrow:focus,
				.widget.widget-courses.courses-carousel-2 .slick-arrow:active,
				.widget.widget-blogs.carousel .slick-carousel .slick-arrow:hover,
				.widget.widget-blogs.carousel .slick-carousel .slick-arrow:focus,
				.widget.widget-blogs.carousel .slick-carousel .slick-arrow:active,
				.elementor-widget-text-editor .wpcf7-form input[type="submit"]:hover,
				.elementor-widget-text-editor .wpcf7-form input[type="submit"]:focus,
				.elementor-widget-text-editor .wpcf7-form input[type="submit"]:active,
				.elementor-1180 .elementor-element.elementor-element-6a5218f .widget-call-to-action,
				.elementor-1445 .elementor-element.elementor-element-3ded65f .widget-icon-box,
				.mfp-content .apus-register-form .list-roles .role-wrapper input[type="radio"]:checked + label::after,
				.elementor-element.elementor-widget-image-carousel .elementor-slick-slider .slick-slide-inner:before,
				.elementor-1675 .elementor-element.elementor-element-db209ec > .elementor-background-overlay,
				.elementor-1453 .elementor-element.elementor-element-e381b02 .widget-icon-box,
				.widget.widget-events .event-list-small:hover .event-post-date .startdate,
				.widget.widget-courses.courses-carousel-3 .slick-arrow,		
				.learnpress #learn-press-profile-nav .tabs > li.active > a::after,
				.widget[class*="widget_apus_course_filter"] ul li input[type="radio"]:checked + label::after,	
				.btn.course-share, .course-share.viewmore-products-btn,
				body #course-item-content-header .lp-form.lp-button-back .button,
				.learnpress .lp-list-table thead tr th,
				.woocommerce #respond input#submit,
				.woocommerce #respond input#submit:hover,
				.woocommerce #respond input#submit:focus,
				.woocommerce #respond input#submit:active,
				.learnpress .learn-press-message:before,
				.gallery .gallery-item .gallery-icon a::before,
				.woocommerce table.cart thead th,
				.woocommerce .percent-sale, .woocommerce span.onsale,
				.woocommerce .woocommerce-message .button, .woocommerce .checkout_coupon .button,
				.woocommerce .woocommerce-message .button:hover, .woocommerce .checkout_coupon .button:hover,
				.woocommerce .woocommerce-message .button:focus, .woocommerce .checkout_coupon .button:focus,
				.woocommerce .woocommerce-message .button:active, .woocommerce .checkout_coupon .button:active,
				.page-404 .widget-search .btn:hover, .page-404 .widget-search .viewmore-products-btn:hover,
				.page-404 .widget-search .btn:focus, .page-404 .widget-search .viewmore-products-btn:focus,
				.page-404 .widget-search .btn:active, .page-404 .widget-search .viewmore-products-btn:active,
				.widget.widget-instructors.style1 .slick-carousel .slick-arrow:hover,
				.widget.widget-instructors.style1 .slick-carousel .slick-arrow:focus,
				.widget.widget-instructors.style1 .slick-carousel .slick-arrow:active,
				.page-404 .widget-search .btn, .page-404 .widget-search .viewmore-products-btn,
				.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
				.woocommerce .widget_price_filter .price_slider_amount .button,
				.header_transparent .main-sticky-header:not(.sticky-header) section.elementor-element.has-bkg,
				.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,
				.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,
				.woocommerce #respond input#submit:focus, .woocommerce a.button:focus, .woocommerce button.button:focus, .woocommerce input.button:focus,
				.woocommerce #respond input#submit:active, .woocommerce a.button:active, .woocommerce button.button:active, .woocommerce input.button:active,
				.elementor-2336 .elementor-element.elementor-element-4e7ca82 > .elementor-background-overlay,
				.details-product .apus-woocommerce-product-gallery-wrapper .woocommerce-product-gallery__trigger:hover,
				.details-product .apus-woocommerce-product-gallery-wrapper .woocommerce-product-gallery__trigger:active,
				.details-product .apus-woocommerce-product-gallery-wrapper .woocommerce-product-gallery__trigger:focus,
				.woocommerce table.shop_table input.button:disabled:hover, .woocommerce table.shop_table input.button:hover,
				.woocommerce table.shop_table input.button:disabled:focus, .woocommerce table.shop_table input.button:focus,
				.woocommerce table.shop_table input.button:disabled:active, .woocommerce table.shop_table input.button:active,
				.apus-pagination .page-numbers li > span:hover, .apus-pagination .page-numbers li > span.current, .apus-pagination .page-numbers li > a:hover, .apus-pagination .page-numbers li > a.current, .apus-pagination .pagination li > span:hover, .apus-pagination .pagination li > span.current, .apus-pagination .pagination li > a:hover, .apus-pagination .pagination li > a.current,
				.apus-pagination .page-numbers li > span:active, .apus-pagination .page-numbers li > span.current, .apus-pagination .page-numbers li > a:active, .apus-pagination .page-numbers li > a.current, .apus-pagination .pagination li > span:active, .apus-pagination .pagination li > span.current, .apus-pagination .pagination li > a:active, .apus-pagination .pagination li > a.current,
				.apus-pagination .page-numbers li > span:focus, .apus-pagination .page-numbers li > span.current, .apus-pagination .page-numbers li > a:focus, .apus-pagination .page-numbers li > a.current, .apus-pagination .pagination li > span:focus, .apus-pagination .pagination li > span.current, .apus-pagination .pagination li > a:focus, .apus-pagination .pagination li > a.current,
				.apus-pagination .page-numbers li > span.next:hover, .apus-pagination .page-numbers li > span.next:focus, .apus-pagination .page-numbers li > span.next:active, .apus-pagination .page-numbers li > span.prev:hover, .apus-pagination .page-numbers li > span.prev:focus, .apus-pagination .page-numbers li > span.prev:active, .apus-pagination .page-numbers li > a.next:hover, .apus-pagination .page-numbers li > a.next:focus, .apus-pagination .page-numbers li > a.next:active, .apus-pagination .page-numbers li > a.prev:hover, .apus-pagination .page-numbers li > a.prev:focus, .apus-pagination .page-numbers li > a.prev:active, .apus-pagination .pagination li > span.next:hover, .apus-pagination .pagination li > span.next:focus, .apus-pagination .pagination li > span.next:active, .apus-pagination .pagination li > span.prev:hover, .apus-pagination .pagination li > span.prev:focus, .apus-pagination .pagination li > span.prev:active, .apus-pagination .pagination li > a.next:hover, .apus-pagination .pagination li > a.next:focus, .apus-pagination .pagination li > a.next:active, .apus-pagination .pagination li > a.prev:hover, .apus-pagination .pagination li > a.prev:focus, .apus-pagination .pagination li > a.prev:active,
				.learnpress .learn-press-pagination .page-numbers > li a:hover, .learnpress .learn-press-pagination .page-numbers > li span:hover,
				.learnpress .learn-press-pagination .page-numbers > li a:focus, .learnpress .learn-press-pagination .page-numbers > li span:focus,
				.learnpress .learn-press-pagination .page-numbers > li a:active, .learnpress .learn-press-pagination .page-numbers > li span:active,
				.course-curriculum ul.curriculum-sections ul.section-content .course-item.item-preview .course-item-status,
				.learnpress .learn-press-pagination .page-numbers > li a.current, .learnpress .learn-press-pagination .page-numbers > li span.current,
				.learnpress .lp-profile-content ul.list-education li::after, .learnpress .lp-profile-content ul.list-experience li::after,	
				.apus-pagination > span.next:hover, .apus-pagination > span.prev:hover, .apus-pagination > a.next:hover, .apus-pagination > a.prev:hover,
				.apus-pagination > span.next:active, .apus-pagination > span.prev:active, .apus-pagination > a.next:active, .apus-pagination > a.prev:active,
				.apus-pagination > span.next:focus, .apus-pagination > span.prev:focus, .apus-pagination > a.next:focus, .apus-pagination > a.prev:focus,
				.apus-pagination > span:hover, .apus-pagination > span.current, .apus-pagination > a:hover, .apus-pagination > a.current,
				.elementor-1451 .elementor-element.elementor-element-84b0da3 a.elementor-button, .elementor-1451 .elementor-element.elementor-element-84b0da3 .elementor-button,
				.elementor-1449 .elementor-element.elementor-element-2860793 a.elementor-button, .elementor-1449 .elementor-element.elementor-element-2860793 .elementor-button,
				.elementor-940 .elementor-element.elementor-element-93bae7c:not(.elementor-motion-effects-element-type-background), .elementor-940 .elementor-element.elementor-element-93bae7c > .elementor-motion-effects-container > .elementor-motion-effects-layer,
				.elementor-288 .elementor-element.elementor-element-be95fd4 a.elementor-button:hover, .elementor-288 .elementor-element.elementor-element-be95fd4 .elementor-button:hover, .elementor-288 .elementor-element.elementor-element-be95fd4 a.elementor-button:focus, .elementor-288 .elementor-element.elementor-element-be95fd4 .elementor-button:focus,
				.elementor-940 .elementor-element.elementor-element-c8435c9 a.elementor-button:hover, .elementor-940 .elementor-element.elementor-element-c8435c9 .elementor-button:hover, .elementor-940 .elementor-element.elementor-element-c8435c9 a.elementor-button:focus, .elementor-940 .elementor-element.elementor-element-c8435c9 .elementor-button:focus,				
				.elementor-1180 .elementor-element.elementor-element-293e43f a.elementor-button:hover, .elementor-1180 .elementor-element.elementor-element-293e43f .elementor-button:hover, .elementor-1180 .elementor-element.elementor-element-293e43f a.elementor-button:focus, .elementor-1180 .elementor-element.elementor-element-293e43f .elementor-button:focus,
				.elementor-1180 .elementor-element.elementor-element-f4d6c73 a.elementor-button:hover, .elementor-1180 .elementor-element.elementor-element-f4d6c73 .elementor-button:hover, .elementor-1180 .elementor-element.elementor-element-f4d6c73 a.elementor-button:focus, .elementor-1180 .elementor-element.elementor-element-f4d6c73 .elementor-button:focus,
				.elementor-1445 .elementor-element.elementor-element-f55c178 a.elementor-button:hover, .elementor-1445 .elementor-element.elementor-element-f55c178 .elementor-button:hover, .elementor-1445 .elementor-element.elementor-element-f55c178 a.elementor-button:focus, .elementor-1445 .elementor-element.elementor-element-f55c178 .elementor-button:focus,
				.elementor-1445 .elementor-element.elementor-element-c0e804c a.elementor-button:hover, .elementor-1445 .elementor-element.elementor-element-c0e804c .elementor-button:hover, .elementor-1445 .elementor-element.elementor-element-c0e804c a.elementor-button:focus, .elementor-1445 .elementor-element.elementor-element-c0e804c .elementor-button:focus,
				.apus-header .elementor-1468 .elementor-element.elementor-element-2060faf:not(.elementor-motion-effects-element-type-background), .elementor-1468 .elementor-element.elementor-element-2060faf > .elementor-motion-effects-container > .elementor-motion-effects-layer,
				.elementor.elementor-1445 .elementor-element.elementor-element-2597ee0:not(.elementor-motion-effects-element-type-background), .elementor-1445 .elementor-element.elementor-element-2597ee0 > .elementor-motion-effects-container > .elementor-motion-effects-layer,
				.elementor-1675 .elementor-element.elementor-element-be95fd4 a.elementor-button:hover, .elementor-1675 .elementor-element.elementor-element-be95fd4 .elementor-button:hover, .elementor-1675 .elementor-element.elementor-element-be95fd4 a.elementor-button:focus, .elementor-1675 .elementor-element.elementor-element-be95fd4 .elementor-button:focus,
				.elementor.elementor-1743 .elementor-element.elementor-element-2060faf:not(.elementor-motion-effects-element-type-background), .elementor-1743 .elementor-element.elementor-element-2060faf > .elementor-motion-effects-container > .elementor-motion-effects-layer,
				.woocommerce table.shop_table td .btn, .woocommerce table.shop_table td .viewmore-products-btn, .woocommerce table.shop_table .wishlist_table td.product-add-to-cart a, .woocommerce .wishlist_table table.shop_table td.product-add-to-cart a, .woocommerce table.shop_table td .wfg-button, .woocommerce table.shop_table td #add_payment_method .wc-proceed-to-checkout a.checkout-button, #add_payment_method .wc-proceed-to-checkout .woocommerce table.shop_table td a.checkout-button, .woocommerce table.shop_table td .woocommerce-cart .wc-proceed-to-checkout a.checkout-button, .woocommerce-cart .wc-proceed-to-checkout .woocommerce table.shop_table td a.checkout-button, .woocommerce table.shop_table td .woocommerce-checkout .wc-proceed-to-checkout a.checkout-button, .woocommerce-checkout .wc-proceed-to-checkout .woocommerce table.shop_table td a.checkout-button, .vertical-wrapper .title-vertical, .woocommerce-account .woocommerce-MyAccount-navigation .woocommerce-MyAccount-navigation-link a:before, .apus-offcanvas .offcanvas-head
				{
					background-color: <?php echo esc_html( edumy_get_config('main_color') ) ?> ;
				}

				.apus-breadscrumb::before,
				.single-envent-content .apus-countdown-dark {
					background-image: -webkit-linear-gradient(left, <?php echo esc_html( edumy_get_config('main_color') ) ?> 0%, #ff1053 100%);
					background-image: -o-linear-gradient(left, <?php echo esc_html( edumy_get_config('main_color') ) ?> 0%, #ff1053 100%);
					background-image: linear-gradient(to right, <?php echo esc_html( edumy_get_config('main_color') ) ?> 0%, #ff1053 100%);
				}

				/* setting color*/
				a:hover, a:focus, a:active,
				.apus-footer a:hover,.apus-footer a:focus,.apus-footer a:active,
				.nav-tabs.tabs-course > li.active a,
				.course-entry a:focus .course-title,
				.course-entry a:hover .course-title,
				.course-entry a:active .course-title,
				.elementor-1180 .elementor-element.elementor-element-6a5218f .btn,
				.detail-course .listing-wishlist a:hover,
				.detail-course .listing-wishlist a:focus,
				.detail-course .listing-wishlist a:active,
				.post.post-grid-v1 .list-categories a:hover,
				.post.post-grid-v1 .list-categories a:focus,
				.post.post-grid-v1 .list-categories a:active,
				.widget-social .social a:hover,
				.widget-social .social a:focus,
				.widget-social .social a:active,
				.learnpress .learn-press-message a,
				.learnpress .learn-press-message a:hover,
				.learnpress .learn-press-message a:focus,
				.learnpress .learn-press-message a:active,
				.widget-nav-menu.horizontal .menu li a:hover,
				.widget-nav-menu.horizontal .menu li a:focus,
				.widget-nav-menu.horizontal .menu li a:active,
				.btn.btn-read-more, .btn-read-more.viewmore-products-btn,
				.nav-tabs.tabs-course > li > a:hover, .nav-tabs.tabs-course > li > a:focus,.nav-tabs.tabs-course > li > a:active,
				.widget.widget-events .event-listing .entry-title a:hover,
				.widget.widget-events .event-listing .entry-title a:focus,
				.widget.widget-events .event-listing .entry-title a:active,
				.widget-icon-box.style3 .icon-box-image,
				.elementor-1453 .elementor-element.elementor-element-0d3edb2 .icon-box-image.icon,
				.elementor-1453 .elementor-element.elementor-element-0d3edb2 .title,
				.elementor-element.elementor-widget-image-carousel .slick-arrow::before,
				.learnpress #learn-press-profile-nav .tabs > li.active > a,
				.learnpress #learn-press-profile-nav .tabs > li a:focus::before,
				.learnpress #learn-press-profile-nav .tabs > li a:hover::before,
				.learnpress #learn-press-profile-nav .tabs > li a:active::before,
				body #course-item-content-header .lp-form.lp-button-back .button:hover,
				body #course-item-content-header .lp-form.lp-button-back .button:focus,
				body #course-item-content-header .lp-form.lp-button-back .button:active,
				.learnpress-page #course-item-content-header .course-title a:hover,
				.learnpress-page #course-item-content-header .course-title a:focus,
				.learnpress-page #course-item-content-header .course-title a:active,
				.learnpress #learn-press-profile-nav .tabs > li a:hover,
				.learnpress #learn-press-profile-nav .tabs > li a:focus,
				.learnpress #learn-press-profile-nav .tabs > li a:active,
				.learnpress #learn-press-profile-nav .tabs > li:hover:not(.active) > a,
				.learnpress #learn-press-profile-nav .tabs > li:focus:not(.active) > a,
				.learnpress #learn-press-profile-nav .tabs > li:active:not(.active) > a,
				.learnpress #learn-press-profile-nav .tabs > li .profile-tab-sections li a:active,
				.learnpress #learn-press-profile-nav .tabs > li .profile-tab-sections li a:hover,
				.learnpress #learn-press-profile-nav .tabs > li .profile-tab-sections li a:focus,
				.learnpress #profile-content-courses .lp-tab-sections li.active span,
				.account-login .login-account li a:hover,
				.account-login .login-account li a:focus,
				.account-login .login-account li a:active,
				.account-login .login-account.white li:hover a,
				.account-login .login-account.white li:focus a,
				.account-login .login-account.white li:active a,
				.megamenu > li > a:focus,
				.apus-custom-toplink li a:hover,
				.apus-custom-toplink li a:focus,
				.apus-custom-toplink li a:active,
				.apus_custom_menu.white .menu li a:hover,
				.apus_custom_menu.white .menu li a:focus,
				.apus_custom_menu.white .menu li a:active,
				.apus_custom_menu.white .menu li a:hover::before,
				.apus_custom_menu.white .menu li a:focus::before,
				.apus_custom_menu.white .menu li a:active::before,
				.widget.widget-instructors.highlight .instructor-name a:hover,
				.widget.widget-instructors.highlight .instructor-name a:focus,
				.widget.widget-instructors.highlight .instructor-name a:active,
				.post.post-grid-v5 .entry-title-detail a:hover,
				.post.post-grid-v5 .entry-title-detail a:focus,
				.post.post-grid-v5 .entry-title-detail a:active,
				.post.post-grid-v5 .list-categories a:hover,
				.post.post-grid-v5 .list-categories a:focus,
				.post.post-grid-v5 .list-categories a:active,
				.setting-account.white span:hover, .setting-account.white a:hover,
				.setting-account.white span:focus, .setting-account.white a:focus,
				.setting-account.white span:active, .setting-account.white a:active,
				.learnpress .lp-sub-menu li span,
				.tabs-v1 .nav-tabs > li.active > a,
				.detail-post .entry-tags-list a:hover,
				.detail-post .entry-tags-list a:focus,
				.detail-post .entry-tags-list a:active,
				.widget-nav-menu .menu li a:hover,
				.widget-nav-menu .menu li a:focus,
				.widget-nav-menu .menu li a:active,
				.widget-icon-box.style6 a:hover,
				.widget-icon-box.style6 a:focus,
				.widget-icon-box.style6 a:active,
				.apus-custom-toplink.gray li a:hover,
				.apus-custom-toplink.gray li a:focus,
				.apus-custom-toplink.gray li a:active,
				.widget-contact-intro .menu li a:hover,
				.widget-contact-intro .menu li a:focus,
				.widget-contact-intro .menu li a:active,
				.posts-list .top-info a:hover,.posts-list .top-info a:focus,.posts-list .top-info a:active,
				.woocommerce table.shop_table input.button:disabled, .woocommerce table.shop_table input.button,
				.elementor-widget-text-editor .wpcf7-form .pcf7-form-contact .wpcf7-submit,
				.mfp-content .apus_login_register_form .form-login-register-inner .back-link:hover,
				.mfp-content .apus_login_register_form .form-login-register-inner .back-link:focus,
				.mfp-content .apus_login_register_form .form-login-register-inner .back-link:active,
				.apus-language.gray .btn:hover, .apus-language.gray .viewmore-products-btn:hover,
				.apus-language.gray .btn:focus, .apus-language.gray .viewmore-products-btn:focus,
				.apus-language.gray .btn:active, .apus-language.gray .viewmore-products-btn:active,
				.learnpress .lp-tab-sections .section-tab.active span,
				body .course-item-nav .prev span, body .course-item-nav .next span, body .course-curriculum ul.curriculum-sections .section-content .course-item.current a,
				body .course-item-nav .prev span::before, body .course-item-nav .next span::before, body .course-curriculum ul.curriculum-sections .section-content .course-item.current a::before,
				.widget .event-detail-widget li a:hover,.widget .event-detail-widget li a:focus,.widget .event-detail-widget li a:active,
				.detail-course .course-section-panel .course-curriculum ul.curriculum-sections .section-content .course-item .section-item-link:hover,
				.detail-course .course-section-panel .course-curriculum ul.curriculum-sections .section-content .course-item .section-item-link:focus,
				.detail-course .course-section-panel .course-curriculum ul.curriculum-sections .section-content .course-item .section-item-link:active,
				.course-curriculum ul.curriculum-sections ul.section-content .course-item.course-item-lp_quiz .section-item-link:hover::before,
				.course-curriculum ul.curriculum-sections ul.section-content .course-item.course-item-lp_quiz .section-item-link:focus::before,
				.course-curriculum ul.curriculum-sections ul.section-content .course-item.course-item-lp_quiz .section-item-link:active::before,
				.course-curriculum ul.curriculum-sections ul.section-content .course-item.course-item-lp_lesson .section-item-link:hover::before,
				.course-curriculum ul.curriculum-sections ul.section-content .course-item.course-item-lp_lesson .section-item-link:active::before,
				.course-curriculum ul.curriculum-sections ul.section-content .course-item.course-item-lp_lesson .section-item-link:focus::before,
				.detail-course .course-section-panel .course-curriculum ul.curriculum-sections .section-content .course-item .section-item-link:hover .course-item-status::before,
				.detail-course .course-section-panel .course-curriculum ul.curriculum-sections .section-content .course-item .section-item-link:focus .course-item-status::before,
				.detail-course .course-section-panel .course-curriculum ul.curriculum-sections .section-content .course-item .section-item-link:active .course-item-status::before,
				.elementor-1675 .elementor-element.elementor-element-be95fd4 a.elementor-button, .elementor-1675 .elementor-element.elementor-element-be95fd4 .elementor-button,
				.elementor-940 .elementor-element.elementor-element-c8435c9 a.elementor-button, .elementor-940 .elementor-element.elementor-element-c8435c9 .elementor-button,
				.elementor-288 .elementor-element.elementor-element-be95fd4 a.elementor-button, .elementor-288 .elementor-element.elementor-element-be95fd4 .elementor-button,
				.elementor-1180 .elementor-element.elementor-element-293e43f a.elementor-button, .elementor-1180 .elementor-element.elementor-element-293e43f .elementor-button,
				.elementor-1180 .elementor-element.elementor-element-f4d6c73 a.elementor-button, .elementor-1180 .elementor-element.elementor-element-f4d6c73 .elementor-button,
				.elementor-1445 .elementor-element.elementor-element-f55c178 a.elementor-button, .elementor-1445 .elementor-element.elementor-element-f55c178 .elementor-button,
				.elementor-1445 .elementor-element.elementor-element-c0e804c a.elementor-button, .elementor-1445 .elementor-element.elementor-element-c0e804c .elementor-button,
				.widget_meta ul li:hover > a, .widget_archive ul li:hover > a, .widget_recent_entries ul li:hover > a, .widget_categories ul li:hover > a,
				.widget_meta ul li:focus > a, .widget_archive ul li:focus > a, .widget_recent_entries ul li:focus > a, .widget_categories ul li:focus > a,
				.widget_meta ul li:active > a, .widget_archive ul li:active > a, .widget_recent_entries ul li:active > a, .widget_categories ul li:active > a,
				.elementor-1449 .elementor-element.elementor-element-2b90f40 a.elementor-button:hover, .elementor-1449 .elementor-element.elementor-element-2b90f40 .elementor-button:hover, .elementor-1449 .elementor-element.elementor-element-2b90f40 a.elementor-button:focus, .elementor-1449 .elementor-element.elementor-element-2b90f40 .elementor-button:focus,
				.elementor-1449 .elementor-element.elementor-element-65485d9 a.elementor-button:hover, .elementor-1449 .elementor-element.elementor-element-65485d9 .elementor-button:hover, .elementor-1449 .elementor-element.elementor-element-65485d9 a.elementor-button:focus, .elementor-1449 .elementor-element.elementor-element-65485d9 .elementor-button:focus,
				.elementor-1451 .elementor-element.elementor-element-4267047 a.elementor-button:hover, .elementor-1451 .elementor-element.elementor-element-4267047 .elementor-button:hover, .elementor-1451 .elementor-element.elementor-element-4267047 a.elementor-button:focus, .elementor-1451 .elementor-element.elementor-element-4267047 .elementor-button:focus,
				.elementor-1451 .elementor-element.elementor-element-56f8573 a.elementor-button:hover, .elementor-1451 .elementor-element.elementor-element-56f8573 .elementor-button:hover, .elementor-1451 .elementor-element.elementor-element-56f8573 a.elementor-button:focus, .elementor-1451 .elementor-element.elementor-element-56f8573 .elementor-button:focus,
				.setting-account .user-account .list-line li a:hover, .woocommerce-account .woocommerce-MyAccount-navigation .woocommerce-MyAccount-navigation-link.is-active > a, .woocommerce-account .woocommerce-MyAccount-navigation .woocommerce-MyAccount-navigation-link:hover > a, .woocommerce-account .woocommerce-MyAccount-navigation .woocommerce-MyAccount-navigation-link:active > a, .navbar-offcanvas .main-mobile-menu li.active > a, .navbar-offcanvas .main-mobile-menu li a:hover, .navbar-offcanvas .main-mobile-menu li a:focus, .navbar-offcanvas .main-mobile-menu li a:hover
				{
					color: <?php echo esc_html( edumy_get_config('main_color') ) ?>;
				}


				/* setting border color*/
				.btn-theme, .viewmore-products-btn,		
				.apus-topcart .buttons .wc-forward:hover,
				.elementor-288 .elementor-element.elementor-element-be95fd4 .elementor-button,
				.elementor-940 .elementor-element.elementor-element-c8435c9 .elementor-button,								
				.elementor-1180 .elementor-element.elementor-element-293e43f .elementor-button,
				.elementor-1180 .elementor-element.elementor-element-f4d6c73 .elementor-button,
				.elementor-1445 .elementor-element.elementor-element-f55c178 .elementor-button,
				.mfp-content .apus-register-form .list-roles .role-wrapper input[type="radio"]:checked + label::after,
				.woocommerce table.shop_table input.button:disabled, .woocommerce table.shop_table input.button,
				.elementor-1445 .elementor-element.elementor-element-c0e804c .elementor-button,
				.elementor-widget-text-editor .wpcf7-form input[type="submit"]:hover,
				.elementor-widget-text-editor .wpcf7-form input[type="submit"]:focus,
				.elementor-widget-text-editor .wpcf7-form input[type="submit"]:active,
				.elementor-1675 .elementor-element.elementor-element-be95fd4 .elementor-button,
				body #course-item-content-header .lp-form.lp-button-back .button,
				.learnpress #profile-content-courses .lp-tab-sections li.active span,
				.learnpress .lp-tab-sections .section-tab.active span,
				.tabs-v1 .nav-tabs > li.active > a,
				.elementor-widget-text-editor .wpcf7-form .pcf7-form-contact .wpcf7-submit,
				.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
				.widget[class*="widget_apus_course_filter"] ul li input[type="radio"]:checked + label::after,
				.apus-mfp-zoom-in .mfp-content .apus-register-form .list-roles .role-wrapper input[type="radio"]:checked + label::after,
				.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,
				.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,
				.woocommerce #respond input#submit:focus, .woocommerce a.button:focus, .woocommerce button.button:focus, .woocommerce input.button:focus,
				.woocommerce #respond input#submit:active, .woocommerce a.button:active, .woocommerce button.button:active, .woocommerce input.button:active,
				.learnpress .lp-profile-content ul.list-education li::before, .learnpress .lp-profile-content ul.list-experience li::before,
				.apus-pagination > span.next:hover, .apus-pagination > span.prev:hover, .apus-pagination > a.next:hover, .apus-pagination > a.prev:hover,
				.apus-pagination > span.next:active, .apus-pagination > span.prev:active, .apus-pagination > a.next:active, .apus-pagination > a.prev:active,
				.apus-pagination > span.next:focus, .apus-pagination > span.prev:focus, .apus-pagination > a.next:focus, .apus-pagination > a.prev:focus,
				.elementor-1445 .elementor-element.elementor-element-f55c178 a.elementor-button:hover, .elementor-1445 .elementor-element.elementor-element-f55c178 .elementor-button:hover, .elementor-1445 .elementor-element.elementor-element-f55c178 a.elementor-button:focus, .elementor-1445 .elementor-element.elementor-element-f55c178 .elementor-button:focus,
				.elementor-1445 .elementor-element.elementor-element-c0e804c a.elementor-button:hover, .elementor-1445 .elementor-element.elementor-element-c0e804c .elementor-button:hover, .elementor-1445 .elementor-element.elementor-element-c0e804c a.elementor-button:focus, .elementor-1445 .elementor-element.elementor-element-c0e804c .elementor-button:focus,
				.elementor-1675 .elementor-element.elementor-element-be95fd4 a.elementor-button:hover, .elementor-1675 .elementor-element.elementor-element-be95fd4 .elementor-button:hover, .elementor-1675 .elementor-element.elementor-element-be95fd4 a.elementor-button:focus, .elementor-1675 .elementor-element.elementor-element-be95fd4 .elementor-button:focus,
				.apus-pagination .page-numbers li > span.next:hover, .apus-pagination .page-numbers li > span.next:focus, .apus-pagination .page-numbers li > span.next:active, .apus-pagination .page-numbers li > span.prev:hover, .apus-pagination .page-numbers li > span.prev:focus, .apus-pagination .page-numbers li > span.prev:active, .apus-pagination .page-numbers li > a.next:hover, .apus-pagination .page-numbers li > a.next:focus, .apus-pagination .page-numbers li > a.next:active, .apus-pagination .page-numbers li > a.prev:hover, .apus-pagination .page-numbers li > a.prev:focus, .apus-pagination .page-numbers li > a.prev:active, .apus-pagination .pagination li > span.next:hover, .apus-pagination .pagination li > span.next:focus, .apus-pagination .pagination li > span.next:active, .apus-pagination .pagination li > span.prev:hover, .apus-pagination .pagination li > span.prev:focus, .apus-pagination .pagination li > span.prev:active, .apus-pagination .pagination li > a.next:hover, .apus-pagination .pagination li > a.next:focus, .apus-pagination .pagination li > a.next:active, .apus-pagination .pagination li > a.prev:hover, .apus-pagination .pagination li > a.prev:focus, .apus-pagination .pagination li > a.prev:active
				{
					border-color: <?php echo esc_html( edumy_get_config('main_color') ) ?> !important;
				}

				.text-theme,
				.setting-account.white .user-account li a:hover,
				.setting-account.white .user-account li a:focus,
				.setting-account.white .user-account li a:active			
				{
					color: <?php echo esc_html( edumy_get_config('main_color') ) ?> !important;
				}

				.apus-checkout-step li.active .inner::after {
					border-color: #fff <?php echo esc_html( edumy_get_config('main_color') ) ?>;
				}


			<?php endif; ?>
			<?php if ( edumy_get_config('second_color') != "" ) : ?>
				.woocommerce div.product form.cart .button, .woocommerce-cart .wc-proceed-to-checkout .btn, #add_payment_method #payment .place-order #place_order, .woocommerce-cart #payment .place-order #place_order, .woocommerce-checkout #payment .place-order #place_order, .learnpress .lp-profile-content ul.list-education li:nth-child(2n):after, .learnpress .lp-profile-content ul.list-experience li:nth-child(2n):after {
					background-color: <?php echo esc_html( edumy_get_config('second_color') ) ?>;
				}
				.product-block.grid .groups-button .add-cart .added_to_cart, .product-block.grid .groups-button .add-cart .button
				{
					background-color: <?php echo esc_html( edumy_get_config('second_color') ) ?> !important;
				}
				.elementor .elementor-2663 .elementor-element.elementor-element-69f2d25 .widget-content a:hover, .elementor .elementor-2663 .elementor-element.elementor-element-2e6a1e8 .widget-content a:hover, .megamenu .dropdown-menu li.current-menu-item > a, .megamenu .dropdown-menu li.open > a, .megamenu .dropdown-menu li.active > a, .megamenu .dropdown-menu li > a:hover, .woocommerce-checkout .woocommerce-info a, .apus-pagination > span.next:after, .apus-pagination > a.next:after {
					color: <?php echo esc_html( edumy_get_config('second_color') ) ?>;
				}

			<?php endif; ?>
			
	<?php
		$content = ob_get_clean();
		$content = str_replace(array("\r\n", "\r"), "\n", $content);
		$lines = explode("\n", $content);
		$new_lines = array();
		foreach ($lines as $i => $line) {
			if (!empty($line)) {
				$new_lines[] = trim($line);
			}
		}
		
		return implode($new_lines);
	}
}
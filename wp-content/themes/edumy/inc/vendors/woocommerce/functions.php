<?php

if ( !function_exists('edumy_get_products') ) {
    function edumy_get_products( $args = array() ) {
        global $woocommerce, $wp_query;

        $args = wp_parse_args( $args, array(
            'categories' => array(),
            'product_type' => 'recent_product',
            'paged' => 1,
            'post_per_page' => -1,
            'orderby' => '',
            'order' => '',
            'includes' => array(),
            'excludes' => array(),
            'author' => '',
        ));
        extract($args);
        
        $query_args = array(
            'post_type' => 'product',
            'posts_per_page' => $post_per_page,
            'post_status' => 'publish',
            'paged' => $paged,
            'orderby'   => $orderby,
            'order' => $order
        );

        if ( isset( $query_args['orderby'] ) ) {
            if ( 'price' == $query_args['orderby'] ) {
                $query_args = array_merge( $query_args, array(
                    'meta_key'  => '_price',
                    'orderby'   => 'meta_value_num'
                ) );
            }
            if ( 'featured' == $query_args['orderby'] ) {
                $query_args = array_merge( $query_args, array(
                    'meta_key'  => '_featured',
                    'orderby'   => 'meta_value'
                ) );
            }
            if ( 'sku' == $query_args['orderby'] ) {
                $query_args = array_merge( $query_args, array(
                    'meta_key'  => '_sku',
                    'orderby'   => 'meta_value'
                ) );
            }
        }

        switch ($product_type) {
            case 'best_selling':
                $query_args['meta_key']='total_sales';
                $query_args['orderby']='meta_value_num';
                $query_args['ignore_sticky_posts']   = 1;
                $query_args['meta_query'] = array();
                $query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $query_args['meta_query'][] = $woocommerce->query->visibility_meta_query();
                break;
            case 'featured_product':
                $product_visibility_term_ids = wc_get_product_visibility_term_ids();
                $query_args['tax_query'][] = array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'term_taxonomy_id',
                    'terms'    => $product_visibility_term_ids['featured'],
                );
                break;
            case 'top_rate':
                //add_filter( 'posts_clauses',  array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
                $query_args['meta_query'] = array();
                $query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $query_args['meta_query'][] = $woocommerce->query->visibility_meta_query();
                break;
            case 'recent_product':
                $query_args['meta_query'] = array();
                $query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                break;
            case 'deals':
                $query_args['meta_query'] = array();
                $query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $query_args['meta_query'][] = $woocommerce->query->visibility_meta_query();
                $query_args['meta_query'][] =  array(
                    array(
                        'key'           => '_sale_price_dates_to',
                        'value'         => time(),
                        'compare'       => '>',
                        'type'          => 'numeric'
                    )
                );
                break;     
            case 'on_sale':
                $product_ids_on_sale    = wc_get_product_ids_on_sale();
                $product_ids_on_sale[]  = 0;
                $query_args['post__in'] = $product_ids_on_sale;
                break;
            case 'recent_review':
                if($post_per_page == -1) $_limit = 4;
                else $_limit = $post_per_page;
                global $wpdb;
                $query = "SELECT c.comment_post_ID FROM {$wpdb->prefix}posts p, {$wpdb->prefix}comments c
                        WHERE p.ID = c.comment_post_ID AND c.comment_approved > 0 AND p.post_type = 'product' AND p.post_status = 'publish' AND p.comment_count > 0
                        ORDER BY c.comment_date ASC";
                $results = $wpdb->get_results($query, OBJECT);
                $_pids = array();
                foreach ($results as $re) {
                    if(!in_array($re->comment_post_ID, $_pids))
                        $_pids[] = $re->comment_post_ID;
                    if(count($_pids) == $_limit)
                        break;
                }

                $query_args['meta_query'] = array();
                $query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $query_args['meta_query'][] = $woocommerce->query->visibility_meta_query();
                $query_args['post__in'] = $_pids;

                break;
            case 'rand':
                $query_args['orderby'] = 'rand';
                break;
        }

        if ( !empty($categories) && is_array($categories) ) {
            $query_args['tax_query'][] = array(
                'taxonomy'      => 'product_cat',
                'field'         => 'slug',
                'terms'         => $categories,
                'operator'      => 'IN'
            );
        }

        if (!empty($includes) && is_array($includes)) {
            $query_args['post__in'] = $includes;
        }
        
        if ( !empty($excludes) && is_array($excludes) ) {
            $query_args['post__not_in'] = $excludes;
        }

        if ( !empty($author) ) {
            $query_args['author'] = $author;
        }
        if ( $product_type == 'top_rate' && class_exists('WC_Shortcode_Products') ) {
            add_filter( 'posts_clauses', array( 'WC_Shortcode_Products', 'order_by_rating_post_clauses' ) );
            $loop = new WP_Query($query_args);
            call_user_func( implode('_', array('remove', 'filter')), 'posts_clauses', array( 'WC_Shortcode_Products', 'order_by_rating_post_clauses' ) );
        } else {
            $loop = new WP_Query($query_args);
        }
        return $loop;
    }
}

// Style hooks
function edumy_woocommerce_enqueue_styles() {
    wp_enqueue_style( 'edumy-wc-quantity-increment', get_template_directory_uri() .'/css/wc-quantity-increment.css' );
    wp_enqueue_style( 'edumy-woocommerce', get_template_directory_uri() .'/css/woocommerce.css' , 'edumy-woocommerce-front' , EDUMY_THEME_VERSION, 'all' );
}
add_action( 'wp_enqueue_scripts', 'edumy_woocommerce_enqueue_styles', 99 );

function edumy_woocommerce_enqueue_scripts() {
    wp_enqueue_script( 'selectWoo' );
    wp_enqueue_style( 'select2' );
    
    
    wp_enqueue_script( 'edumy-number-polyfill', get_template_directory_uri() . '/js/number-polyfill.min.js', array( 'jquery' ), '20150330', true );
    wp_enqueue_script( 'edumy-quantity-increment', get_template_directory_uri() . '/js/wc-quantity-increment.js', array( 'jquery' ), '20150330', true );

    wp_register_script( 'edumy-woocommerce', get_template_directory_uri() . '/js/woocommerce.js', array( 'jquery', 'jquery-unveil', 'slick' ), '20150330', true );

    $options = array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'enable_search' => (edumy_get_config('enable_autocompleate_search', true) ? '1' : '0'),
        'template' => apply_filters( 'edumy_autocompleate_search_template', '<div class="autocomplete-list-item"><a href="{{url}}" class="media autocompleate-media"><div class="media-left media-middle"><img src="{{image}}" class="media-object" height="100" width="100"></div><div class="media-body media-middle"><h3 class="name-product">{{title}}</h3><div class="price">{{price}}</div></div></a></div>' ),
        'empty_msg' => apply_filters( 'edumy_autocompleate_search_empty_msg', esc_html__( 'Unable to find any products that match the currenty query', 'edumy' ) ),
        'nonce' => wp_create_nonce( 'ajax-nonce' ),
        'view_more_text' => esc_html__('View More', 'edumy'),
        'view_less_text' => esc_html__('View Less', 'edumy'),
        '_preset' => edumy_get_demo_preset()
    );
    wp_localize_script( 'edumy-woocommerce', 'edumy_woo_options', $options );
    wp_enqueue_script( 'edumy-woocommerce' );
    
    wp_enqueue_script( 'wc-add-to-cart-variation' );

    
}
add_action( 'wp_enqueue_scripts', 'edumy_woocommerce_enqueue_scripts', 10 );

// cart
if ( !function_exists('edumy_woocommerce_header_add_to_cart_fragment') ) {
    function edumy_woocommerce_header_add_to_cart_fragment( $fragments ){
        global $woocommerce;
        $fragments['.cart .count'] =  ' <span class="count"> '. $woocommerce->cart->cart_contents_count .' </span> ';
        $fragments['.footer-mini-cart .count'] =  ' <span class="count"> '. $woocommerce->cart->cart_contents_count .' </span> ';
        $fragments['.cart .total-minicart'] = '<div class="total-minicart">'. $woocommerce->cart->get_cart_total(). '</div>';
        return $fragments;
    }
}
add_filter('woocommerce_add_to_cart_fragments', 'edumy_woocommerce_header_add_to_cart_fragment' );

// breadcrumb for woocommerce page
if ( !function_exists('edumy_woocommerce_breadcrumb_defaults') ) {
    function edumy_woocommerce_breadcrumb_defaults( $args ) {
        $breadcrumb_img = edumy_get_config('woo_breadcrumb_image');
        $breadcrumb_color = edumy_get_config('woo_breadcrumb_color');
        $style = $classes = array();
        $show_breadcrumbs = edumy_get_config('show_product_breadcrumbs', true);

        if ( !$show_breadcrumbs ) {
            $style[] = 'display:none';
        }
        if( $breadcrumb_color  ){
            $style[] = 'background-color:'.$breadcrumb_color;
        }
        if ( isset($breadcrumb_img['url']) && !empty($breadcrumb_img['url']) ) {
            $style[] = 'background-image:url(\''.esc_url($breadcrumb_img['url']).'\')';
            $classes[] = 'has_bg';
        }
        $estyle = !empty($style) ? ' style="'.implode(";", $style).'"':"";
        if ( is_single() ) {
            $classes[] = 'woo-detail';
            $title = '<h2 class="bread-title">'.esc_html__('Shop', 'edumy').'</h2>';
        } elseif ( is_product_taxonomy() ) {
            global $wp_query;
            $term = $wp_query->queried_object;
            $category_name = esc_html__('Shop', 'edumy');
            if ( isset( $term->name) ) {
                $category_name = $term->name;
            }
            
            $title = '<h2 class="bread-title">'.$category_name.'</h2>';
        } else {
            $title = '<h2 class="bread-title">'.woocommerce_page_title(false).'</h2>';
        }

        $full_width = apply_filters('edumy_woocommerce_content_class', 'container');
        
        $args['wrap_before'] = '<section id="apus-breadscrumb" class="apus-breadscrumb woo-breadcrumb '.esc_attr(!empty($classes) ? implode(' ', $classes) : '').'"'.$estyle.'><div class="'.$full_width.'"><div class="wrapper-breads"><div class="wrapper-breads-inner">'. $title.'
        <ol class="breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>';
        $args['wrap_after'] = '</ol></div></div></div></section>';

        return $args;
    }
}
add_filter( 'woocommerce_breadcrumb_defaults', 'edumy_woocommerce_breadcrumb_defaults' );
add_action( 'edumy_woo_template_main_before', 'woocommerce_breadcrumb', 30, 0 );

// display woocommerce modes
if ( !function_exists('edumy_woocommerce_display_modes') ) {
    function edumy_woocommerce_display_modes(){
        global $wp;
        $current_url = edumy_shop_page_link(true);

        $url_grid = add_query_arg( 'display_mode', 'grid', remove_query_arg( 'display_mode', $current_url ) );
        $url_list = add_query_arg( 'display_mode', 'list', remove_query_arg( 'display_mode', $current_url ) );

        $woo_mode = edumy_woocommerce_get_display_mode();

        echo '<div class="display-mode pull-right">';
        echo '<a href="'.  $url_grid  .'" class=" change-view '.($woo_mode == 'grid' ? 'active' : '').'"><i class="ti-layout-grid3"></i></a>';
        echo '<a href="'.  $url_list  .'" class=" change-view '.($woo_mode == 'list' ? 'active' : '').'"><i class="ti-view-list-alt"></i></a>';
        echo '</div>'; 
    }
}

if ( !function_exists('edumy_woocommerce_get_display_mode') ) {
    function edumy_woocommerce_get_display_mode() {
        $woo_mode = edumy_get_config('product_display_mode', 'grid');
        $args = array( 'grid', 'list' );
        if ( isset($_COOKIE['edumy_woo_mode']) && in_array($_COOKIE['edumy_woo_mode'], $args) ) {
            $woo_mode = $_COOKIE['edumy_woo_mode'];
        }
        return $woo_mode;
    }
}

if(!function_exists('edumy_shop_page_link')) {
    function edumy_shop_page_link($keep_query = false ) {
        if ( defined( 'SHOP_IS_ON_FRONT' ) ) {
            $link = home_url();
        } elseif ( is_post_type_archive( 'product' ) || is_page( wc_get_page_id('shop') ) ) {
            $link = get_post_type_archive_link( 'product' );
        } else {
            $link = get_term_link( get_query_var('term'), get_query_var('taxonomy') );
        }

        if( $keep_query ) {
            // Keep query string vars intact
            foreach ( $_GET as $key => $val ) {
                if ( 'orderby' === $key || 'submit' === $key ) {
                    continue;
                }
                $link = add_query_arg( $key, $val, $link );

            }
        }
        return $link;
    }
}


// add filter to top archive
add_action( 'woocommerce_top_pagination', 'woocommerce_pagination', 1 );

if ( !function_exists('edumy_before_woocommerce_init') ) {
    function edumy_before_woocommerce_init() {
        // set display mode to cookie
        if( isset($_GET['display_mode']) && ($_GET['display_mode']=='list' || $_GET['display_mode']=='grid') ){  
            setcookie( 'edumy_woo_mode', trim($_GET['display_mode']) , time()+3600*24*100,'/' );
            $_COOKIE['edumy_woo_mode'] = trim($_GET['display_mode']);
        }

        if ( edumy_get_config('show_quickview', false) ) {
            add_action( 'wp_ajax_edumy_quickview_product', 'edumy_woocommerce_quickview' );
            add_action( 'wp_ajax_nopriv_edumy_quickview_product', 'edumy_woocommerce_quickview' );
        }
    }
}
add_action( 'init', 'edumy_before_woocommerce_init' );

// quickview
if ( !function_exists('edumy_woocommerce_quickview') ) {
    function edumy_woocommerce_quickview() {
        if ( !empty($_GET['product_id']) ) {
            $args = array(
                'post_type' => 'product',
                'post__in' => array($_GET['product_id'])
            );
            $query = new WP_Query($args);
            if ( $query->have_posts() ) {
                while ($query->have_posts()): $query->the_post(); global $product;
                    wc_get_template_part( 'content', 'product-quickview' );
                endwhile;
            }
            wp_reset_postdata();
        }
        die;
    }
}

// Number of products per page
if ( !function_exists('edumy_woocommerce_shop_per_page') ) {
    function edumy_woocommerce_shop_per_page($number) {
        
        if ( isset( $_REQUEST['wppp_ppp'] ) ) :
            $number = intval( $_REQUEST['wppp_ppp'] );
            WC()->session->set( 'products_per_page', intval( $_REQUEST['wppp_ppp'] ) );
        elseif ( isset( $_REQUEST['ppp'] ) ) :
            $number = intval( $_REQUEST['ppp'] );
            WC()->session->set( 'products_per_page', intval( $_REQUEST['ppp'] ) );
        elseif ( WC()->session->__isset( 'products_per_page' ) ) :
            $number = intval( WC()->session->__get( 'products_per_page' ) );
        else :
            $value = edumy_get_config('number_products_per_page', 12);
            $number = intval( $value );
        endif;
        
        return $number;

    }
}
add_filter( 'loop_shop_per_page', 'edumy_woocommerce_shop_per_page', 30 );

// Number of products per row
if ( !function_exists('edumy_woocommerce_shop_columns') ) {
    function edumy_woocommerce_shop_columns($number) {
        $value = edumy_get_config('product_columns');
        if ( in_array( $value, array(1, 2, 3, 4, 5, 6, 7, 8) ) ) {
            $number = $value;
        }
        return $number;
    }
}
add_filter( 'loop_shop_columns', 'edumy_woocommerce_shop_columns' );

// share box
if ( !function_exists('edumy_woocommerce_share_box') ) {
    function edumy_woocommerce_share_box() {
        if ( edumy_get_config('show_product_social_share', false) ) {
            get_template_part( 'template-parts/sharebox' );
        }
    }
}
add_filter( 'woocommerce_single_product_summary', 'edumy_woocommerce_share_box', 100 );



// swap effect
if ( !function_exists('edumy_swap_images') ) {
    function edumy_swap_images() {
        global $post, $product, $woocommerce;
        
        $thumb = 'woocommerce_thumbnail';
        $output = '';
        $class = "attachment-$thumb size-$thumb image-no-effect";
        if (has_post_thumbnail()) {
            $swap_image = edumy_get_config('enable_swap_image', true);
            if ( $swap_image ) {
                $attachment_ids = $product->get_gallery_image_ids();
                if ($attachment_ids && isset($attachment_ids[0])) {
                    $class = "attachment-$thumb size-$thumb image-hover";
                    $swap_class = "attachment-$thumb size-$thumb image-effect";
                    $output .= edumy_get_attachment_thumbnail( $attachment_ids[0], $thumb, false, array('class' => $swap_class), false);
                }
            }
            $output .= edumy_get_attachment_thumbnail( get_post_thumbnail_id(), $thumb , false, array('class' => $class), false);
        } else {
            $image_sizes = get_option('shop_catalog_image_size');
            $placeholder_width = $image_sizes['width'];
            $placeholder_height = $image_sizes['height'];

            $output .= '<img src="'.wc_placeholder_img_src().'" alt="'.esc_attr__('Placeholder' , 'edumy').'" class="'.$class.'" width="'.$placeholder_width.'" height="'.$placeholder_height.'" />';
        }
        echo trim($output);
    }
}
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action('woocommerce_before_shop_loop_item_title', 'edumy_swap_images', 10);

if ( !function_exists('edumy_product_image') ) {
    function edumy_product_image($thumb = 'woocommerce_thumbnail') {
        $swap_image = (bool)edumy_get_config('enable_swap_image', true);
        ?>
        <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" class="product-image">
            <?php edumy_product_get_image($thumb, $swap_image); ?>
        </a>
        <?php
    }
}
// get image
if ( !function_exists('edumy_product_get_image') ) {
    function edumy_product_get_image($thumb = 'woocommerce_thumbnail', $swap = true) {
        global $post, $product, $woocommerce;
        
        $output = '';
        $class = "attachment-$thumb size-$thumb image-no-effect";
        if (has_post_thumbnail()) {
            if ( $swap ) {
                $attachment_ids = $product->get_gallery_image_ids();
                if ($attachment_ids && isset($attachment_ids[0])) {
                    $class = "attachment-$thumb size-$thumb image-hover";
                    $swap_class = "attachment-$thumb size-$thumb image-effect";
                    $output .= edumy_get_attachment_thumbnail( $attachment_ids[0], $thumb , false, array('class' => $swap_class), false);
                }
            }
            $output .= edumy_get_attachment_thumbnail( get_post_thumbnail_id(), $thumb , false, array('class' => $class), false);
        } else {
            $image_sizes = get_option('shop_catalog_image_size');
            $placeholder_width = $image_sizes['width'];
            $placeholder_height = $image_sizes['height'];

            $output .= '<img src="'.wc_placeholder_img_src().'" alt="'.esc_attr__('Placeholder' , 'edumy').'" class="'.$class.'" width="'.$placeholder_width.'" height="'.$placeholder_height.'" />';
        }
        echo trim($output);
    }
}
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );


function edumy_wc_get_gallery_image_html( $attachment_id, $main_image = false ) {
    $flexslider        = (bool) apply_filters( 'woocommerce_single_product_flexslider_enabled', get_theme_support( 'wc-product-gallery-slider' ) );
    $gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail' );
    $thumbnail_size    = apply_filters( 'woocommerce_gallery_thumbnail_size', array( $gallery_thumbnail['width'], $gallery_thumbnail['height'] ) );
    $image_size        = apply_filters( 'woocommerce_gallery_image_size', $flexslider || $main_image ? 'woocommerce_single' : $thumbnail_size );
    $full_size         = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
    $thumbnail_src     = wp_get_attachment_image_src( $attachment_id, $thumbnail_size );
    $full_src          = wp_get_attachment_image_src( $attachment_id, $full_size );
    
    
    $img = edumy_get_attachment_thumbnail($attachment_id, $image_size);
    return '<div data-thumb="' . esc_url( $thumbnail_src[0] ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_src[0] ) . '">' . $img . '</a></div>';
}

// layout class for woo page
if ( !function_exists('edumy_woocommerce_content_class') ) {
    function edumy_woocommerce_content_class( $class ) {
        $page = 'archive';
        if ( is_singular( 'product' ) ) {
            $page = 'single';
        }
        if( edumy_get_config('product_'.$page.'_fullwidth') ) {
            return 'container-fluid';
        }
        return $class;
    }
}
add_filter( 'edumy_woocommerce_content_class', 'edumy_woocommerce_content_class' );

// get layout configs
if ( !function_exists('edumy_get_woocommerce_layout_configs') ) {
    function edumy_get_woocommerce_layout_configs() {
        $page = 'archive';
        if ( is_singular( 'product' ) ) {
            $page = 'single';
        }

        $left = edumy_get_config('product_'.$page.'_left_sidebar');
        $right = edumy_get_config('product_'.$page.'_right_sidebar');
        // check full width
        if( edumy_get_config('product_'.$page.'_fullwidth') ) {
            $sidebar = 'col-lg-3';
            $main_full = 'col-lg-9';
        }else{
            $sidebar = 'col-lg-3';
            $main_full = 'col-lg-9';
        }
        switch ( edumy_get_config('product_'.$page.'_layout') ) {
            case 'left-main':
                if ( is_active_sidebar( $left ) ) {
                    $configs['left'] = array( 'sidebar' => $left, 'class' => $sidebar.' col-sm-12 col-xs-12 '  );
                    $configs['main'] = array( 'class' => $main_full.' col-sm-12 col-xs-12' );
                }
                break;
            case 'main-right':
                if ( is_active_sidebar( $right ) ) {
                    $configs['right'] = array( 'sidebar' => $right,  'class' => $sidebar.' col-sm-12 col-xs-12 ' ); 
                    $configs['main'] = array( 'class' => $main_full.' col-sm-12 col-xs-12' );

                }
                break;
            case 'main':
                $configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
                break;
            default:
                if (is_active_sidebar( 'sidebar-default' ) && !is_shop() && !is_single() ) {
                    $configs['right'] = array( 'sidebar' => 'sidebar-default',  'class' => 'col-md-4 col-sm-12 col-xs-12' ); 
                    $configs['main'] = array( 'class' => 'col-md-8 col-sm-12 col-xs-12' );
                } else {
                    $configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
                }
                break;
        }
        if ( empty($configs) ) {
            if (is_active_sidebar( 'sidebar-default' ) && !is_shop() && !is_single() ) {
                $configs['right'] = array( 'sidebar' => 'sidebar-default',  'class' => 'col-md-4 col-sm-12 col-xs-12' ); 
                $configs['main'] = array( 'class' => 'col-md-8 col-sm-12 col-xs-12' );
            } else {
                $configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
            }
        }
        return $configs; 
    }
}

if ( !function_exists( 'edumy_product_single_tabs' ) ) {
    function edumy_product_single_tabs($tabs) {
        global $post;
        if ( !edumy_get_config('show_product_review_tab', true) && isset($tabs['reviews']) ) {
            unset( $tabs['reviews'] ); 
        }

        if ( !edumy_get_config('hidden_product_additional_information_tab', false) && isset($tabs['additional_information']) ) {
            unset( $tabs['additional_information'] ); 
        }
        
        return $tabs;
    }
}
add_filter( 'woocommerce_product_tabs', 'edumy_product_single_tabs', 90 );



// catalog mode
add_action( 'wp', 'edumy_catalog_mode_init' );
add_action( 'wp', 'edumy_pages_redirect' );

function edumy_catalog_mode_init() {
    if( ! edumy_get_config( 'enable_shop_catalog' ) ) return false;

    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
}

function edumy_pages_redirect() {
    if( ! edumy_get_config( 'enable_shop_catalog' ) ) return false;

    $cart     = is_page( wc_get_page_id( 'cart' ) );
    $checkout = is_page( wc_get_page_id( 'checkout' ) );

    wp_reset_postdata();

    if ( $cart || $checkout ) {
        wp_redirect( home_url() );
        exit;
    }
}



function edumy_display_out_of_stock() {
    global $product;
    if ( ! $product->is_in_stock() ) {
        echo '<p class="stock out-of-stock">'.esc_html__('SOLD OUT', 'edumy').'</p>';
    }
}
add_action( 'edumy_woocommerce_loop_sale_flash', 'edumy_display_out_of_stock', 10 );
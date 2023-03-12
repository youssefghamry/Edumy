<?php

if ( ! function_exists( 'edumy_body_classes' ) ) {
	function edumy_body_classes( $classes ) {
		global $post;
		$show_footer_mobile = edumy_get_config('show_footer_mobile', true);

		if ( is_page() && is_object($post) ) {
			$class = get_post_meta( $post->ID, 'apus_page_extra_class', true );
			if ( !empty($class) ) {
				$classes[] = trim($class);
			}
			if(get_post_meta( $post->ID, 'apus_page_header_transparent',true) && get_post_meta( $post->ID, 'apus_page_header_transparent',true) == 'yes' ){
				$classes[] = 'header_transparent';
			}
		}
		if ( edumy_get_config('preload', true) ) {
			$classes[] = 'apus-body-loading';
		}
		if ( edumy_get_config('image_lazy_loading') ) {
			$classes[] = 'image-lazy-loading';
		}
		if ( $show_footer_mobile ) {
			$classes[] = 'body-footer-mobile';
		}
		if ( edumy_get_config('keep_header') ) {
			$classes[] = 'has-header-sticky';
		}
		// transparent
		if ( is_page() && is_object($post) && !is_front_page() ) {
			$show = get_post_meta( $post->ID, 'apus_page_show_breadcrumb', true );
			if ( $show !== 'no' ) {
				$hclass = edumy_get_body_class_by_header();
				if ( $hclass ) {
					$classes[] = $hclass;
				}
			}
		} elseif ( is_singular('post') || is_category() || is_home() || is_search() ) {
			$show = edumy_get_config('show_blog_breadcrumbs', true);
			if ( !$show || is_front_page() ) {
				$classes[] = 'no-breadcrumb';
			} else {

				$hclass = edumy_get_body_class_by_header();
				if ( $hclass ) {
					$classes[] = $hclass;
				}
			}
			
        } elseif ( is_singular('simple_event') || is_post_type_archive('simple_event') || is_tax('simple_event_category')  || is_tax('simple_event_tags') ) {
			$show = edumy_get_config('events_breadcrumbs', true);
			if ( !$show ) {
				$classes[] = 'no-breadcrumb';
			} else {
				$hclass = edumy_get_body_class_by_header();
				if ( $hclass ) {
					$classes[] = $hclass;
				}
			}
			
		} elseif ( function_exists('edumy_is_courses') && edumy_is_courses() ) {
			$show = edumy_get_config('courses_breadcrumbs', true);
			if ( $show ) {
				$hclass = edumy_get_body_class_by_header();
				if ( $hclass ) {
					$classes[] = $hclass;
				}
			} else {
				$classes[] = 'no-breadcrumb';
			}
		} elseif ( is_404() ) {
			$show = edumy_get_config('show_404_breadcrumbs', true);
			if ( $show ) {
				$hclass = edumy_get_body_class_by_header();
				if ( $hclass ) {
					$classes[] = $hclass;
				}
			} else {
				$classes[] = 'no-breadcrumb';
			}
		} elseif ( edumy_is_woocommerce_activated() && is_woocommerce() ) {
			$show = edumy_get_config('show_product_breadcrumbs', true);
	        if ( $show ) {
				$hclass = edumy_get_body_class_by_header();
				if ( $hclass ) {
					$classes[] = $hclass;
				}
			} else {
				$classes[] = 'no-breadcrumb';
			}
		}
		return $classes;
	}
	add_filter( 'body_class', 'edumy_body_classes' );
}

if ( ! function_exists( 'edumy_get_shortcode_regex' ) ) {
	function edumy_get_shortcode_regex( $tagregexp = '' ) {
		// WARNING! Do not change this regex without changing do_shortcode_tag() and strip_shortcode_tag()
		// Also, see shortcode_unautop() and shortcode.js.
		return
			'\\['                                // Opening bracket
			. '(\\[?)'                           // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
			. "($tagregexp)"                     // 2: Shortcode name
			. '(?![\\w-])'                       // Not followed by word character or hyphen
			. '('                                // 3: Unroll the loop: Inside the opening shortcode tag
			. '[^\\]\\/]*'                   // Not a closing bracket or forward slash
			. '(?:'
			. '\\/(?!\\])'               // A forward slash not followed by a closing bracket
			. '[^\\]\\/]*'               // Not a closing bracket or forward slash
			. ')*?'
			. ')'
			. '(?:'
			. '(\\/)'                        // 4: Self closing tag ...
			. '\\]'                          // ... and closing bracket
			. '|'
			. '\\]'                          // Closing bracket
			. '(?:'
			. '('                        // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
			. '[^\\[]*+'             // Not an opening bracket
			. '(?:'
			. '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
			. '[^\\[]*+'         // Not an opening bracket
			. ')*+'
			. ')'
			. '\\[\\/\\2\\]'             // Closing shortcode tag
			. ')?'
			. ')'
			. '(\\]?)';                          // 6: Optional second closing brocket for escaping shortcodes: [[tag]]
	}
}

if ( ! function_exists( 'edumy_tagregexp' ) ) {
	function edumy_tagregexp() {
		return apply_filters( 'edumy_custom_tagregexp', 'video|audio|playlist|video-playlist|embed|edumy_media' );
	}
}

if ( !function_exists('edumy_get_header_layouts') ) {
	function edumy_get_header_layouts() {
		$headers = array();
		$args = array(
			'posts_per_page'   => -1,
			'offset'           => 0,
			'orderby'          => 'date',
			'order'            => 'DESC',
			'post_type'        => 'apus_header',
			'post_status'      => 'publish',
			'suppress_filters' => true 
		);
		$posts = get_posts( $args );
		foreach ( $posts as $post ) {
			$headers[$post->post_name] = $post->post_title;
		}
		return $headers;
	}
}

if ( !function_exists('edumy_get_header_layout') ) {
	function edumy_get_header_layout() {
		global $post;
		if ( is_page() && is_object($post) && isset($post->ID) ) {
			global $post;
			$header = get_post_meta( $post->ID, 'apus_page_header_type', true );
			if ( empty($header) || $header == 'global' ) {
				return edumy_get_config('header_type');
			}
			return $header;
		}
		return edumy_get_config('header_type');
	}
	add_filter( 'edumy_get_header_layout', 'edumy_get_header_layout' );
}

function edumy_display_header_builder($header_slug) {
	$args = array(
		'name'        => $header_slug,
		'post_type'   => 'apus_header',
		'post_status' => 'publish',
		'numberposts' => 1
	);
	$posts = get_posts($args);
	foreach ( $posts as $post ) {
		$classes = array('apus-header hidden-xs hidden-md hidden-sm');
		$classes[] = $post->post_name.'-'.$post->ID;

		echo '<div id="apus-header" class="'.esc_attr(implode(' ', $classes)).'">';
		if ( edumy_get_config('keep_header') ) {
			echo '<div class="main-sticky-header-wrapper">';
	        echo '<div class="main-sticky-header">';
	    }
			echo apply_filters( 'edumy_generate_post_builder', do_shortcode( $post->post_content ), $post, $post->ID);
		if ( edumy_get_config('keep_header') ) {
			echo '</div>';
	        echo '</div>';
	    }
		echo '</div>';
	}
}

function edumy_get_body_class_by_header() {
	$header_slug = edumy_get_header_layout();
	$args = array(
		'name'        => $header_slug,
		'post_type'   => 'apus_header',
		'post_status' => 'publish',
		'numberposts' => 1
	);
	$posts = get_posts($args);
	foreach ( $posts as $post ) {
		$transparent = get_post_meta($post->ID, 'apus_header_transparent', true);
		if ( $transparent == 'yes' ) {
			return 'header_transparent';
		} else {
			return '';
		}
	}
	return '';
}

if ( !function_exists('edumy_get_footer_layouts') ) {
	function edumy_get_footer_layouts() {
		$footers = array();
		$args = array(
			'posts_per_page'   => -1,
			'offset'           => 0,
			'orderby'          => 'date',
			'order'            => 'DESC',
			'post_type'        => 'apus_footer',
			'post_status'      => 'publish',
			'suppress_filters' => true 
		);
		$posts = get_posts( $args );
		foreach ( $posts as $post ) {
			$footers[$post->post_name] = $post->post_title;
		}
		return $footers;
	}
}

if ( !function_exists('edumy_get_footer_layout') ) {
	function edumy_get_footer_layout() {
		if ( is_page() ) {
			global $post;
			$footer = '';
			if ( is_object($post) && isset($post->ID) ) {
				$footer = get_post_meta( $post->ID, 'apus_page_footer_type', true );
				if ( empty($footer) || $footer == 'global' ) {
					return edumy_get_config('footer_type', '');
				}
			}
			return $footer;
		}
		return edumy_get_config('footer_type', '');
	}
	add_filter('edumy_get_footer_layout', 'edumy_get_footer_layout');
}

function edumy_display_footer_builder($footer_slug) {
	$args = array(
		'name'        => $footer_slug,
		'post_type'   => 'apus_footer',
		'post_status' => 'publish',
		'numberposts' => 1
	);
	$posts = get_posts($args);
	foreach ( $posts as $post ) {
		$classes = array('apus-footer footer-builder-wrapper');
		$classes[] = $post->post_name;

		echo '<div id="apus-footer" class="'.esc_attr(implode(' ', $classes)).'">';
		echo '<div class="apus-footer-inner">';
		echo apply_filters( 'edumy_generate_post_builder', do_shortcode( $post->post_content ), $post, $post->ID);
		echo '</div>';
		echo '</div>';
	}
}

if ( !function_exists('edumy_blog_content_class') ) {
	function edumy_blog_content_class( $class ) {
		$page = 'archive';
		if ( is_singular( 'post' ) ) {
            $page = 'single';
        }
		if ( edumy_get_config('blog_'.$page.'_fullwidth') ) {
			return 'container-fluid';
		}
		return $class;
	}
}
add_filter( 'edumy_blog_content_class', 'edumy_blog_content_class', 1 , 1  );


if ( !function_exists('edumy_get_blog_layout_configs') ) {
	function edumy_get_blog_layout_configs() {
		$page = 'archive';
		if ( is_singular( 'post' ) ) {
            $page = 'single';
        }
		$left = edumy_get_config('blog_'.$page.'_left_sidebar');
		$right = edumy_get_config('blog_'.$page.'_right_sidebar');

		switch ( edumy_get_config('blog_'.$page.'_layout') ) {
		 	case 'left-main':
			 	if ( is_active_sidebar( $left ) ) {
			 		$configs['left'] = array( 'sidebar' => $left, 'class' => 'col-md-3 col-sm-12 col-xs-12'  );
			 		$configs['main'] = array( 'class' => 'col-md-9 col-sm-12 col-xs-12 pull-right' );
			 	}
		 		break;
		 	case 'main-right':
		 		if ( is_active_sidebar( $right ) ) {
			 		$configs['right'] = array( 'sidebar' => $right,  'class' => 'col-md-3 col-sm-12 col-xs-12 pull-right' ); 
			 		$configs['main'] = array( 'class' => 'col-md-9 col-sm-12 col-xs-12' );
			 	}
		 		break;
	 		case 'main':
	 			$configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
	 			break;
		 	default:
		 		if ( is_active_sidebar( 'sidebar-default' ) ) {
			 		$configs['right'] = array( 'sidebar' => 'sidebar-default',  'class' => 'col-md-3 col-xs-12' ); 
			 		$configs['main'] = array( 'class' => 'col-md-9 col-xs-12' );
			 	} else {
			 		$configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
			 	}
		 		break;
		}
		if ( empty($configs) ) {
			if ( is_active_sidebar( 'sidebar-default' ) ) {
		 		$configs['right'] = array( 'sidebar' => 'sidebar-default',  'class' => 'col-md-3 col-xs-12' ); 
		 		$configs['main'] = array( 'class' => 'col-md-9 col-xs-12' );
		 	} else {
		 		$configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
		 	}
		}
		return $configs; 
	}
}

if ( !function_exists('edumy_page_content_class') ) {
	function edumy_page_content_class( $class ) {
		global $post;
		if (is_object($post)) {
			$fullwidth = get_post_meta( $post->ID, 'apus_page_fullwidth', true );
			if ( !$fullwidth || $fullwidth == 'no' ) {
				return $class;
			}
		}
		return 'container-fluid';
	}
}
add_filter( 'edumy_page_content_class', 'edumy_page_content_class', 1 , 1  );

if ( !function_exists('edumy_get_page_layout_configs') ) {
	function edumy_get_page_layout_configs() {
		global $post;
		if ( is_object($post) ) {
			$left = get_post_meta( $post->ID, 'apus_page_left_sidebar', true );
			$right = get_post_meta( $post->ID, 'apus_page_right_sidebar', true );

			switch ( get_post_meta( $post->ID, 'apus_page_layout', true ) ) {
			 	case 'left-main':
			 		if ( is_active_sidebar( $left ) ) {
				 		$configs['left'] = array( 'sidebar' => $left, 'class' => 'col-md-3 col-sm-12 col-xs-12'  );
				 		$configs['main'] = array( 'class' => 'col-md-9 col-sm-12 col-xs-12' );
				 	}
			 		break;
			 	case 'main-right':
			 		if ( is_active_sidebar( $right ) ) {
				 		$configs['right'] = array( 'sidebar' => $right,  'class' => 'col-md-3 col-sm-12 col-xs-12' ); 
				 		$configs['main'] = array( 'class' => 'col-md-9 col-sm-12 col-xs-12' );
				 	}
			 		break;
		 		case 'main':
		 			$configs['main'] = array( 'class' => 'col-xs-12 clearfix' );
		 			break;
			 	default:
			 		if ( is_active_sidebar( 'sidebar-default' ) ) {
				 		$configs['right'] = array( 'sidebar' => 'sidebar-default',  'class' => 'col-md-3 col-sm-12 col-xs-12' ); 
				 		$configs['main'] = array( 'class' => 'col-md-9 col-sm-12 col-xs-12' );
				 	} else {
				 		$configs['main'] = array( 'class' => 'col-xs-12 clearfix' );
				 	}
			 		break;
			}

			if ( empty($configs) ) {
				if ( is_active_sidebar( 'sidebar-default' ) ) {
			 		$configs['right'] = array( 'sidebar' => 'sidebar-default',  'class' => 'col-md-3 col-sm-12 col-xs-12' ); 
			 		$configs['main'] = array( 'class' => 'col-md-9 col-sm-12 col-xs-12' );
			 	} else {
			 		$configs['main'] = array( 'class' => 'col-xs-12 clearfix' );
			 	}
			}
		} else {
			$configs['main'] = array( 'class' => 'col-xs-12' );
		}
		return $configs; 
	}
}


if ( ! function_exists( 'edumy_get_first_url_from_string' ) ) {
	function edumy_get_first_url_from_string( $string ) {
		$pattern = "/^\b(?:(?:https?|ftp):\/\/)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
		preg_match( $pattern, $string, $link );

		$link_return = ( ! empty( $link[0] ) ) ? $link[0] : false;
		$content = str_replace($link_return, "", $string);
        $content = apply_filters( 'the_content', $content);
        return array( 'link' => $link_return, 'content' => $content );
	}
}

if ( !function_exists( 'edumy_get_link_attributes' ) ) {
	function edumy_get_link_attributes( $string ) {
		preg_match( '/<a href="(.*?)">/i', $string, $atts );

		return ( ! empty( $atts[1] ) ) ? $atts[1] : '';
	}
}

if ( !function_exists( 'edumy_post_media' ) ) {
	function edumy_post_media( $content ) {
		$is_video = ( get_post_format() == 'video' ) ? true : false;
		$media = edumy_get_first_url_from_string( $content );
		$media = $media['link'];
		if ( ! empty( $media ) ) {
			global $wp_embed;
			$content = do_shortcode( $wp_embed->run_shortcode( '[embed]' . $media . '[/embed]' ) );
		} else {
			$pattern = edumy_get_shortcode_regex( edumy_tagregexp() );
			preg_match( '/' . $pattern . '/s', $content, $media );
			if ( ! empty( $media[2] ) ) {
				if ( $media[2] == 'embed' ) {
					global $wp_embed;
					$content = do_shortcode( $wp_embed->run_shortcode( $media[0] ) );
				} else {
					$content = do_shortcode( $media[0] );
				}
			}
		}
		if ( ! empty( $media ) ) {
			$output = '<div class="entry-media">';
			$output .= ( $is_video ) ? '<div class="pro-fluid"><div class="pro-fluid-inner">' : '';
			$output .= $content;
			$output .= ( $is_video ) ? '</div></div>' : '';
			$output .= '</div>';

			return $output;
		}

		return false;
	}
}

if ( !function_exists( 'edumy_post_gallery' ) ) {
	function edumy_post_gallery( $content, $args = array() ) {
		$output = '';
		$defaults = array( 'size' => 'large' );
		$args = wp_parse_args( $args, $defaults );
	    $gallery_filter = edumy_gallery_from_content( $content );
	    if (count($gallery_filter['ids']) > 0) {
        	$output .= '<div class="slick-carousel" data-carousel="slick" data-items="1" data-smallmedium="1" data-extrasmall="1" data-pagination="false" data-nav="true">';
                foreach($gallery_filter['ids'] as $attach_id) {
                    $output .= '<div class="gallery-item">';
                    $output .= wp_get_attachment_image($attach_id, $args['size'] );
                    $output .= '</div>';
                }
            $output .= '</div>';
        }
        return $output;
	}
}

if (!function_exists('edumy_gallery_from_content')) {
    function edumy_gallery_from_content($content) {

        $result = array(
            'ids' => array(),
            'filtered_content' => ''
        );

        preg_match('/\[gallery.*ids=.(.*).\]/', $content, $ids);
        if(!empty($ids)) {
            $result['ids'] = explode(",", $ids[1]);
            $content =  str_replace($ids[0], "", $content);
            $result['filtered_content'] = apply_filters( 'the_content', $content);
        }

        return $result;

    }
}

if ( !function_exists( 'edumy_random_key' ) ) {
    function edumy_random_key($length = 5) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $return = '';
        for ($i = 0; $i < $length; $i++) {
            $return .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $return;
    }
}

if ( !function_exists('edumy_substring') ) {
    function edumy_substring($string, $limit, $afterlimit = '[...]') {
        if ( empty($string) ) {
        	return $string;
        }
       	$string = explode(' ', strip_tags( $string ), $limit);

        if (count($string) >= $limit) {
            array_pop($string);
            $string = implode(" ", $string) .' '. $afterlimit;
        } else {
            $string = implode(" ", $string);
        }
        $string = preg_replace('`[[^]]*]`','',$string);
        return strip_shortcodes( $string );
    }
}

function edumy_is_apus_framework_activated() {
	return defined('APUS_FRAMEWORK_VERSION') ? true : false;
}

function edumy_is_cmb2_activated() {
	return defined('CMB2_LOADED') ? true : false;
}

function edumy_is_woocommerce_activated() {
	return class_exists( 'woocommerce' ) ? true : false;
}

function edumy_is_revslider_activated() {
	return class_exists( 'RevSlider' ) ? true : false;
}

function edumy_is_woo_swatches_activated() {
	return class_exists( 'TA_WC_Variation_Swatches' ) ? true : false;
}

function edumy_is_mailchimp_activated() {
	return class_exists( 'MC4WP_Form_Manager' ) ? true : false;
}

function edumy_is_learnpress_activated() {
	return class_exists( 'LearnPress' ) ? true : false; 
}

function edumy_is_simple_event_activated() {
	return class_exists( 'ApusSimpleEvent' ) ? true : false; 
}

function edumy_is_new_learnpress( $version ) {
	if ( defined( 'LEARNPRESS_VERSION' ) ) {
		return version_compare( LEARNPRESS_VERSION, $version, '>=' );
	} else {
		return version_compare( get_option( 'learnpress_version' ), $version, '>=' );
	}
}
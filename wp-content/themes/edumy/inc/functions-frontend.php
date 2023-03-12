<?php

if ( ! function_exists( 'edumy_category' ) ) {
	function edumy_category( $post ) {
		// format
		$post_format = get_post_format();
		$header_class = $post_format ? '' : 'border-left';
		echo '<span class="category "> ';
		$cat = wp_get_post_categories( $post->ID );
		$k   = count( $cat );
		foreach ( $cat as $c ) {
			$categories = get_category( $c );
			$k -= 1;
			if ( $k == 0 ) {
				echo '<a href="' . get_category_link( $categories->term_id ) . '" class="categories-name">' . $categories->name . '</a>';
			} else {
				echo '<a href="' . get_category_link( $categories->term_id ) . '" class="categories-name">' . $categories->name . '</a>';
			}
		}
		echo '</span>';
	}
}

if ( ! function_exists( 'edumy_center_meta' ) ) {
	function edumy_center_meta( $post ) {
		// format
		$post_format = get_post_format();
		$id = get_the_author_meta( 'ID' );
		echo '<div class="entry-meta">';
		if(!is_single()){
			the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
		} else {
			the_title( '<h4 class="entry-title">', '</h4>' );
		}
			echo "<div class='entry-create'>";
			echo "<span class='entry-date'>". get_the_date( 'M jS, Y' ).'</span>';
			echo "<span class='author'>".esc_html__( ' / By: ', 'edumy' ).'<a href='.esc_url(get_author_posts_url( $id )).'>'.get_the_author().'</a>' .'</span>';
			echo '</div>';
		echo '</div>';
	}
}



if ( ! function_exists( 'edumy_full_top_meta' ) ) {
	function edumy_full_top_meta( $post ) {
		// format
		$post_format = get_post_format();
		$header_class = $post_format ? '' : 'border-left';
		echo '<header class="entry-create ' . $header_class . '">';
		if(!is_single()){
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}
		// details
		$id = get_the_author_meta( 'ID' );
		echo '<span class="entry-date">' . esc_html( get_the_date( 'M jS, Y' ) ) . '</span><span class="entry-profile">
			
			
			<span class="entry-author-link">
				' . esc_html__( 'by:', 'edumy' ) . '
				<span class="author vcard">
				<a class="url fn n" href="' . esc_url(get_author_posts_url( $id )) . '" rel="author">' . get_the_author() . '</a>
				</span>
			</span>
			
		</span>';
		// comments
		echo '<span class="entry-categories">in: ';
		$cat = wp_get_post_categories( $post->ID );
		$k   = count( $cat );
		foreach ( $cat as $c ) {
			$categories = get_category( $c );
			$k -= 1;
			if ( $k == 0 ) {
				echo '<a href="' . get_category_link( $categories->term_id ) . '" class="categories-name">' . $categories->name . '</a>';
			} else {
				echo '<a href="' . get_category_link( $categories->term_id ) . '" class="categories-name">' . $categories->name . ', </a>';
			}
		}
		echo '</span>';

		if ( ! is_search() ) {
			if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
				echo '<span class="entry-comments-link">';
				comments_popup_link( esc_html__( '0 comments', 'edumy' ), esc_html__( '1 comment' , 'edumy' ), esc_html__( '% comments', 'edumy' ) );
				echo '</span>';
			}
		}
		echo '</header>';
	}
}

if ( ! function_exists( 'edumy_post_tags' ) ) {
	function edumy_post_tags() {
		$posttags = get_the_tags();
		if ( $posttags ) {
			echo '<span class="entry-tags-list"><strong>'.esc_html__( 'Tags: ' , 'edumy' ).'</strong> ';
			$i = 1;
			$size = count( $posttags );
			foreach ( $posttags as $tag ) {
				echo '<a href="' . get_tag_link( $tag->term_id ) . '">';
				echo esc_attr($tag->name);
				echo '</a>';
				$i ++;
			}
			echo '</span>';
		}
	}
}

if ( ! function_exists( 'edumy_post_format_link_helper' ) ) {
	function edumy_post_format_link_helper( $content = null, $title = null, $post = null ) {
		if ( ! $content ) {
			$post = get_post( $post );
			$title = $post->post_title;
			$content = $post->post_content;
		}
		$link = edumy_get_first_url_from_string( $content );
		if ( ! empty( $link ) ) {
			$title = '<a href="' . esc_url( $link ) . '" rel="bookmark">' . $title . '</a>';
			$content = str_replace( $link, '', $content );
		} else {
			$pattern = '/^\<a[^>](.*?)>(.*?)<\/a>/i';
			preg_match( $pattern, $content, $link );
			if ( ! empty( $link[0] ) && ! empty( $link[2] ) ) {
				$title = $link[0];
				$content = str_replace( $link[0], '', $content );
			} elseif ( ! empty( $link[0] ) && ! empty( $link[1] ) ) {
				$atts = shortcode_parse_atts( $link[1] );
				$target = ( ! empty( $atts['target'] ) ) ? $atts['target'] : '_self';
				$title = ( ! empty( $atts['title'] ) ) ? $atts['title'] : $title;
				$title = '<a href="' . esc_url( $atts['href'] ) . '" rel="bookmark" target="' . $target . '">' . $title . '</a>';
				$content = str_replace( $link[0], '', $content );
			} else {
				$title = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $title . '</a>';
			}
		}
		$out['title'] = '<h2 class="entry-title">' . $title . '</h2>';
		$out['content'] = $content;

		return $out;
	}
}

if ( !function_exists('edumy_get_page_title') ) {
	function edumy_get_page_title() {
		$title = '';
		if ( !is_front_page() || is_paged() ) {
			global $post;
			$homeLink = esc_url( home_url() );

			if ( is_home() ) {
				$title = esc_html__( 'The Blogs', 'edumy' );
			} elseif (is_category()) {
				$title = esc_html__( 'The Blogs', 'edumy' );
			} elseif (is_day()) {
				$title = get_the_time(get_option( 'date_format'));
			} elseif (is_month()) {
				$title = get_the_time('F Y');
			} elseif (is_year()) {
				$title = get_the_time('Y');
			} elseif (is_single() && !is_attachment()) {
				if ( get_post_type() != 'post' ) {
					$title = get_the_title();
				} else {
					$title = esc_html__( 'Blog', 'edumy' );
				}
			} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() && !is_author() && !is_search() ) {
				$post_type = get_post_type_object(get_post_type());
				if (is_object($post_type)) {
					$title = $post_type->labels->singular_name;
				}
			} elseif (is_attachment()) {
				$title = get_the_title();
			} elseif ( is_page() && !$post->post_parent ) {
				$title = get_the_title();
			} elseif ( is_page() && $post->post_parent ) {
				$title = get_the_title();
			} elseif ( is_search() ) {
				$title = esc_html__('Search results for "', 'edumy')  . get_search_query(). '"';
			} elseif ( is_tag() ) {
				$title = esc_html__('Posts tagged "', 'edumy'). single_tag_title('', false) . '"';
			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata($author);
				$title = $userdata->display_name;
			} elseif ( is_404() ) {
				$title = esc_html__('Error 404', 'edumy');
			}
		}else{
			$title = get_the_title();
		}
		return $title;
	}
}

if ( ! function_exists( 'edumy_breadcrumbs' ) ) {
	function edumy_breadcrumbs() {

		$delimiter = ' ';
		$home = '<i class="flaticon-appointment hide" aria-hidden="true"></i>'.esc_html__('Home', 'edumy');
		$before = '<li><span class="active">';
		$after = '</span></li>';
		if ( !is_front_page() || is_paged()) {
			global $post;
			$homeLink = esc_url( home_url() );
			
			echo '<div class="breadscrumb-inner">';
			echo '<ol class="breadcrumb">';


			echo '<li><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . '</li> ';
			if (is_category()) {
				global $wp_query;
				$cat_obj = $wp_query->get_queried_object();
				$thisCat = $cat_obj->term_id;
				$thisCat = get_category($thisCat);
				$parentCat = get_category($thisCat->parent);
				echo '<li>';
				if ($thisCat->parent != 0)
					echo get_category_parents($parentCat, TRUE, '</li><li>');
				echo '<span class="active">'.single_cat_title('', false) . $after;
			} elseif (is_day()) {
				echo '<li><a href="' . esc_url( get_year_link(get_the_time('Y')) ) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
				echo '<li><a href="' . esc_url( get_month_link(get_the_time('Y'),get_the_time('m')) ) . '">' . get_the_time('F') . '</a></li> ' . $delimiter . ' ';
				echo trim($before) . get_the_time('d') . $after;
			} elseif (is_month()) {
				echo '<a href="' . esc_url( get_year_link(get_the_time('Y')) ) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
				echo trim($before) . get_the_time('F') . $after;
			} elseif (is_year()) {
				echo trim($before) . get_the_time('Y') . $after;
			} elseif (is_single() && !is_attachment()) {
				if ( get_post_type() != 'post' ) {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					
					echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li> ' . $delimiter . ' ';
					echo trim($before) . get_the_title() . $after;
				} else {
					$cat = get_the_category();
					$cat = $cat[0];
					echo '<li>'.get_category_parents($cat, TRUE, '</li><li>');
					echo '<span class="active">'.get_the_title() . $after;
				}
			} elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404() && !is_author() && !is_search()) {

				$post_type = get_post_type_object(get_post_type());
				
				if (is_object($post_type)) {
					echo trim($before) . $post_type->labels->singular_name . $after;
				}
			} elseif (is_attachment()) {
				$parent = get_post($post->post_parent);
				$cat = get_the_category($parent->ID);
				echo '<li>';
				if ( !empty($cat) ) {
					$cat = $cat[0];
					echo get_category_parents($cat, TRUE, '</li><li>');
				}
				if ( !empty($parent) ) {
					echo '<a href="' . esc_url( get_permalink($parent) ) . '">' . $parent->post_title . '</a></li><li>';
				}
				echo '<span class="active">'.get_the_title() . $after;
			} elseif ( is_page() && !$post->post_parent ) {
				echo trim($before) . get_the_title() . $after;
			} elseif ( is_page() && $post->post_parent ) {
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = '<li><a href="' . esc_url( get_permalink($page->ID) ) . '">' . get_the_title($page->ID) . '</a></li>';
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				foreach ($breadcrumbs as $crumb) {
					echo trim($crumb) . ' ' . $delimiter . ' ';
				}
				echo trim($before) . get_the_title() . $after;
			} elseif ( is_search() ) {
				echo trim($before) . sprintf(esc_html__('Search results for "%s"','edumy'), get_search_query()) . $after;
			} elseif ( is_tag() ) {
				echo trim($before) . sprintf(esc_html__('Posts tagged "%s"', 'edumy'), single_tag_title('', false)) . $after;
			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata($author);
				echo trim($before) . esc_html__('Articles posted by ', 'edumy') . $userdata->display_name . $after;
			} elseif ( is_404() ) {
				echo trim($before) . esc_html__('Error 404', 'edumy') . $after;
			} elseif ( is_home() ) {
				echo trim($before) . esc_html__('The Blogs', 'edumy') . $after;
			}

			echo '</ol>';
			echo '</div>';
			
		}
	}
}

if ( ! function_exists( 'edumy_render_breadcrumbs' ) ) {
	function edumy_render_breadcrumbs() {
		global $post;
		$has_bg = '';
		$show = true;
		$style = array();
		$full_width = 'container';
		if ( is_page() && is_object($post) ) {
			$show = get_post_meta( $post->ID, 'apus_page_show_breadcrumb', true );
			if ( $show == 'no' ) {
				return ''; 
			}
			$bgimage = get_post_meta( $post->ID, 'apus_page_breadcrumb_image', true );
			$bgcolor = get_post_meta( $post->ID, 'apus_page_breadcrumb_color', true );
			$style = array();
			if ( $bgcolor ) {
				$style[] = 'background-color:'.$bgcolor;
			}
			if ( $bgimage ) { 
				$style[] = 'background-image:url(\''.esc_url($bgimage).'\')';
				$has_bg = 'has_bg';
			}
			$full_width = apply_filters('edumy_page_content_class', 'container');
		} elseif ( is_singular('post') || is_category() || is_home() || is_search() ) {
			$show = edumy_get_config('show_blog_breadcrumbs', true);
			if ( !$show || is_front_page() ) {
				return ''; 
			}
			$breadcrumb_img = edumy_get_config('blog_breadcrumb_image');
	        $breadcrumb_color = edumy_get_config('blog_breadcrumb_color');
	        $style = array();
	        if ( $breadcrumb_color ) {
	            $style[] = 'background-color:'.$breadcrumb_color;
	        }
	        if ( isset($breadcrumb_img['url']) && !empty($breadcrumb_img['url']) ) {
	            $style[] = 'background-image:url(\''.esc_url($breadcrumb_img['url']).'\')';
	            $has_bg = 'has_bg';
	        }
	        $full_width = apply_filters('edumy_blog_content_class', 'container');
        } elseif ( is_singular('simple_event') || is_post_type_archive('simple_event') || is_tax('simple_event_category')  || is_tax('simple_event_tags') ) {

			$show = edumy_get_config('events_breadcrumbs', true);
			if ( !$show || is_front_page() ) {
				return ''; 
			}
			$breadcrumb_img = edumy_get_config('events_breadcrumb_image');
	        $breadcrumb_color = edumy_get_config('events_breadcrumb_color');
	        $style = array();
	        if ( $breadcrumb_color ) {
	            $style[] = 'background-color:'.$breadcrumb_color;
	        }
	        if ( isset($breadcrumb_img['url']) && !empty($breadcrumb_img['url']) ) {
	            $style[] = 'background-image:url(\''.esc_url($breadcrumb_img['url']).'\')';
	            $has_bg = 'has_bg';
	        }
	        $full_width = apply_filters('edumy_blog_content_class', 'container');
		} elseif ( function_exists('edumy_is_courses') && edumy_is_courses() ) {
			$show = edumy_get_config('courses_breadcrumbs', true);
			if ( !$show ) {
				return ''; 
			}
			$breadcrumb_img = edumy_get_config('courses_breadcrumb_image');
	        $breadcrumb_color = edumy_get_config('courses_breadcrumb_color');
	        $style = array();
	        if ( $breadcrumb_color ) {
	            $style[] = 'background-color:'.$breadcrumb_color;
	        }
	        if ( isset($breadcrumb_img['url']) && !empty($breadcrumb_img['url']) ) {
	            $style[] = 'background-image:url(\''.esc_url($breadcrumb_img['url']).'\')';
	            $has_bg = 'has_bg';
	        }
	        $full_width = apply_filters('edumy_course_content_class', 'container');
		} elseif ( is_404() ) {
			$show = edumy_get_config('show_404_breadcrumbs', true);
			if ( !$show || is_front_page() ) {
				return ''; 
			}
			$breadcrumb_img = edumy_get_config('404_breadcrumb_image');
	        $breadcrumb_color = edumy_get_config('404_breadcrumb_color');
	        $style = array();
	        if ( $breadcrumb_color ) {
	            $style[] = 'background-color:'.$breadcrumb_color;
	        }
	        if ( isset($breadcrumb_img['url']) && !empty($breadcrumb_img['url']) ) {
	            $style[] = 'background-image:url(\''.esc_url($breadcrumb_img['url']).'\')';
	            $has_bg = 'has_bg';
	        }
	        $full_width = 'container-fluid';
		}
		$estyle = !empty($style)? ' style="'.implode(";", $style).'"':"";

		$title = edumy_get_page_title();
		echo '<section id="apus-breadscrumb" class="breadcrumb-page apus-breadscrumb '.$has_bg.'"'.$estyle.'><div class="'.$full_width.'"><div class="wrapper-breads"><div class="wrapper-breads-inner">';
				if ( function_exists('edumy_is_courses') && edumy_is_courses() && function_exists('learn_press_breadcrumb') ) {
					if ( learn_press_is_course() && is_single() ) {
				        if ( edumy_get_config('course_layout_type') == 'v1' ) {
							if ( $title ) {
								echo '<h2 class="bread-title">'.$title.'</h2>';
							}
							learn_press_breadcrumb();
						}
				    } else {
				    	$courses_page_id = learn_press_get_page_id( 'courses' );
				    	$title = get_the_title($courses_page_id);
				    	if ( $title ) {
							echo '<h2 class="bread-title">'.$title.'</h2>';
						}
						learn_press_breadcrumb();
				    }
				} else {
					if ( $title ) {
						echo '<h2 class="bread-title">'.$title.'</h2>';
					}
					edumy_breadcrumbs();
				}
		echo '</div></div></div></section>';
	}
}

if ( ! function_exists( 'edumy_paging_nav' ) ) {
	function edumy_paging_nav() {
		global $wp_query, $wp_rewrite;

		if ( $wp_query->max_num_pages < 2 ) {
			return;
		}

		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$links = paginate_links( array(
			'base'     => $pagenum_link,
			'format'   => $format,
			'total'    => $wp_query->max_num_pages,
			'current'  => $paged,
			'mid_size' => 1,
			'add_args' => array_map( 'urlencode', $query_args ),
			'prev_text' => esc_html__( 'Prev', 'edumy' ),
			'next_text' => esc_html__( 'Next', 'edumy' ),
		) );

		if ( $links ) :

		?>
		<nav class="navigation paging-navigation" role="navigation">
			<h1 class="screen-reader-text hidden"><?php esc_html_e( 'Posts navigation', 'edumy' ); ?></h1>
			<div class="apus-pagination">
				<?php echo trim($links); ?>
			</div><!-- .pagination -->
		</nav><!-- .navigation -->
		<?php
		endif;
	}
}

if ( ! function_exists( 'edumy_post_nav' ) ) {
	function edumy_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}

		?>
		<nav class="navigation post-navigation" role="navigation">
			<h3 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'edumy' ); ?></h3>
			<div class="nav-links clearfix">
				<?php
				if ( is_attachment() ) :
					previous_post_link( '%link','<div class="col-lg-6"><span class="meta-nav">'. esc_html__('Published In', 'edumy').'</span></div>');
				else :
					previous_post_link( '%link','<div class="pull-left"><span class="meta-nav">'. esc_html__('Previous Post', 'edumy').'</span></div>' );
					next_post_link( '%link', '<div class="pull-right"><span class="meta-nav">' . esc_html__('Next Post', 'edumy').'</span><span></span></div>');
				endif;
				?>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
}

if ( !function_exists('edumy_pagination') ) {
    function edumy_pagination( $args = array() ) {
    	global $wp_query, $wp_rewrite;
        
        $args = wp_parse_args( $args, array(
			'prev_text' => '<i class="flaticon-left-arrow"></i>'.esc_html__('Prev', 'edumy'),
			'next_text' => esc_html__('Next','edumy').'<i class="flaticon-right-arrow"></i>',
			'max_num_pages' => 10,
			'echo' => true,
			'class' => '',
		));

    	$pages = $args['max_num_pages'];

    	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
        if ( empty($pages) ) {
            global $wp_query;
            $pages = $wp_query->max_num_pages;
            if ( !$pages ) {
                $pages = 1;
            }
        }
        $pagination = array(
            'base' => @add_query_arg('paged','%#%'),
            'format' => '',
            'total' => $pages,
            'current' => $current,
            'prev_text' => $args['prev_text'],
            'next_text' => $args['next_text'],
            'type' => 'array'
        );

        if( $wp_rewrite->using_permalinks() ) {
            $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
        }
        $sq = '';
        if ( isset($_GET['s']) ) {
            $cq = $_GET['s'];
            $sq = str_replace(" ", "+", $cq);
        }
        
        if ( !empty($wp_query->query_vars['s']) ) {
            $pagination['add_args'] = array( 's' => $sq);
        }
        $pagination = apply_filters( 'edumy-custom-pagination', $pagination );
        $paginations = paginate_links( $pagination );
        $output = '';
        if ( !empty($paginations) ) {
            $output .= '<ul class="pagination '.esc_attr( $args["class"] ).'">';
                foreach ($paginations as $key => $pg) {
                    $output .= '<li>'. $pg .'</li>';
                }
            $output .= '</ul>';
        }
    	
        if ( $args["echo"] ) {
        	echo wp_kses_post($output);
        } else {
        	return $output;
        }

    }
}

if ( !function_exists('edumy_comment_form') ) {
	function edumy_comment_form($arg, $class = 'btn-theme ') {
		global $post;
		if ('open' == $post->comment_status) {
			ob_start();
	      	comment_form($arg);
	      	$form = ob_get_clean();
	      	?>
	      	<div class="commentform reset-button-default">
		    	<div class="clearfix">
			    	<?php
			      	echo str_replace('id="submit"','id="submit" class="btn '.$class.'"', $form);
			      	?>
		      	</div>
	      	</div>
	      	<?php
	      }
	}
}

if (!function_exists('edumy_list_comment') ) {
	function edumy_list_comment($comment, $args, $depth) {
		if ( is_file(get_template_directory().'/list-comments.php') ) {
	        require get_template_directory().'/list-comments.php';
      	}
	}
}

function edumy_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}
add_filter( 'comment_form_fields', 'edumy_comment_field_to_bottom' );


/*
 * create placeholder
 * var size: array( width, height )
 */
function edumy_create_placeholder($size) {
	return "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 ".$size[0]." ".$size[1]."'%2F%3E";
}


function edumy_display_sidebar_left( $sidebar_configs ) {
	if ( isset($sidebar_configs['left']) ) : ?>
		<div class="<?php echo esc_attr($sidebar_configs['left']['class']) ;?>">
		  	<aside class="sidebar sidebar-left" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
		  		<div class="close-sidebar-btn hidden-lg hidden-md">
		  			<span><?php esc_html_e('Close', 'edumy'); ?></span>
		  		</div>
		   		<?php if ( is_active_sidebar( $sidebar_configs['left']['sidebar'] ) ): ?>
		   			<?php dynamic_sidebar( $sidebar_configs['left']['sidebar'] ); ?>
		   		<?php endif; ?>
		  	</aside>
		</div>
	<?php endif;
}

function edumy_display_sidebar_right( $sidebar_configs ) {
	if ( isset($sidebar_configs['right']) ) : ?>
		<div class="<?php echo esc_attr($sidebar_configs['right']['class']) ;?>">
		  	<aside class="sidebar sidebar-right" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
		  		<div class="close-sidebar-btn hidden-lg hidden-md">		  			
		  			<span><?php esc_html_e('Close', 'edumy'); ?></span>
		  		</div>
		   		<?php if ( is_active_sidebar( $sidebar_configs['right']['sidebar'] ) ): ?>
			   		<?php dynamic_sidebar( $sidebar_configs['right']['sidebar'] ); ?>
			   	<?php endif; ?>
		  	</aside>
		</div>
	<?php endif;
}

function edumy_before_content( $sidebar_configs ) {
	if ( isset($sidebar_configs['left']) || isset($sidebar_configs['right']) ) : ?>
		<a href="javascript:void(0)" class="mobile-sidebar-btn hidden-lg hidden-md"> 
			<i class="icon-sidebar"></i> 
			<span><?php echo esc_html__('Show Sidebar', 'edumy'); ?></span>
		</a>
		<div class="mobile-sidebar-panel-overlay"></div>
	<?php endif;
}
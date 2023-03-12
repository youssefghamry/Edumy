<?php
/**
 * wishlist
 *
 * @package    edumy
 * @author     ApusTheme <apusthemes@gmail.com >
 * @license    GNU General Public License, version 3
 * @copyright  13/06/2016 ApusTheme
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
 
class Edumy_Wishlist {
	
	public static function init() {
		add_action( 'wp_ajax_edumy_add_wishlist', array(__CLASS__, 'add_wishlist') );
		add_action( 'wp_ajax_nopriv_edumy_add_wishlist', array(__CLASS__, 'add_wishlist') );
		add_action( 'wp_ajax_edumy_remove_wishlist', array(__CLASS__, 'remove_wishlist') );
		add_action( 'wp_ajax_nopriv_edumy_remove_wishlist', array(__CLASS__, 'remove_wishlist') );
	}

	public static function add_wishlist() {
		check_ajax_referer( 'edumy-ajax-nonce', 'security' );
		$result = array();
		if ( isset($_POST['post_id']) && $_POST['post_id'] ) {
			self::save_wishlist($_POST['post_id']);
			$result['status'] = 'success';
			$result['text'] = esc_html__( 'Added to wishlist', 'edumy' );
		} else {
			$result['status'] = 'error';
		}
		echo json_encode($result);
		die();
	}

	public static function remove_wishlist() {
		check_ajax_referer( 'edumy-ajax-nonce', 'security' );
		$result = array();
		if ( isset($_POST['post_id']) && $_POST['post_id'] ) {
			$user_id = get_current_user_id();
			$data = get_user_meta($user_id, '_wishlist', true);
			if (is_array($data)) {
				foreach ($data as $key => $value) {
					if ( $_POST['post_id'] == $value ) {
						unset($data[$key]);
					}
				}
			}
			update_user_meta( $user_id, '_wishlist', $data );
			// count wishlist
			$counts = intval( get_post_meta($_POST['post_id'], '_wishlist_count', true) );
		    if( $counts != '' ) {
		        $counts--;
		    } else {
		        $counts = 0;
		    }
		    update_post_meta( $_POST['post_id'], '_wishlist_count', $counts );
			$result['status'] = 'success';
			$result['text'] = esc_html__( 'Add to wishlist', 'edumy' );
		} else {
			$result['status'] = 'error';
		}
		echo json_encode($result);
		die();
	}

	public static function get_wishlist() {
		$user_id = get_current_user_id();
		$data = get_user_meta($user_id, '_wishlist', true);
		return $data;
	}

	public static function save_wishlist($post_id) {
		$user_id = get_current_user_id();
		$data = get_user_meta($user_id, '_wishlist', true);
		if ( is_array($data) ) {
			if ( !in_array($post_id, $data) ) {
				$data[] = $post_id;
				update_user_meta( $user_id, '_wishlist', $data );
				// count wishlist
				$counts = intval( get_post_meta($post_id, '_wishlist_count', true) );
			    if( $counts != '' ) {
			        $counts++;
			    } else {
			        $counts = 1;
			    }
			    update_post_meta( $post_id, '_wishlist_count', $counts );
			}
		} else {
			$data = array($post_id);
			update_user_meta( $user_id, '_wishlist', $data );
			// count wishlist
			$counts = 1;
		    update_post_meta( $post_id, '_wishlist_count', $counts );
		}
	}

	public static function check_listing_added($post_id) {
		$data = self::get_wishlist();
		if ( !is_array($data) || !in_array($post_id, $data) ) {
			return false;
		}
		return true;
	}

	public static function get_listings( $ids, $post_per_page = -1, $paged = 1 ) {
		if ( empty($ids) || !is_array($ids) ) {
			return false;
		}
		$args = array(
			'post_type' => LP_COURSE_CPT,
			'posts_per_page' => $post_per_page,
			'ignore_sticky_posts' => true,
			'paged' => $paged,
			'post__in' => $ids
		);

		$wp_query = new WP_Query( $args );
		return $wp_query;
	}

	public static function display_wishlist_btn( $post ) {
		$post_id = $post->ID;
		$class = '';
		$icon_class = 'flaticon-like';
		$text = esc_html__( 'Add to wishlist', 'edumy' );
		if ( !is_user_logged_in() ) {
			$class = 'btn btn-ct-link apus-wishlist-not-login';
		} else {
			$added = Edumy_Wishlist::check_listing_added($post_id);
			if ($added) {
				$class = 'apus-wishlist-added';
				$icon_class = 'flaticon-like';
				$text = esc_html__( 'Added to wishlist', 'edumy' );
			} else {
				$class = 'apus-wishlist-add';
			}
		}
		?>
		<div class="listing-btn-wrapper listing-wishlist">
			<a href="#apus-wishlist-add" class="<?php echo esc_attr($class); ?>" data-id="<?php echo esc_attr($post_id); ?>">
				<i class="<?php echo esc_attr($icon_class); ?>"></i><span class="wishlist-text"><?php echo esc_html($text); ?></span>
			</a>
		</div>
		<?php
	}
}

Edumy_Wishlist::init();
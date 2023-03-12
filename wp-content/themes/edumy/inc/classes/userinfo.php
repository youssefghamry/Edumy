<?php 

class Edumy_Apus_Userinfo{

	/**
	 * Constructor 
	 */
	public function __construct() {
		
		add_action( 'init', array($this, 'setup'), 1000 );
		add_action( 'wp_ajax_nopriv_apus_ajax_login',  array($this, 'processLogin') );
		add_action( 'wp_ajax_nopriv_apus_ajax_forgotpass',  array($this, 'processForgotPassword') );
		add_action( 'wp_ajax_nopriv_apus_ajax_register',  array($this, 'processRegister') );

		add_action( 'wp_ajax_edumy_process_change_profile_form', array($this, 'process_change_profile_form') );
		add_action( 'wp_ajax_nopriv_edumy_process_change_profile_form',  array($this, 'process_change_profile_form') );

		add_action( 'wp_ajax_edumy_process_change_password', array($this, 'process_change_password') );
		add_action( 'wp_ajax_nopriv_edumy_process_change_password',  array($this, 'process_change_password') );
	}
	
	public function processLogin() {
		// First check the nonce, if it fails the function will break
   		check_ajax_referer( 'ajax-apus-login-nonce', 'security_login' );

   		$info = array();
   		
   		$info['user_login'] = isset($_POST['username']) ? $_POST['username'] : '';
	    $info['user_password'] = isset($_POST['password']) ? $_POST['password'] : '';
	    $info['remember'] = isset($_POST['remember']) ? true : false;

		$user_signon = wp_signon( $info, false );
	    if ( is_wp_error($user_signon) ){
			$result = json_encode(array('loggedin' => false, 'msg' => esc_html__('Wrong username or password. Please try again!!!', 'edumy')));
	    } else {
			wp_set_current_user($user_signon->ID); 
	        $result = json_encode(array('loggedin' => true, 'msg' => esc_html__('Signin successful, redirecting...', 'edumy')));
	    }

   		echo trim($result);
   		die();
	}

	public function processForgotPassword() {
	 	
		// First check the nonce, if it fails the function will break
	    check_ajax_referer( 'ajax-apus-lostpassword-nonce', 'security_lostpassword' );
		
		global $wpdb;
		
		$account = isset($_POST['user_login']) ? $_POST['user_login'] : '';
		
		if( empty( $account ) ) {
			$error = esc_html__( 'Enter an username or e-mail address.', 'edumy' );
		} else {
			if(is_email( $account )) {
				if( email_exists($account) ) {
					$get_by = 'email';
				} else {
					$error = esc_html__( 'There is no user registered with that email address.', 'edumy' );			
				}
			} else if (validate_username( $account )) {
				if( username_exists($account) ) {
					$get_by = 'login';
				} else {
					$error = esc_html__( 'There is no user registered with that username.', 'edumy' );				
				}
			} else {
				$error = esc_html__(  'Invalid username or e-mail address.', 'edumy' );		
			}
		}	
		
		if (empty ($error)) {
			$random_password = wp_generate_password();

			$user = get_user_by( $get_by, $account );
				
			$update_user = wp_update_user( array ( 'ID' => $user->ID, 'user_pass' => $random_password ) );
				
			if( $update_user ) {
				
				$from = get_option('admin_email');
				
				
				$to = $user->user_email;
				$subject = esc_html__( 'Your new password', 'edumy' );
				
				$message = esc_html__( 'Your new password is: ', 'edumy' ) .$random_password;
					
				$headers = sprintf( "From: %s <%s>\r\n Content-type: text/html", get_bloginfo('name'), $from );
				
				$mail = wp_mail( $to, $subject, $message, $headers );
				
				
				if( $mail ) {
					$success = esc_html__( 'Check your email address for you new password.', 'edumy' );
				} else {
					$error = esc_html__( 'System is unable to send you mail containg your new password.', 'edumy' );						
				}
			} else {
				$error =  esc_html__( 'Oops! Something went wrong while updating your account.', 'edumy' );
			}
		}
	
		if ( ! empty( $error ) ) {
			echo json_encode(array('loggedin'=> false, 'msg'=> $error));
		}
				
		if ( ! empty( $success ) ) {
			echo json_encode(array('loggedin' => true, 'msg'=> $success ));	
		}
		die();
	}


	/**
	 * add all actions will be called when user login.
	 */
	public function setup() {
		add_action('wp_footer', array( $this, 'popupForm' ) );
		add_action( 'apus-account-buttons', array( $this, 'button' ) );
	}

	/**
	 * render link login or show greeting when user logined in
	 *
	 * @return String.
	 */
	public function button(){
		if ( !is_user_logged_in() ) {
			?>
			<div class="account-login">
				<ul class="login-account">
					<li><a href="#apus_login_forgot_tab" class="apus-user-login wel-user"><?php esc_html_e( 'Login','edumy' ); ?></a> </li>
					<li class="space">/</li>
					<li><a href="#apus_register_tab" class="apus-user-register wel-user"><?php esc_html_e( 'Register','edumy' ); ?></a></li>
				</ul>
			</div>
			<?php
		} else {
			$user_id = get_current_user_id();
            $user = get_userdata( $user_id );
			?>
			<div class="pull-right">
                <div class="setting-account">
            		<div class="profile-menus flex-middle clearfix">
                        <div class="profile-avarta pull-left"><?php echo get_avatar($user_id, 32); ?></div>
                        <div class="profile-info pull-left">
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
            </div>
			<?php
		}
	}

	/**
	 * check if user not login that showing the form
	 */
	public function popupForm() {
		if ( !is_user_logged_in() ) {
 			get_template_part( 'template-parts/login-register' );
		}	
	}

	public function registration_validation( $username, $email, $password, $confirmpassword ) {
		global $reg_errors;
		$reg_errors = new WP_Error;
		
		if ( empty( $username ) || empty( $password ) || empty( $email ) || empty( $confirmpassword ) ) {
		    $reg_errors->add('field', esc_html__( 'Required form field is missing', 'edumy' ) );
		}

		if ( 4 > strlen( $username ) ) {
		    $reg_errors->add( 'username_length', esc_html__( 'Username too short. At least 4 characters is required', 'edumy' ) );
		}

		if ( username_exists( $username ) ) {
	    	$reg_errors->add('user_name', esc_html__( 'That username already exists!', 'edumy' ) );
		}

		if ( ! validate_username( $username ) ) {
		    $reg_errors->add( 'username_invalid', esc_html__( 'The username you entered is not valid', 'edumy' ) );
		}

		if ( 5 > strlen( $password ) ) {
	        $reg_errors->add( 'password', esc_html__( 'Password length must be greater than 5', 'edumy' ) );
	    }

	    if ( $password != $confirmpassword ) {
	        $reg_errors->add( 'password', esc_html__( 'Password must be equal Confirm Password', 'edumy' ) );
	    }

	    if ( !is_email( $email ) ) {
		    $reg_errors->add( 'email_invalid', esc_html__( 'Email is not valid', 'edumy' ) );
		}

		if ( email_exists( $email ) ) {
		    $reg_errors->add( 'email', esc_html__( 'Email Already in use', 'edumy' ) );
		}
	}

	public function complete_registration($username, $password, $email) {
        $userdata = array(
	        'user_login' => $username,
	        'user_email' => $email,
	        'user_pass' => $password,
        );
        return wp_insert_user( $userdata );
	}

	public function processRegister() {
		global $reg_errors;
		check_ajax_referer( 'ajax-apus-register-nonce', 'security_register' );
        $this->registration_validation( $_POST['username'], $_POST['email'], $_POST['password'], $_POST['confirmpassword'] );
        if ( 1 > count( $reg_errors->get_error_messages() ) ) {
	        $username = sanitize_user( $_POST['username'] );
	        $email = sanitize_email( $_POST['email'] );
	        $password = esc_attr( $_POST['password'] );
	 		
	        $user_id = $this->complete_registration($username, $password, $email);
	        if ( ! is_wp_error( $user_id ) ) {

	        	$jsondata = array('loggedin' => true, 'msg' => esc_html__( 'You have registered, redirecting ...', 'edumy' ) );
	        	$info['user_login'] = $username;
			    $info['user_password'] = $password;
			    $info['remember'] = 1;
				
				wp_signon( $info, false );
	        } else {
		        $jsondata = array('loggedin' => false, 'msg' => esc_html__( 'Register user error!', 'edumy' ) );
		    }
	    } else {
	    	$jsondata = array('loggedin' => false, 'msg' => implode(', <br>', $reg_errors->get_error_messages()) );
	    }
	    echo json_encode($jsondata);
	    exit;
	}

	
	public function process_change_profile_form() {
		check_ajax_referer( 'edumy-ajax-edit-profile-nonce', 'security_edit_profile' );

		$return = array();
		$user = wp_get_current_user();

		$nickname = isset($_POST['nickname']) ? sanitize_user( $_POST['nickname'] ) : '';
		$email = isset($_POST['email']) ? sanitize_email( $_POST['email'] ) : '';

		$general_keys = array( 'first_name', 'last_name', 'phone', 'description', 'url' );
		$keys = array(
			'current_user_avatar', 'address', 'birthday', 'socials'
		);

		if ( empty( $nickname ) ) {
			$return['msg'] = '<div class="text-danger">'.esc_html__( 'Nickname is required.', 'edumy' ).'</div>';
			echo json_encode($return); exit;
		}

		if ( empty( $email ) ) {
			$return['msg'] = '<div class="text-danger">'.esc_html__( 'E-mail is required.', 'edumy' ).'</div>';
			echo json_encode($return); exit;
		}

		update_user_meta( $user->ID, 'nickname', $nickname );

		update_user_meta( $user->ID, 'user_email', $email );
		wp_update_user( array(
			'ID'            => $user->ID,
			'user_email'    => $email,
		) );
		foreach ($general_keys as $key) {
			$value = isset($_POST[$key]) ? sanitize_text_field( $_POST[$key] ) : '';
			update_user_meta( $user->ID, $key, $value );
		}
		foreach ($keys as $key) {
			if ( $key !== 'socials' ) {
				$value = isset($_POST[$key]) ? sanitize_text_field( $_POST[$key] ) : '';
				if ( $key == 'current_user_avatar' ) {
					$attachment_id = edumy_create_attachment($value);
					update_user_meta( $user->ID, 'apus_user_avatar', $attachment_id );
				} else {
					update_user_meta( $user->ID, 'apus_'.$key, $value );
				}
			} else {
				$value = isset($_POST[$key]) ? $_POST[$key] : '';
				update_user_meta( $user->ID, 'apus_'.$key, $value );
			}
		}
		$return['msg'] = '<div class="text-success">'.esc_html__( 'Profile has been successfully updated.', 'edumy' ).'</div>';
		echo json_encode($return); exit;
	}

	public function process_change_password() {
		check_ajax_referer( 'edumy-ajax-change-pass-nonce', 'security_change_pass' );
		
		if ( !is_user_logged_in() ) {
			return;
		}

		$old_password = sanitize_text_field( $_POST['old_password'] );
		$new_password = sanitize_text_field( $_POST['new_password'] );
		$retype_password = sanitize_text_field( $_POST['retype_password'] );

		if ( empty( $old_password ) || empty( $new_password ) || empty( $retype_password ) ) {
			$return['msg'] = '<div class="text-danger">'.esc_html__( 'All fields are required.', 'edumy' ).'</div>';
			echo json_encode($return); exit;
		}

		if ( $new_password != $retype_password ) {
			$return['msg'] = '<div class="text-danger">'.esc_html__( 'New and retyped password are not same.', 'edumy' ).'</div>';
			echo json_encode($return); exit;
		}

		$user = wp_get_current_user();

		if ( ! wp_check_password( $old_password, $user->data->user_pass, $user->ID ) ) {
			$return['msg'] = '<div class="text-danger">'.esc_html__( 'Your old password is not correct.', 'edumy' ).'</div>';
			echo json_encode($return); exit;
		}

		wp_set_password( $new_password, $user->ID );
		
    	$info['user_login'] = $user->nickname;
	    $info['user_password'] = $new_password;
	    $info['remember'] = 1;
		wp_signon( $info, false );

		$return['msg'] = '<div class="text-success">'.esc_html__( 'Your password has been successfully changed.', 'edumy' ).'</div>';
		echo json_encode($return); exit;
	}

}

new Edumy_Apus_Userinfo();
?>
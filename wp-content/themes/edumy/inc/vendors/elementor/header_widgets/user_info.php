<?php

//namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Edumy_Elementor_User_Info extends Elementor\Widget_Base {

	public function get_name() {
        return 'edumy_user_info';
    }

	public function get_title() {
        return esc_html__( 'Apus Header User Info', 'edumy' );
    }
    
	public function get_categories() {
        return [ 'edumy-header-elements' ];
    }

	protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'edumy' ),
                'tab' => Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__( 'Alignment', 'edumy' ),
                'type' => Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'edumy' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'edumy' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'edumy' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
            ]
        );


        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'edumy' ),
                'type' => Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    '' => [
                        'title' => esc_html__( 'Dark', 'edumy' ),      
                        'icon' => 'fa fa-circle',                  
                    ],
                    'white' => [
                        'title' => esc_html__( 'White', 'edumy' ), 
                        'icon' => 'fa fa-circle-thin',
                    ],
                    'gray' => [
                        'title' => esc_html__( 'Gray', 'edumy' ), 
                        'icon' => 'fa fa-circle-o',
                    ],
                ],
                'default' => '',  
                'toggle' => true,              
            ]
        );



        $this->add_control(
            'el_class',
            [
                'label'         => esc_html__( 'Extra class name', 'edumy' ),
                'type'          => Elementor\Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'edumy' ),
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__( 'Tyles', 'edumy' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__( 'Text Color', 'edumy' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .login-account, {{WRAPPER}} .profile-info' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'link_color',
            [
                'label' => esc_html__( 'Link Color', 'edumy' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .login-account a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'link_hover_color',
            [
                'label' => esc_html__( 'Link Hover Color', 'edumy' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .login-account a:hover, {{WRAPPER}} .login-account a:focus' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'link_color_drop',
            [
                'label' => esc_html__( 'Link Drop Color', 'edumy' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .user-account a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'link_hover_color_drop',
            [
                'label' => esc_html__( 'Link Drop Hover Color', 'edumy' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .user-account a:hover, {{WRAPPER}} .user-account a:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Typography', 'edumy' ),
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .login-account',
            ]
        );

        $this->end_controls_section();

    }

	protected function render() {
        $settings = $this->get_settings();

        extract( $settings );

        if ( is_user_logged_in() ) {
            $user_id = get_current_user_id();
            $user = get_userdata( $user_id );

            ?>
            <div class="setting-account <?php echo esc_attr($el_class.' '.$style); ?>">           
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
                <ul class="login-account <?php echo esc_attr($style); ?>">
                    <li class="icon-log"><a href="#apus_login_forgot_tab" class="apus-user-login"><i class="flaticon-user"></i></a></li>
                    <li><a href="#apus_login_forgot_tab" class="apus-user-login wel-user"><?php esc_html_e( 'Login','edumy' ); ?>/</a></li>
                    <li><a href="#apus_register_tab" class="apus-user-register wel-user"><?php esc_html_e( 'Register','edumy' ); ?></a></li>
                </ul>
            </div>
        <?php }
    }
}

Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Edumy_Elementor_User_Info );
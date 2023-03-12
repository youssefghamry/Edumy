<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Edumy_Elementor_Testimonials extends Widget_Base {

	public function get_name() {
        return 'edumy_testimonials';
    }

	public function get_title() {
        return esc_html__( 'Apus Testimonials', 'edumy' );
    }

	public function get_icon() {
        return 'eicon-testimonial';
    }

	public function get_categories() {
        return [ 'edumy-elements' ];
    }

	protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'edumy' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'content', [
                'label' => esc_html__( 'Content', 'edumy' ),
                'type' => Controls_Manager::TEXTAREA
            ]
        );

        $repeater->add_control(
            'img_src',
            [
                'name' => 'image',
                'label' => esc_html__( 'Choose Image', 'edumy' ),
                'type' => Controls_Manager::MEDIA,
                'placeholder'   => esc_html__( 'Upload Brand Image', 'edumy' ),
            ]
        );
        $repeater->add_control(
            'name',
            [
                'label' => esc_html__( 'Name', 'edumy' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'John Doe',
            ]
        );

        $repeater->add_control(
            'job',
            [
                'label' => esc_html__( 'Job', 'edumy' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Designer',
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__( 'Link To', 'edumy' ),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__( 'Enter your social link here', 'edumy' ),
                'placeholder' => esc_html__( 'https://your-link.com', 'edumy' ),
            ]
        );

        $this->add_control(
            'testimonials',
            [
                'label' => esc_html__( 'Testimonials', 'edumy' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );
        
        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'edumy' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'style1' => esc_html__('Style1', 'edumy'),
                    'style2' => esc_html__('Style2', 'edumy'),
                    'style3' => esc_html__('Style3', 'edumy'),
                ),
                'default' => 'style1'
            ]
        );

   		$this->add_control(
            'el_class',
            [
                'label'         => esc_html__( 'Extra class name', 'edumy' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'edumy' ),
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__( 'Tyles', 'edumy' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'edumy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .widget-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Title Typography', 'edumy' ),
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .widget-title',
            ]
        );

        $this->add_control(
            'test_title_color',
            [
                'label' => esc_html__( 'Testimonial Title Color', 'edumy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .name-client a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Testimonial Title Typography', 'edumy' ),
                'name' => 'test_title_typography',
                'selector' => '{{WRAPPER}} .name-client a',
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => esc_html__( 'Content Color', 'edumy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Content Typography', 'edumy' ),
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .description',
            ]
        );

        $this->add_control(
            'job_color',
            [
                'label' => esc_html__( 'Job Color', 'edumy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .job' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Job Typography', 'edumy' ),
                'name' => 'job_typography',
                'selector' => '{{WRAPPER}} .job',
            ]
        );

        $this->end_controls_section();
    }

	protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        if ( !empty($testimonials) ) {
            ?>
            <div class="widget widget-testimonials <?php echo esc_attr($el_class.' '.$style); ?>">
                <?php if($style == 'style1'): ?>                    
                    <div class="symbol">“</div>                    
                    <div class="slick-carousel testimonial-thumbnail" data-carousel="slick" data-items="3" data-smallmedium="3" data-extrasmall="3" data-pagination="false" data-nav="false" data-asnavfor=".testimonial-main" data-slidestoscroll="1" data-focusonselect="true">
                        <?php foreach ($testimonials as $item) {
                            $img_src = ( isset( $item['img_src']['id'] ) && $item['img_src']['id'] != 0 ) ? wp_get_attachment_url( $item['img_src']['id'] ) : '';
                            if ( $img_src ) {
                            ?>
                                <div class="avarta">
                                    <img src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr(!empty($item['name']) ? $item['name'] : ''); ?>">
                                </div>
                            <?php }
                        } ?>
                    </div>
                    <div class="slick-carousel testimonial-main" data-carousel="slick" data-items="1" data-smallmedium="1" data-extrasmall="1" data-pagination="false" data-nav="false" data-asnavfor=".testimonial-thumbnail" data-slickparent="true">
                        <?php foreach ($testimonials as $item) { ?>
                            <div class="testimonials-item">
                                <div class="info">
                                    <?php if ( !empty($item['name']) ) {

                                        $title = '<h3 class="name-client">'.$item['name'].'</h3>';
                                        if ( ! empty( $item['link']['url'] ) ) {
                                            $title = sprintf( '<h3 class="name-client"><a href="'.esc_url($item['link']['url']).'" target="'.esc_attr($item['link']['is_external'] ? '_blank' : '_self').'" '.($item['link']['nofollow'] ? 'rel="nofollow"' : '').'>%1$s</a></h3>', $item['name'] );
                                        }
                                        echo wp_kses_post($title);
                                    ?>
                                    <?php } ?>

                                    <?php if ( !empty($item['job']) ) { ?>
                                        <p class="job text-theme"><span><?php echo wp_kses_post($item['job']); ?></span></p>
                                    <?php } ?>

                                    <?php if ( !empty($item['content']) ) { ?>
                                        <div class="description"><?php echo wp_kses_post($item['content']); ?></div>
                                    <?php } ?>

                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php elseif($style == 'style2'): ?>                
                    <div class="slick-carousel testimonial-main" data-carousel="slick" data-items="1" data-smallmedium="1" data-extrasmall="1" data-pagination="true" data-nav="false" data-infinite="true">                 
                        <?php foreach ($testimonials as $item) { ?>
                            <div class="testimonials-item">
                                <div class="info">                                   
                                    <?php if ( !empty($item['content']) ) { ?>
                                        <div class="description"><?php echo wp_kses_post($item['content']); ?></div>
                                    <?php } ?>

                                    <?php
                                    $img_src = ( isset( $item['img_src']['id'] ) && $item['img_src']['id'] != 0 ) ? wp_get_attachment_url( $item['img_src']['id'] ) : '';
                                    if ( $img_src ) {
                                    ?>
                                        <div class="avarta">
                                            <img src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr(!empty($item['name']) ? $item['name'] : ''); ?>">
                                        </div>
                                    <?php } ?>
                                    <?php if ( !empty($item['name']) ) {

                                        $title = '<h3 class="name-client">'.$item['name'].'</h3>';
                                        if ( ! empty( $item['link']['url'] ) ) {
                                            $title = sprintf( '<h3 class="name-client"><a href="'.esc_url($item['link']['url']).'" target="'.esc_attr($item['link']['is_external'] ? '_blank' : '_self').'" '.($item['link']['nofollow'] ? 'rel="nofollow"' : '').'>%1$s</a></h3>', $item['name'] );
                                        }
                                        echo wp_kses_post($title);
                                    ?>
                                    <?php } ?>

                                    <?php if ( !empty($item['job']) ) { ?>
                                        <p class="job text-theme"><span><?php echo wp_kses_post($item['job']); ?></span></p>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php else: ?>                
                    <div class="slick-carousel testimonial-main" data-carousel="slick" data-items="1" data-smallmedium="1" data-extrasmall="1" data-pagination="true" data-nav="false">                 
                        <?php foreach ($testimonials as $item) { ?>
                            <div class="testimonials-item">
                                <div class="info">                                    
                                    <div class="testimonial-info-container">
                                        <?php
                                        $img_src = ( isset( $item['img_src']['id'] ) && $item['img_src']['id'] != 0 ) ? wp_get_attachment_url( $item['img_src']['id'] ) : '';
                                        if ( $img_src ) {
                                        ?>
                                            <div class="avarta">
                                                <img src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr(!empty($item['name']) ? $item['name'] : ''); ?>">
                                            </div>
                                        <?php } ?>
                                        <?php if ( !empty($item['name']) ) {

                                            $title = '<h3 class="name-client">'.$item['name'].'</h3>';
                                            if ( ! empty( $item['link']['url'] ) ) {
                                                $title = sprintf( '<h3 class="name-client"><a href="'.esc_url($item['link']['url']).'" target="'.esc_attr($item['link']['is_external'] ? '_blank' : '_self').'" '.($item['link']['nofollow'] ? 'rel="nofollow"' : '').'>%1$s</a></h3>', $item['name'] );
                                            }
                                            echo wp_kses_post($title);
                                        ?>
                                        <?php } ?>

                                        <?php if ( !empty($item['job']) ) { ?>
                                            <p class="job text-theme"><span><?php echo wp_kses_post($item['job']); ?></span></p>
                                        <?php } ?>

                                        <?php if ( !empty($item['content']) ) { ?>
                                            <div class="description"><?php echo wp_kses_post($item['content']); ?></div>
                                        <?php } ?>                                        
                                    </div>                                  
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php endif; ?>             
            </div>
            <?php
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Edumy_Elementor_Testimonials );
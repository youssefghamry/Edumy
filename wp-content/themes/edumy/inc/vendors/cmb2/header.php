<?php

if ( !function_exists( 'edumy_header_metaboxes' ) ) {
	function edumy_header_metaboxes(array $metaboxes) {
		
		$prefix = 'apus_header_';
	    $fields = array(
			array(
                'id' => $prefix.'transparent',
                'type' => 'select',
                'name' => esc_html__('Transparent all page ?', 'edumy'),
                'default' => 'no',
                'options' => array(
                    'no' => esc_html__('No', 'edumy'),
                    'yes' => esc_html__('Yes', 'edumy')
                )
            ),
    	);
		
	    $metaboxes[$prefix . 'display_setting'] = array(
			'id'                        => $prefix . 'display_setting',
			'title'                     => esc_html__( 'Display Settings', 'edumy' ),
			'object_types'              => array( 'apus_header' ),
			'context'                   => 'normal',
			'priority'                  => 'high',
			'show_names'                => true,
			'fields'                    => $fields
		);

	    return $metaboxes;
	}
}
add_filter( 'cmb2_meta_boxes', 'edumy_header_metaboxes' );


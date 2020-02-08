<?php

class Capstone_FacetWP_Submit {

	public function __construct() {
        // add_filter( 'facetwp_assets', array( $this, 'facetwp_submit_assets' ) );
        add_filter( 'facetwp_shortcode_html', array( $this, 'facetwp_submit_shortcode' ), 10, 2 );
    }

    #-------------------------------------------------------------------------------#
    #  FacetWP Submit Assets
    #-------------------------------------------------------------------------------#

    function facetwp_submit_assets( $assets ) {
        $assets['facetwp-submit.js'] = plugins_url( '', __FILE__ ) . '/scripts/js/facetwp-submit.js';
        return $assets;
    }

    #-------------------------------------------------------------------------------#
    #  FacetWP Submit Shortcode
    #-------------------------------------------------------------------------------#

    function facetwp_submit_shortcode( $output, $atts ) {
        if ( isset( $atts['submit'] ) ) {
            $label = isset( $atts['label'] ) ? $atts['label'] : __( 'Search', 'capstone' );
            $output = '<button class="fwp-submit" data-href="' . esc_attr( $atts['submit'] ) . '">' . esc_attr( $label ) . '</button>';
        }
        return $output;
    }

}

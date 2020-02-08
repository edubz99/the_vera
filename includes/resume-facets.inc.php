<?php 
// Helper Variable(s)
$resume_facets = get_theme_mod( 'capstone_resumes_filters_order_facetwp' );

?>

<div id="resumes-facets-module">
    <?php
        $output = '';
        if ( ! empty( $resume_facets ) ) {
            foreach ( $resume_facets as $facet ) {
                $facet_name = is_array( $facet ) ? $facet['name'] : $facet;
                $output .= facetwp_display( 'facet', $facet_name );
            }
        }
        echo wp_kses_post($output);
    ?>

    <?php if (empty($output)) { ?>
        <p class="no-facets"><?php esc_html_e('Please assign some facets to this area under "Appearance -> Customize -> Resumes Settings -> Master Page".', 'capstone'); ?></p>
    <?php } ?>
</div>
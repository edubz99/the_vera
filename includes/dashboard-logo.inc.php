<?php

    $logo_url = is_page_template( 'template-compact.php' ) ? esc_url( home_url('/') ) : esc_url( get_permalink( get_theme_mod('capstone_dashboard_main_page') ) );
    
    // Display Dashboard Logo -> Fallbacks to Site Logo
    if ( get_theme_mod( 'capstone_dashboard_logo' ) ) {
        echo '<a href="'. esc_url($logo_url) .'">';
        echo '<img src="'. esc_url(get_theme_mod('capstone_dashboard_logo')) .'" alt="'. esc_attr( get_bloginfo('name') ) .'">';
        echo '</a>';
    } else if ( function_exists( 'the_custom_logo' ) ) {
        the_custom_logo();
    }

?>
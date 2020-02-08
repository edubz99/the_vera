<h3 id="site-logo" itemscope itemtype="https://schema.org/Brand">
    <?php
        
        // Display custom logo if it exists
        if ( function_exists( 'the_custom_logo' ) ) {
            the_custom_logo();
        }

        // No Custom Logo, just display the site's name
        if (!has_custom_logo()) { ?>
            <a href="<?php echo esc_url( home_url('/') ); ?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>"><?php echo esc_html( get_bloginfo('name') ); ?>.</a>
        <?php
        }                        

    ?>
</h3>
<?php 
    // Helper Variable(s)
    $heading_text = ( get_post_type() == 'resume' ) ? esc_html__('Bookmark Resume', 'capstone') : esc_html__('Bookmark Job', 'capstone'); 
?>

<?php include(locate_template( 'includes/dashboard-config.inc.php' )); ?>

<div id="add-bookmark-<?php the_ID(); ?>" class="mfp-hide white-popup-block">
    <h2 class="title"><?php echo esc_html($heading_text); ?></h2>
    <?php
    if (class_exists( 'WP_Job_Manager_Bookmarks' )) {
        if ($is_logged_in) {
            do_action('capstone_bookmark_popup');   
        } else {
            $login_url = get_theme_mod('capstone_auth_login_page') ? get_permalink(get_theme_mod('capstone_auth_login_page')) . '?redirect_to=' .  get_permalink() : wp_login_url( get_permalink() );
            echo '<p>'. sprintf( __( 'You must <a href="%s">sign in</a> to bookmark this listing.', 'capstone' ), $login_url ) .'</p>';
        }
    } else {
        echo '<p>'. esc_html__('Please enable the bookmarks plugin to activate this feature.', 'capstone') .'</p>';
    }
    ?>
</div>
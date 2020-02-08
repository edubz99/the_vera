<?php
    // Helper Variable(s)
    $footer_text_widget_1_title = get_theme_mod('capstone_footer_text_widget_1_title');
    $footer_text_widget_1_content = get_theme_mod('capstone_footer_text_widget_1_content');

    $footer_text_widget_2_title = get_theme_mod('capstone_footer_text_widget_2_title');
    $footer_text_widget_2_content = get_theme_mod('capstone_footer_text_widget_2_content');
    
    $footer_copyright_text = get_theme_mod('capstone_footer_copyright_text', __('Made with <i class="material-icons">favorite_border</i> by wpscouts - &copy; All rights reserved', 'capstone'));
?>

                <footer id="site-footer">

                    <div class="container">
                        <?php do_action('capstone_footer_container_start'); ?>
                        <?php if ($footer_text_widget_1_title || $footer_text_widget_1_content || $footer_text_widget_2_title || $footer_text_widget_2_content) { ?>
                            <div class="top">
                                <?php if ( $footer_text_widget_1_title || $footer_text_widget_1_content ) { ?>
                                    <div class="widget widget-text">
                                        <h4 class="title"><?php echo esc_html($footer_text_widget_1_title); ?></h4>
                                        <p><?php echo wp_kses_post( $footer_text_widget_1_content ); ?></p>
                                    </div>
                                <?php } ?>
                                <?php if ( $footer_text_widget_2_title || $footer_text_widget_2_content ) { ?>
                                    <div class="widget widget-text">
                                        <h4 class="title"><?php echo esc_html($footer_text_widget_2_title); ?></h4>
                                        <p><?php echo wp_kses_post($footer_text_widget_2_content); ?></p>
                                    </div>
                                <?php } ?>
                                <?php
                                    // Helper Variable(s)
                                    $social_profile_group = get_theme_mod( 'capstone_social_profiles_group');
                                ?>
                                <?php if ($social_profile_group) { ?>
                                    <nav class="widget widget-social-links">
                                        <ul>
                                            <?php foreach ($social_profile_group as $profile) { ?>
                                                <li><a href="<?php echo esc_url($profile['url']); ?>" target="_blank"><i class="<?php echo esc_attr($profile['plateform']); ?>"></i></a></li>
                                            <?php } ?>
                                        </ul>
                                    </nav>
                                <?php } ?>
                            </div>
                        <?php } ?>

                        <div class="bottom">
                            <?php 
                            $args = array(
                                'theme_location'  => 'capstone-secondary-navigation',
                                'container'       => 'nav',
                                'container_id'    => 'footer-navigation'
                            );

                            wp_nav_menu($args);
                            ?>

                            <p class="copyright-notice"><?php echo wp_kses_post($footer_copyright_text); ?></p>
                        </div>
                        <?php do_action('capstone_footer_container_end'); ?>
                    </div>
                </footer>

                <?php do_action('capstone_footer_after'); ?>
                
                <div id="page-controls">
                    <?php do_action('capstone_page_controls_before'); ?>
                    <a class="page-control go-to-top" href="#site-container"><img src="<?php echo esc_url( get_template_directory_uri() .'/images/arrow-icon.svg' ); ?>" alt="<?php esc_attr_e('Goto Top' ,'capstone'); ?>"></a>
                    <?php do_action('capstone_page_controls_after'); ?>
                </div>

                <?php get_template_part( 'includes/site-clipboard.inc' ); ?>
                
                <?php do_action('capstone_site_container_end'); ?>
            </div><!-- END: #site-container -->



    <!-- WP Footer
    ================================================== -->
    <?php wp_footer(); ?>

    </body>

</html>
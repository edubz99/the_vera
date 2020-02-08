<?php

#-----------------------------------------------------------------#
#
#	Here we have all the HELPER functions for the theme
#	Please be extremely cautious editing this file,
#	When things go wrong, they intend to go wrong in a big way.
#	You have been warned!
#
#-----------------------------------------------------------------#

#-------------------------------------------------------------------------------#
#  Add Custom Query Vars to acces them via `get_query_var()`
#-------------------------------------------------------------------------------#

	function capstone_custom_query_vars( $vars ) {
		$vars[] = "search_keywords";
		$vars[] = "search_location";
		$vars[] = "search_category";
		$vars[] = "search_type";
		$vars[] = "search_industry";
		$vars[] = "map_enabled";
		$vars[] = "is_standard";
		$vars[] = "redirect_to";
		return $vars;
	}
	add_filter('query_vars','capstone_custom_query_vars');


#-------------------------------------------------------------------------------#
#  Fallback for wp_nav_menu()
#-------------------------------------------------------------------------------#

	function capstone_default_menu() { ?>

	    <nav id="site-navigation">
	        <ul class="sf-menu links-list">
	            <li class="menu-item"><a href="<?php echo esc_url( admin_url('nav-menus.php') ); ?>"><?php esc_html_e( 'Create Menu', 'capstone' ); ?></a></li>
	        </ul>
	    </nav>

	<?php
	}


#-----------------------------------------------------------------#
# Fallback for ACF get_field() function
# Cannot be Prefixed with Theme Slug
#-----------------------------------------------------------------# 

	if ( !is_admin() && !function_exists('get_field') ) {

		function get_field($key, $post_ID = NULL) {
			$post_ID = isset($post_ID) ? $post_ID : get_the_ID();
			return get_post_meta($post_ID, $key, true);
		}

	}

#-----------------------------------------------------------------#
# Comment Template
#-----------------------------------------------------------------#


	if ( !function_exists('capstone_comments') ) {

		function capstone_comments($comment, $args, $depth) {
		
	        $isByAuthor = false;

	        if($comment->comment_author_email == get_the_author_meta('email')) {
	            $isByAuthor = true;
	        }

	        $GLOBALS['comment'] = $comment; ?>
	        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

	            <div id="comment-<?php comment_ID(); ?>">

                    <!-- Avatar -->
                    <a class="author-avatar" href="#">
                        <?php echo wp_kses_post( get_avatar($comment,$size='72') ); ?>
                    </a> 	            
	                
	                <!-- Body -->
	                <div class="comment-body">

			            <!-- Meta -->
			            <div class="comment-meta">
			                <span class="author"><?php echo wp_kses_post( get_comment_author_link() ); ?></span>
			                <span class="time"><?php printf(esc_html__('%s ago', 'capstone'), human_time_diff( get_comment_time('U'), current_time('timestamp') )); ?></span>
			                <span class="reply"><?php comment_reply_link(array_merge( $args, array('reply_text' => '<i class="fa fa-reply"></i>', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>
			            </div>

	                    <?php if ($comment->comment_approved == '0') : ?>
	                        <em class="moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'capstone') ?></em><br />
	                    <?php endif; ?>

	                    <div class="comment-content">
	                        <?php comment_text() ?>
	                    </div>

	                </div>

	            </div>
		<?php
		}
	}


#-------------------------------------------------------------------------------#
#  Comments Navigation
#-------------------------------------------------------------------------------#

	if ( ! function_exists( 'capstone_comment_nav' ) ) {

		function capstone_comment_nav() {
			// Are there comments to navigate through?
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
			?>
			<nav class="navigation comment-navigation" role="navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'capstone' ); ?></h2>
				<div class="nav-links">
					<?php
						if ( $prev_link = get_previous_comments_link( esc_html__( 'Older Comments', 'capstone' ) ) ) :
							printf( '<div class="nav-previous">%s</div>', $prev_link );
						endif;

						if ( $next_link = get_next_comments_link( esc_html__( 'Newer Comments', 'capstone' ) ) ) :
							printf( '<div class="nav-next">%s</div>', $next_link );
						endif;
					?>
				</div><!-- .nav-links -->
			</nav><!-- .comment-navigation -->
			<?php
			endif;
		}

	}
 

#-------------------------------------------------------------------------------#
#  Filter Body Class
#-------------------------------------------------------------------------------#

	function capstone_body_classes($classes) {
		global $post;

		// conditional statements
		include(locate_template( 'includes/page-config.inc.php' ));
		include(locate_template( 'includes/dashboard-config.inc.php' ));
		include(locate_template( 'helpers/demo-config.inc.php' ));

		// define classes
		$classes[] = !get_theme_mod('capstone_disable_preloader', false) ? 'preload' : '';
		$classes[] = isset($post->post_content) && has_shortcode( $post->post_content, 'products' ) ? 'product-listing-page' : '';
		$classes[] = $is_demo_site ? 'demo-site' : '';
		$classes[] = $is_demo_user ? 'demo-logged-in' : '';
		$classes[] = $page_enhancements && in_array('remove_border', $page_enhancements) ? 'remove-sidebar-content-border' : '';
		$classes[] = $is_hero ? 'has-hero' : '';
		$classes[] = $is_resume_page ? 'resume-listing-page' : '';
		$classes[] = $is_job_page ? 'job-listing-page' : '';
		$classes[] = $is_companies_page ? 'company-listing-page' : '';
		$classes[] = $is_registration_page ? 'auth-registration-page' : '';
		$classes[] = $is_login_page ? 'auth-login-page' : '';
		$classes[] = $is_pass_recovery_page ? 'auth-pass-recovery-page' : '';
		return $classes;
	}
	add_filter('body_class', 'capstone_body_classes');


#-------------------------------------------------------------------------------#
#  Exclude Pages from default Search Result
#-------------------------------------------------------------------------------#

	function capstone_search_filter($query) {
		if ($query->is_search) {
			if ( !isset($query->query_vars['post_type']) ) {
				$query->set('post_type', 'post');
			}
		}
		return $query;
	}
	add_filter('pre_get_posts','capstone_search_filter');


#-------------------------------------------------------------------------------#
#  Blog Custom Read More Link
#-------------------------------------------------------------------------------#

	function capstone_read_more_link() {
		return '<div class="read-more"><a href="' . get_permalink() . '">'. esc_html__('Learn More', 'capstone').' <img src="'. esc_url( get_template_directory_uri() . '/images/arrow-right.svg' ) .'" alt="'. esc_attr__('Learn More', 'capstone') .'"></a></div>';
	}
	add_filter( 'the_content_more_link', 'capstone_read_more_link' );

	
#-------------------------------------------------------------------------------#
#  Site Background Images
#-------------------------------------------------------------------------------#

	function capstone_site_background_imgs() { ?> 

		<div id="site-bgs">
			<?php
				// Helper Variable(s)
				$top_left_bg = get_theme_mod('capstone_site_bg_top_left', get_template_directory_uri() .'/images/site-top-left-bg.png');
				$top_right_bg = get_theme_mod('capstone_site_bg_top_right', get_template_directory_uri() .'/images/site-top-right-bg.png');
				$bottom_left_bg = get_theme_mod('capstone_site_bg_bottom_left');
				$bottom_right_bg = get_theme_mod('capstone_site_bg_bottom_right', get_template_directory_uri() .'/images/site-bottom-right-bg.png');
			?>
			<div class="top-bgs">
				<?php if ( $top_left_bg ) { ?>
					<img class="top-left-bg" src="<?php echo esc_url($top_left_bg); ?>" alt="Top Left Background">
				<?php } ?>
				<?php if ( $top_right_bg ) { ?>
					<img class="top-right-bg" src="<?php echo esc_url($top_right_bg); ?>" alt="Top Right Background">
				<?php } ?>
			</div>
			<div class="bottom-bgs">
				<?php if ( $bottom_left_bg ) { ?>
					<img class="bottom-left-bg" src="<?php echo esc_url($bottom_left_bg); ?>" alt="Bottom Left Background">
				<?php } ?>
				<?php if ( $bottom_right_bg ) { ?>
					<img class="bottom-right-bg" src="<?php echo esc_url($bottom_right_bg); ?>" alt="Bottom Right Background">
				<?php } ?>
			</div>
		</div>

		<?php
	}
	add_action( 'capstone_site_body_start', 'capstone_site_background_imgs' );
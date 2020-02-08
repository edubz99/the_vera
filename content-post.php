<?php
	// Helper Variable(s)
	$post_excerpt = get_the_excerpt();
	$post_category = get_the_category();

	if ( empty($thumbnail_size) ) {
		if ( is_singular('post') ) {
			$thumbnail_size = 'capstone-blog-large';
		} else if ( get_theme_mod('capstone_blog_layout', 'traditional') == 'traditional' ) {
			$thumbnail_size = 'capstone-blog-large';
		} else if ( get_theme_mod('capstone_blog_layout', 'traditional') == 'magazine' ) {
			$thumbnail_size = ($counter == 1) ? 'capstone-blog-large' : 'capstone-blog-medium';
			$post_excerpt = ($counter == 1) ?  substr($post_excerpt, 0, 210). '...' : substr($post_excerpt, 0, 130). '...';
		}
	}

	// page builder module specific
	if (isset($module_posts) && $module_posts) {
		$thumbnail_size = 'capstone-blog-medium';
		$post_excerpt = substr($post_excerpt, 0, 130). '...';
	}

?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php if ( has_post_thumbnail() ) { ?>
				<figure class="entry-media">
					<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail($thumbnail_size); ?></a>
				</figure>
			<?php } ?>

			<div class="entry-content">
				<header class="entry-header">
					<ul class="top-meta">
						<li class="category"><?php the_category(' '); ?></li>
						<li class="date"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ).' '.esc_html__( 'ago', 'capstone' ); ?></a></li>
					</ul>
					<?php if ( !is_single() ) { ?>
					<h3 class="title">
						<a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
					</h3>
					<?php } else { ?>
						<h1 class="title"><?php the_title(); ?></h1>
					<?php } ?>
					<ul class="bottom-meta">
						<li class="author"><img src="<?php echo esc_url( get_template_directory_uri() .'/images/user-icon.svg'); ?>" alt="<?php esc_attr_e('Post Author', 'capstone'); ?>"><?php echo get_the_author(); ?></li>
						<li class="comments"><img src="<?php echo esc_url( get_template_directory_uri() .'/images/comments-icon.svg'); ?>" alt="<?php esc_attr_e('Number of Comments', 'capstone'); ?>"><?php printf( _n( '%s Comment', '%s Comments', get_comments_number(), 'capstone' ), number_format_i18n( get_comments_number() ) ); ?></li>
					</ul>
				</header>

				<div class="entry-desc">
					<?php
						if ( is_single() || (get_theme_mod('capstone_blog_layout') != 'magazine' && !isset($module_posts) ) ) {
							the_content();
						} else {
							echo '<p>'. esc_html($post_excerpt) .'</p>';
						}
					?>
					<?php if ( !is_single() && ($thumbnail_size == 'capstone-blog-medium' || get_theme_mod('capstone_blog_layout') == 'magazine') ) { ?>
						<div class="read-more">
							<a href="<?php the_permalink(); ?>">
								<?php esc_html_e('Learn More', 'capstone'); ?>
								<img src="<?php echo esc_url( get_template_directory_uri() . '/images/arrow-right.svg' ); ?>" alt="<?php esc_attr_e('Learn More', 'capstone'); ?>">
							</a>
						</div>
					<?php } ?>
				</div>

				<?php if ( is_singular( 'post' ) ) { ?>
					<div class="entry-footer">
						<?php get_template_part( 'includes/post-taxonomies.inc' ); ?>
					</div>
				<?php } ?>
			</div>

	</article>
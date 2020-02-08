<?php if ( resume_manager_user_can_view_resume( $post->ID ) ) : ?>
	<div class="single-resume-content">

		<div class="entry-header">
			<div class="left">
				<h1 class="title"><?php the_title(); ?></h1>
				<span class="tagline"><?php the_candidate_title(); ?></span>
			</div>
		</div>		

		<div class="entry-meta">
			<h4 class="title"><?php esc_html_e('Meta Info', 'capstone'); ?></h4>
			<ul class="meta-fields">
				<?php do_action( 'preview_resume_listing_meta_start' ); ?>
				<li class="location"><span><?php esc_html_e('Location:', 'capstone'); ?></span> <?php the_candidate_location(); ?></li>
				<li class="email"><span><?php esc_html_e('Email:', 'capstone'); ?></span> <?php echo get_post_meta( $post->ID, '_candidate_email', true ); ?></li>
				<?php if ( get_the_resume_category() ) : ?>
					<li class="category"><span><?php esc_html_e('Category:', 'capstone'); ?></span> <?php the_resume_category(); ?></li>
				<?php endif; ?>
				<?php if ( ( $skills = wp_get_object_terms( $post->ID, 'resume_skill', array( 'fields' => 'names' ) ) ) && is_array( $skills ) ) : ?>
					<li class="tags"><span><?php esc_html_e('Skills:', 'capstone'); ?></span><?php echo implode( ', ', $skills ); ?></li>
				<?php endif; ?>
				<?php do_action( 'preview_resume_listing_meta_end' ); ?>
			</ul>
		</div>

		<div class="entry-content">
			<?php do_action( 'preview_resume_listing_desc_before' ); ?>
			<div class="resume-opening">
				<h3 class="title"><?php echo esc_html__('Description', 'capstone'); ?></h3>
				<?php echo apply_filters( 'the_resume_description', get_the_content() ); ?>
			</div>
			<?php do_action( 'preview_resume_listing_desc_after' ); ?>

			<?php if ( $items = get_post_meta( $post->ID, '_candidate_education', true ) ) : ?>
				<h2 class="section-title"><?php esc_html_e( 'Education', 'capstone' ); ?></h2>
				<dl class="candidate-education">
				<?php
					foreach( $items as $item ) : ?>

						<dt>
							<h3 class="title"><span><?php echo esc_html($item['location']); ?></span><small class="date"><?php echo esc_html($item['date']); ?></small></h3>
							<span class="qualification"><?php echo esc_html($item['qualification']); ?></span>
						</dt>
						<dd>
							<?php echo wpautop( wp_kses_post(wptexturize( $item['notes'] )) ); ?>
						</dd>

					<?php endforeach;
				?>
				</dl>
			<?php endif; ?>

			<?php if ( $items = get_post_meta( $post->ID, '_candidate_experience', true ) ) : ?>
				<h2 class="section-title"><?php esc_html_e( 'Experience', 'capstone' ); ?></h2>
				<dl class="candidate-experience">
				<?php
					foreach( $items as $item ) : ?>

						<dt>
							<h3 class="title"><span><?php echo esc_html($item['employer']); ?></span><small class="date"><?php echo esc_html($item['date']); ?></small></h3>
							<span class="designation"><?php echo esc_html($item['job_title']); ?></span>
						</dt>
						<dd>
							<?php echo wpautop( wp_kses_post(wptexturize( $item['notes'] )) ); ?>
						</dd>

					<?php endforeach;
				?>
				</dl>
			<?php endif; ?>
		</div>

		<?php get_job_manager_template( 'contact-details.php', array( 'post' => $post ), 'wp-job-manager-resumes', RESUME_MANAGER_PLUGIN_DIR . '/templates/' ); ?>

	</div>
<?php else : ?>

	<?php get_job_manager_template_part( 'access-denied', 'single-resume', 'wp-job-manager-resumes', RESUME_MANAGER_PLUGIN_DIR . '/templates/' ); ?>

<?php endif; ?>
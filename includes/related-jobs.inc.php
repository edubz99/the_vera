<?php do_action('capstone_related_jobs_widget_start'); ?>

<?php if (has_term('', 'job_listing_category')) { ?>

  <?php
      // Helper Variable(s)
      $active_listing_ID = get_the_ID();
      $active_categories = get_the_terms(get_the_ID(), 'job_listing_category');

      $args = array(
          'search_categories'   => array_map('intval', explode(',', $active_categories[0]->term_id)),
          'posts_per_page'      => get_theme_mod( 'capstone_jobs_single_similiar_jobs_count', 3),
      );
      $listing_query = get_job_listings($args);
  ?>

  <?php if ($listing_query) { ?>

    <section class="related-entries-module">
      <h3 class="module-title"><?php echo esc_html__('Similiar Jobs', 'capstone'); ?></h3>
      <div class="entries-list">
        <?php if ($listing_query->have_posts()) { ?>
          <?php while( $listing_query->have_posts() ) : $listing_query->the_post(); ?>
            <?php if ($active_listing_ID != get_the_ID()) { ?>
              <article class="listing-entry">
                  <div class="entry-header">
                      <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                      <?php if ( taxonomy_exists('job_listing_type') ) { ?>
                        <?php echo get_the_term_list( get_the_ID(), 'job_listing_type', '<span class="type">(', null, ')</span>' ); ?>
                      <?php } ?>
                  </div>
                  <div class="entry-footer">
                      <?php the_company_name( '<span class="company">', '</span>' ); ?>
                      <?php if ( taxonomy_exists('job_listing_category') ) { ?>
                        <?php echo get_the_term_list( get_the_ID(), 'job_listing_category', '<span class="category">', null, '</span>' ); ?>
                      <?php } ?>
                  </div>
              </article>
            <?php } else if ($listing_query->found_posts == 1 && $active_listing_ID == get_the_ID()) { ?>
              <article class="listing-entry">
                <p class="no-entry"><?php echo esc_html__('No related job found.', 'capstone'); ?></p>
              </article>
            <?php } ?>
          <?php endwhile; ?>
        <?php } ?>
        <?php wp_reset_postdata(); ?>
      </div>
      <?php if (class_exists( 'WP_Resume_Manager' ) && get_option('resume_manager_submit_resume_form_page_id')) { ?>
        <p class="alt-cta"><?php esc_html_e('Looking for a job?', 'capstone'); ?> <a href="<?php echo esc_url(get_permalink(get_option('resume_manager_submit_resume_form_page_id'))); ?>"><?php esc_html_e('Post a Resume', 'capstone'); ?> &#10230;</a></p>
      <?php } ?>
    </section>

  <?php } ?>

<?php } ?>

<?php do_action('capstone_related_jobs_widget_end'); ?>
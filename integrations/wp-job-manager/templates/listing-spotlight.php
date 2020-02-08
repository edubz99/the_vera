<section class="module-wrapper listing-spotlight">
    <h3 class="module-title"><?php echo esc_html__('Listing Spotlight', 'capstone'); ?></h3>
    <?php if ($listing_query->have_posts()) { ?>
    <div class="main-carousel">
        <?php while( $listing_query->have_posts() ) : $listing_query->the_post(); ?>
            <?php
            // Helper Variavle(s)
            $spotlight_image = get_field('listing_spotlight_image');
            if ($spotlight_image) {
                if ($_atts['type'] == 'resume') {
                    $spotlight_image = $spotlight_image ? $spotlight_image : get_the_candidate_photo();
                } else {
                    $spotlight_image = $spotlight_image ? $spotlight_image : get_the_company_logo();
                }
            } else {
                if ($_atts['type'] == 'resume') {
                    $spotlight_image = get_template_directory_uri() .'/images/listing-spotlight-bg.png';
                } else {
                    $spotlight_image = get_template_directory_uri() .'/images/listing-spotlight-bg.png';
                }
            }

            $company_obj = get_the_terms(get_the_ID(), 'job_listing_company')[0];
            $skills_count = sizeof(wp_get_post_terms( get_the_ID(), 'resume_skill', array('fields' => 'names') ));
            ?>
            <article class="listing-entry carousel-cell">
            <div class="media">
                <a href="<?php the_permalink(); ?>">
                    <img class="image" src="<?php echo esc_url($spotlight_image); ?>" alt="<?php printf(esc_html__('Open Position at %s', 'capstone'), get_the_company_name()); ?>">
                    <?php if (!get_field('listing_spotlight_image')) { ?>
                        <div class="text">
                            <?php if ($_atts['type'] == 'job_listing') { ?>
                                <?php the_company_name( '<h4 class="company-name">', '</h4>' ); ?>
                                <span class="open-positions"><?php echo esc_html($company_obj->count); ?> <?php echo _n( 'opening', 'openings', $company_obj->count, 'capstone' ); ?></span>
                            <?php } else { ?>
                                <?php the_title( '<h4 class="candidate-name">', '</h4>' ); ?>
                                <span class="skills"><?php echo esc_html($skills_count); ?> <?php echo _n( 'skill', 'skills', $skills_count, 'capstone' ); ?></span>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </a>
            </div>
            <div class="desc">
                <?php if ( taxonomy_exists($_atts['taxonomy']) ) { ?>
                    <?php echo get_the_term_list( get_the_ID(), $_atts['taxonomy'], '<span class="category">', null, '</span>' ); ?>
                <?php } ?>
                <a href="<?php the_permalink(); ?>">
                    <?php if ($_atts['type'] == 'job_listing') { ?>
                        <h4 class="title"><?php the_title(); ?></h4>
                    <?php } else { ?>
                        <h4 class="title"><?php echo get_the_candidate_title(); ?></h4>
                    <?php } ?>
                </a>
                <span class="location"><?php the_job_location(); ?></span>
            </div>
            <div class="action">
                <?php if ( class_exists( 'WP_Job_Manager_Bookmarks' ) ) { ?>
                <a href="#add-bookmark-<?php the_ID(); ?>" class="add-bookmark"><?php echo esc_html__('Save for later', 'capstone'); ?> &xrarr;</a>
                <?php } else { ?>
                <a href="<?php the_permalink(); ?>" class="check-listing"><?php echo esc_html__('Check this out', 'capstone'); ?> &xrarr;</a>
                <?php } ?>
            </div>
            <?php get_template_part('includes/popup-add-bookmark.inc' ); ?>
            </article>
        <?php endwhile; ?>
    </div>
    <?php } else { ?>
    <p><?php echo esc_html__('There is no listing for your mentioned criteria.', 'capstone'); ?></p>
    <?php } ?>
    <?php wp_reset_postdata(); ?>
</section>
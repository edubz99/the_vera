<?php if ( class_exists( 'WP_Job_Manager_Job_Tags' ) ) { ?>

    <?php
        // Helper Variable(s)
        $job_tags = wp_get_post_terms( get_the_ID(), 'job_listing_tag' );
    ?>

    <?php if ($job_tags) { ?>

        <?php do_action('capstone_job_tags_start'); ?>
        <div class="entry-tags">

            <div class="tags-header">
                <h3 class="title"><?php echo get_theme_mod('capstone_jobs_tags_title', esc_html__('Perks & Privilges', 'capstone')); ?></h3>
                <p class="desc"><?php echo get_theme_mod('capstone_jobs_tags_desc', esc_html__('This job listing offers following perks and privileges.', 'capstone')); ?></p>
            </div>

            <ul class="tags-list">
                <?php foreach ($job_tags as $tag) : ?>
                    <li data-tax="<?php echo esc_attr($tag->taxonomy); ?>">
                        <a href="<?php echo esc_url(get_term_link($tag->term_id, $tag->taxonomy)); ?>">
                            <?php if (get_field('term_icon', $tag)) { ?>
                                <span class="icon" style="transform: scale(<?php echo esc_attr(get_field('term_icon_size', $tag)); ?>);">
                                    <img class="svg-icon" src="<?php echo esc_url(get_field('term_icon', $tag)); ?>" alt="<?php echo esc_attr($tag->name); ?>">
                                </span>
                            <?php } else { ?>
                                <span class="icon">
                                    <img class="svg-icon" src="<?php echo esc_url( get_template_directory_uri() .'/images/job-tag-icon.svg'); ?>" alt="<?php echo esc_attr($tag->name); ?>">
                                </span>
                            <?php } ?>
                            <span class="title"><?php echo esc_html($tag->name); ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <?php do_action('capstone_job_tags_end'); ?>
    <?php } ?>

<?php } ?>
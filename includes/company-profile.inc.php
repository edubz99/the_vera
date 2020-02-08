<?php do_action('single_listing_company_profile_widget_before'); ?>

<?php
  // Helper Variable(s)
  $video_link   = get_the_company_video();
  $company_terms = get_the_terms(get_the_ID(), 'job_listing_company');
?>

<section class="profile-module">

  <div class="company-info info">
    <h4 class="title"><?php esc_html_e('Company Profile', 'capstone'); ?></h4>
    <?php the_company_name( '<h2 class="company-name name">', '</h2>' ); ?>
    <?php the_company_tagline( '<p class="company-tagline tagline">', '</p>' ); ?>
  </div>

  <div class="company-meta meta-info">
    
    <?php if (has_action('single_company_listing_social_before') || has_action('single_company_listing_social_after')) { ?>
      <ul class="social-links">
        <?php do_action('single_company_listing_social_before'); ?>
        <?php do_action('single_company_listing_social_after'); ?>
      </ul>
    <?php } ?>

    <?php if ( is_singular('job_listing') ) { ?>
      <?php if (is_array($company_terms)) { ?>
        <a href="<?php echo esc_url(get_term_link($company_terms[0]->slug, 'job_listing_company')); ?>" class="button-default"><?php esc_html_e('Visit Profile', 'capstone'); ?></a>
      <?php } else if ($video_link) { ?>
        <a href="<?php echo esc_url($video_link); ?>" class="button-default company-video-link"><?php esc_html_e('Watch Video', 'capstone'); ?></a>
      <?php } ?>
    <?php } else if ( is_tax('job_listing_company') && $video_link ) { ?>
      <a href="<?php echo esc_url($video_link); ?>" class="button-default company-video-link"><?php esc_html_e('Watch Video', 'capstone'); ?></a>
    <?php } ?>

  </div>
</section>

<?php do_action('single_listing_company_profile_widget_after'); ?>
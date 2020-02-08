<?php include(locate_template( 'includes/page-config.inc.php' )); ?>

  <section class="sidebar-modules">

      <?php if ( $is_job_page ) { ?>
        <?php get_template_part( 'includes/jobs-sidebar-config.inc' ); ?>
        <?php if (class_exists('FacetWP') && !get_query_var('is_standard')) { ?>
          <?php get_template_part( 'includes/job-facets.inc' ); ?>
        <?php } else { ?>
          <?php get_template_part( 'includes/job-search.inc' ); ?>
          <?php get_template_part( 'includes/job-filters.inc' ); ?>
        <?php } ?>
        <?php get_template_part( 'includes/job-alert.inc' ); ?>
        <?php get_sidebar('jobs-master'); ?>
      <?php } else if ( $is_resume_page ) { ?>
        <?php get_template_part( 'includes/resumes-sidebar-config.inc' ); ?>
        <?php if (class_exists('FacetWP') && !get_query_var('is_standard')) { ?>
          <?php get_template_part( 'includes/resume-facets.inc' ); ?>
        <?php } else { ?>
          <?php get_template_part( 'includes/resume-search.inc' ); ?>
          <?php get_template_part( 'includes/resume-filters.inc' ); ?>
        <?php } ?>
        <?php get_sidebar('resumes-master'); ?>
      <?php } else if ( $is_companies_page ) { ?>
        <?php get_template_part( 'includes/company-search.inc' ); ?>
        <?php get_sidebar('companies-master'); ?>
      <?php } else { ?>
        <?php get_sidebar('page'); ?>
      <?php } ?>

  </section>

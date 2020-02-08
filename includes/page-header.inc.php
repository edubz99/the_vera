<?php include(locate_template( 'includes/page-config.inc.php' )); ?>

<?php
  // Helper Variables
  $is_hero_with_sidebar = ($is_hero && $page_style == 'is_sidebar');
  $is_compact_template = is_page_template('template-compact.php');
?>
<?php if ($is_page_title) { ?>
  <?php if ( $is_job_page || $is_resume_page || !$is_hero || $is_hero_with_sidebar || $is_compact_template ) { ?>
    <section class="page-header">
      <div class="inner">
        <?php if (!$is_compact_template) { ?>
          <?php capstone_breadcrumbs(); ?>
        <?php } ?>
        <div class="page-title">
            <h1 class="primary"><?php echo wp_kses_post($header_title); ?></h1>
            <?php if ( $header_subtitle ) { ?>
              <p class="secondary"><?php echo wp_kses_post($header_subtitle); ?></p>
            <?php } ?>
        </div>
      </div>
    </section>
  <?php } ?>
<?php } ?>
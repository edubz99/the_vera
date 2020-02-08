<?php do_action('capstone_resumes_filters_start'); ?>
<?php 

  // Helper Variable(s)
  $resumes_filters_order = get_theme_mod( 'capstone_resumes_filters_order', array( 'resume_tags' ) );
	$resumes_filters_breakpoint = get_theme_mod( 'capstone_resumes_filters_breakpoint', 3 );

  // Check if filter is active-passive
  $is_resume_tags_passive = array_search('resume_tags', $resumes_filters_order) >= $resumes_filters_breakpoint ? 'true' : '';

?>
<div id="resumes-filters-module" class="resume_filters_dummy" data-filters-breakpoint="<?php echo esc_attr($resumes_filters_breakpoint); ?>">

  <?php if ( taxonomy_exists( 'resume_skill' ) && !is_tax( 'resume_skill' ) ) : ?>
    <?php
        // Helper Variable(s)
        $resume_skills = get_terms( array(
            'taxonomy' => 'resume_skill',
            'hide_empty' => true,
        ) );
    ?>
    <div class="resume_filter resume_tags_filter" data-is-passive="<?php echo esc_attr($is_resume_tags_passive); ?>">
      <h4 class="title"><?php esc_html_e('Skills', 'capstone'); ?></h4>
      <div class="resume_skills">
        <?php foreach ($resume_skills as $skill) : ?>
          <a href="<?php echo esc_url(get_term_link($skill->term_id, $skill->taxonomy)); ?>"><?php echo esc_html($skill->name); ?></a>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endif; ?>

  <?php get_template_part( 'includes/filters-toggle.inc' ); ?>

</div>
<?php do_action('capstone_resumes_filters_end'); ?>
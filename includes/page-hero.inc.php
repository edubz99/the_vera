<?php include(locate_template( 'includes/page-config.inc.php' )); ?>

<?php if ( $is_hero ) { ?>
  <section class="page-hero">

    <div class="inner">

      <div class="hero-title">
          <h1 class="primary"><?php echo wp_kses_post($hero_title); ?></h1>
          <?php if ( $hero_subtitle ) { ?>
            <p class="secondary"><?php echo wp_kses_post($hero_subtitle); ?></p>
          <?php } ?>
          <?php if ( $hero_button_text ) { ?>
            <a href="<?php echo esc_url($hero_button_link); ?>" class="button button-default"><?php echo wp_kses_post($hero_button_text); ?></a>
          <?php } ?>
      </div>

      <?php if ( $hero_enhancements && in_array('append_search', $hero_enhancements) && $hero_text_align != 'center' ) { ?>
        <div class="search-form">
          <div class="inner">
            <?php if ( class_exists('FacetWP') && ($hero_search_module == 'job' || $hero_search_module == 'resume') ) { ?>
              <?php get_template_part( 'includes/hero-facets.inc' ); ?> 
            <?php } else if ($hero_search_module == 'job' || $hero_search_module == 'resume' || $hero_search_module == 'company') { ?>
              <?php get_template_part( 'includes/'. $hero_search_module .'-search.inc' ); ?> 
            <?php } else { ?>
              <?php echo do_shortcode($hero_form_shortcode); ?> 
            <?php } ?>
          </div>
        </div>
      <?php } ?>

    </div>

  </section>
<?php } ?>
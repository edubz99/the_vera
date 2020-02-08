<style>
  #companies-search-module .field-keyword { order: 0 !important; } 
  #companies-search-module .field-location { order: 1 !important; } 
  #companies-search-module .choose-category { order: 2 !important; } 
  #companies-search-module .submit-field { order: 99 !important; } 
</style>


<?php do_action('capstone_companies_search_start'); ?>
<form id="companies-search-module" class="company_search company-search-fields" method="GET" action="<?php echo esc_url(get_permalink(get_theme_mod('capstone_companies_page_id'))); ?>">
  
  <div class="sortable">

    <!-- Keywords Field -->
    <p class="form-field form-control field-keyword first" data-order="0">
      <label for="search_keywords"><?php esc_html_e('Keyword', 'capstone'); ?></label>
      <input type="text" id="search_keywords_dummy" name="search_keywords" placeholder="<?php esc_attr_e('e.g. Amazon', 'capstone'); ?>" value="<?php echo esc_attr(get_query_var('search_keywords')); ?>" />
    </p>

    <!-- Location Field -->
    <p class="form-field form-control field-location last"  data-order="1" data-geolocation-method="<?php echo esc_attr(get_theme_mod('capstone_geolocation_method', 'html')); ?>">
      <label for="search_location"><?php esc_html_e('Location', 'capstone'); ?></label>
      <input type="text" id="search_location_dummy" name="search_location"  data-ip-address="<?php echo shortcode_exists( 'capstone_get_user_ip' ) ? esc_attr(do_shortcode('[capstone_get_user_ip]')) : ''; ?>" data-geolocation-api="<?php echo esc_attr(get_theme_mod('capstone_geolocation_api_key')); ?>" placeholder="<?php esc_attr_e('e.g. Washington', 'capstone'); ?>" value="<?php echo esc_attr(get_query_var('search_location')); ?>" />
      <?php if ( get_theme_mod('capstone_geolocation_api_key') ) { ?>
        <a class="get-location" href="#" data-balloon="<?php esc_html_e('Get Current Location', 'capstone'); ?>" data-balloon-pos="right"><img src="<?php echo esc_url( get_template_directory_uri() .'/images/gps.svg' ); ?>" alt="<?php esc_attr_e('Search Location', 'capstone'); ?>"></a>
      <?php  } ?>
    </p>

    <!-- Category Popup Field -->
    <p id="search_category_dummy" class="choose-category"  data-order="2">
      <a class="link" href="#taxonomy-job_listing_industry" data-term-id=""><span>+</span> <?php esc_html_e('Choose Industry', 'capstone'); ?></a>
      <span class="name"><?php echo get_query_var('search_industry') ? '('. esc_attr(get_query_var('search_industry')) .')' : ''; ?></span>
      <input type="hidden" name="search_industry" value="<?php echo esc_attr(get_query_var('search_industry')); ?>" />
    </p>

  </div>

  <!-- Submit Button Field -->
  <p class="form-field submit-field">
    <input class="button-default" type="submit" value="<?php esc_html_e('Search', 'capstone'); ?>" />
  </p>

  <!-- Form Caption -->
  <?php if ( get_option('capstone_companies_page_id') ) { ?>
    <p class="caption"><?php echo esc_html__('or go to', 'capstone'); ?> <a href="<?php echo esc_url(get_permalink(get_option('capstone_companies_page_id'))); ?>"><?php echo esc_html__('advanced search', 'capstone'); ?></a></p>
  <?php } ?>
</form>
<?php do_action('capstone_companies_search_end'); ?>
<?php 

// Helper Variable(s)
$resume_search_order = get_theme_mod( 'capstone_resumes_search_order', array( 'keywords', 'location', 'category_popup' ) );

$category_args = array(
	'show_option_all'    => esc_html__('All Categories', 'capstone'),
	'name'               => 'search_category',
	'id'                 => '',
	'class'              => 'postform',
  'taxonomy'           => 'resume_category',
  'selected'	         => esc_attr(get_query_var('search_category')),
);

?>

<style>
  #resumes-search-module .field-keyword { order: <?php echo esc_attr(array_search('keywords', $resume_search_order)); ?> !important; } 
  #resumes-search-module .field-location { order: <?php echo esc_attr(array_search('location', $resume_search_order)); ?> !important; } 
  #resumes-search-module .field-category { order: <?php echo esc_attr(array_search('category', $resume_search_order)); ?> !important; } 
  #resumes-search-module .choose-category { order: <?php echo esc_attr(array_search('category_popup', $resume_search_order)); ?> !important; } 
  #resumes-search-module .submit-field { order: 99 !important; } 
</style>

<?php do_action('capstone_resumes_search_start'); ?>
<form id="resumes-search-module" class="resume_search_dummy resume-search-fields" method="GET" action="<?php echo esc_url(get_post_type_archive_link('resume')); ?>">
  
  <div class="sortable">

    <!-- Keywords Field -->
    <?php if ( in_array('keywords', $resume_search_order)  ) { ?>
      <p class="form-field form-control field-keyword" data-order="<?php echo esc_attr(array_search('keywords', $resume_search_order)); ?>">
        <label for="search_keywords_dummy"><?php esc_html_e('Keywords', 'capstone'); ?></label>
        <input type="text" id="search_keywords_dummy" name="search_keywords" placeholder="<?php esc_attr_e('Enter Keywords', 'capstone'); ?>" value="<?php echo esc_attr(get_query_var('search_keywords')); ?>" />
      </p>
    <?php } ?>

    <!-- Location Field -->
    <?php if (in_array('location', $resume_search_order)) { ?>
      <p class="form-field form-control field-location" data-geolocation-method="<?php echo esc_attr(get_theme_mod('capstone_geolocation_method', 'html')); ?>" data-order="<?php echo esc_attr(array_search('location', $resume_search_order)); ?>">
        <label for="search_location_dummy"><?php esc_html_e('Location', 'capstone'); ?></label>
        <input type="text" id="search_location_dummy" name="search_location"  data-ip-address="<?php echo shortcode_exists( 'capstone_get_user_ip' ) ? esc_attr(do_shortcode('[capstone_get_user_ip]')) : ''; ?>" data-geolocation-api="<?php echo esc_attr(get_theme_mod('capstone_geolocation_api_key')); ?>" placeholder="<?php esc_attr_e('Enter Location', 'capstone'); ?>" value="<?php echo esc_attr(get_query_var('search_location')); ?>" />
        <?php if ( (get_theme_mod('capstone_geolocation_method', 'html') == 'ip' && get_theme_mod('capstone_geolocation_api_key')) || (get_theme_mod('capstone_geolocation_method', 'html') == 'html' && get_option('job_manager_google_maps_api_key')) ) { ?>
          <a class="get-location" href="#" data-balloon="<?php esc_html_e('Get Current Location', 'capstone'); ?>" data-balloon-pos="right"><img src="<?php echo esc_url( get_template_directory_uri() .'/images/gps.svg' ); ?>" alt="<?php esc_attr_e('Search Location', 'capstone'); ?>"></a>
        <?php } ?>
      </p>
    <?php } ?>

    <!-- Category Field -->
    <?php if ( taxonomy_exists('resume_category') && in_array('category', $resume_search_order)  ) { ?>
      <p class="form-field form-control field-category" data-order="<?php echo esc_attr(array_search('category', $resume_search_order)); ?>">
        <label for="search_category"><?php esc_html_e('Category', 'capstone'); ?></label>
        <?php wp_dropdown_categories($category_args); ?>
      </p>
    <?php } ?>

    <!-- Category Popup Field -->
    <?php if ( taxonomy_exists('resume_category') && in_array('category_popup', $resume_search_order) ) { ?>
      <p id="search_category_dummy" class="choose-category" data-order="<?php echo esc_attr(array_search('category_popup', $resume_search_order)); ?>">
        <a class="link" href="#taxonomy-resume_category" data-term-id=""><span>+</span> <?php esc_html_e('Choose Category', 'capstone'); ?></a>
        <span class="name"></span>
      </p>
    <?php } ?>

  </div>

  <!-- Submit Button Field -->
  <p class="form-field submit-field">
    <input class="button-default" type="submit" value="<?php esc_html_e('Search', 'capstone'); ?>" />
  </p>

  <!-- Form Caption -->
  <?php if ( get_option('resume_manager_resumes_page_id') ) { ?>
    <p class="form-caption caption"><?php echo esc_html__('or go to', 'capstone'); ?> <a href="<?php echo esc_url(get_permalink(get_option('resume_manager_resumes_page_id'))); ?>"><?php echo esc_html__('advanced search', 'capstone'); ?></a></p>
  <?php } ?>
</form>
<?php do_action('capstone_resumes_search_end'); ?>
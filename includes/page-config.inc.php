<?php
  
  // Post or Page ID
  if( is_home() || is_archive() || is_search() ) {
    $post_ID = get_option('page_for_posts');
  } else {
    $post_ID = get_the_ID();
  }

  // Page Identification
  $is_job_page = ( get_option('job_manager_jobs_page_id') && is_page(get_option('job_manager_jobs_page_id')) ) || is_post_type_archive('job_listing') || is_tax('job_listing_category') || is_tax('job_listing_tag') || is_tax('job_listing_type') || is_tax('job_listing_region') || is_tax('job_listing_industry');
  $is_job_archive_page = is_post_type_archive('job_listing');
  $is_job_taxonomy_page = is_tax('job_listing_category') || is_tax('job_listing_tag') || is_tax('job_listing_type') || is_tax('job_listing_region') || is_tax('job_listing_industry');
  
  $is_resume_page = ( get_option('resume_manager_resumes_page_id') && is_page(get_option('resume_manager_resumes_page_id')) ) || is_post_type_archive('resume') || is_tax('resume_category') || is_tax('resume_skill') || is_tax('resume_region');
  $is_resume_archive_page = is_post_type_archive('resume');
  $is_resume_taxonomy_page = is_tax('resume_category') || is_tax('resume_skill') || is_tax('resume_region');

  $is_companies_page = ( get_theme_mod('capstone_companies_page_id') && is_page(get_theme_mod('capstone_companies_page_id')) );
  $is_company_taxonomy_page = is_tax('job_listing_company');

  $is_registration_page = ( get_theme_mod('capstone_auth_register_page') && is_page(get_theme_mod('capstone_auth_register_page')) );
  $is_login_page = ( get_theme_mod('capstone_auth_login_page') && is_page(get_theme_mod('capstone_auth_login_page')) );
  $is_pass_recovery_page = ( get_theme_mod('capstone_auth_password_recovery_page') && is_page(get_theme_mod('capstone_auth_password_recovery_page')) );

  // Custom Header - Meta Panel - (Original)
  $page_style        = get_field('page_style', $post_ID);
  $header_text       = get_field('header_text', $post_ID);
  $header_title      = !empty($header_text['title']) ? $header_text['title'] : get_the_title();
  $header_subtitle   = !empty($header_text['subtitle']) ? $header_text['subtitle'] : '';
  $page_enhancements = get_field('page_enhancements', $post_ID);
  $is_page_title     = !in_array('disable_title', (array) $page_enhancements);

  // Custom Hero - Meta Panel - (Original)
  $is_hero        = get_field('is_hero', $post_ID);
  $hero_text      = get_field('hero_text', $post_ID);
  $hero_title     = !empty($hero_text['title']) ? $hero_text['title'] : get_the_title();
  $hero_subtitle  = !empty($hero_text['subtitle']) ? $hero_text['subtitle'] : '';
  $hero_button      = get_field('hero_button', $post_ID);
  $hero_button_text = !empty($hero_button['text']) ? $hero_button['text'] : '';
  $hero_button_link = !empty($hero_button['link']) ? $hero_button['link'] : '';
  $hero_text_align = get_field('hero_text_align', $post_ID);
  $hero_enhancements = get_field('hero_enhancements', $post_ID);
  $hero_search_module = get_field('hero_search_module', $post_ID);
  $hero_search_module = !empty($hero_search_module) ? $hero_search_module : 'job';
  $hero_form_shortcode = get_field('hero_custom_form_shortcode', $post_ID);

  // Override Variable(s) - Job Post Type
  if ( $is_job_taxonomy_page ) {
    $term_description  = wp_strip_all_tags(term_description());
    $header_title      = single_term_title('', false);
    $header_subtitle   = $term_description ? $term_description : sprintf( esc_html__( 'Showing jobs for the term "%s"', 'capstone' ), single_term_title('', false) );
  } else if ( $is_resume_taxonomy_page ) {
    $term_description  = wp_strip_all_tags(term_description());
    $header_title      = single_term_title('', false);
    $header_subtitle   = $term_description ? $term_description : sprintf( esc_html__( 'Showing resumes for the term "%s"', 'capstone' ), single_term_title('', false) );
  } else if ( $is_job_archive_page || $is_resume_archive_page ) {
    $header_title      = esc_html__('Search & Filter', 'capstone');
    $header_subtitle   = '';
  }

  // Override Variable(s) - Blog Post Type
  if( is_search() ) {
    $header_subtitle = esc_html__( 'Search Results', 'capstone' );
    $header_title = get_search_query();
  } else if( is_category() ) {
      $header_subtitle = esc_html__( 'Browsing Category', 'capstone' );
      $header_title = single_cat_title( '', false );
  } else if( is_tag() ) {
      $header_subtitle = esc_html__( 'Browsing Tag', 'capstone' );
      $header_title = single_tag_title( '', false );
  } else if( is_date() ) {
      $header_subtitle = esc_html__( 'Browsing Archive', 'capstone' );
      if ( is_day() ) {
          $header_title = get_the_date();
      } else if ( is_month() ) {
          $header_title = get_the_date( 'F Y' );
      } else {
          $header_title = get_the_date( 'Y' );
      }
  } else if( is_author() ) {
      $header_subtitle = esc_html__( 'Browsing Author', 'capstone' );
      $header_title = get_the_author();
  }


  // Content CSS Class
  switch ($page_style) {
    case 'is_sidebar':
      $layout_class = 'has-sidebar left-sidebar';
      break;
    case 'is_full_width':
      $layout_class = 'has-not-sidebar has-full-width';
      break;
    default:
      $layout_class = 'has-not-sidebar has-standard';
  }
<?php 
  // Helper Variable(s)
  // $is_jobs_activated = class_exists( 'WP_Job_Manager' );
  $is_jobs_activated = false;
  $search_archive_url = $is_jobs_activated ? get_post_type_archive_link('job_listing') : home_url('/');
  $search_query_var = $is_jobs_activated ? 'search_keywords' : 's';
  $search_post_type = $is_jobs_activated ? 'job_listing' : 'post';
  $form_unique_ID = rand(1, 999);
?>

<form method="get" id="search-form-<?php echo esc_attr($form_unique_ID); ?>" class="search-form" action="<?php echo esc_url( $search_archive_url ); ?>">
	<p><?php esc_html_e('News, updates, and stories search through them using form below.', 'capstone') ?></p>
	<div class="form-fields">
    <input type="text" placeholder="<?php echo esc_attr__('Search', 'capstone') ?>" name="<?php echo esc_attr($search_query_var); ?>" value="<?php echo esc_attr(get_query_var($search_query_var)); ?>">
    <input class="submit" value="<?php esc_attr_e('Go', 'capstone'); ?>" type="submit">
    <input type="hidden" name="post_type" value="<?php echo esc_attr($search_post_type); ?>" />
  </div>
</form>
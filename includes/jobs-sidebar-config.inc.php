<?php 

// Helper Variable(s)
$jobs_sidebar_order = get_theme_mod( 'capstone_jobs_sidebar_order', array( 'native_widgets', 'search_module', 'filters_module', 'alert_module' ) );
$jobs_filters_order = get_theme_mod( 'capstone_jobs_filters_order', array( 'job_types', 'job_tags', 'job_salary_range' ) );
$jobs_filters_breakpoint = get_theme_mod( 'capstone_jobs_filters_breakpoint', 3 );

// Demo Config
if (class_exists('FacetWP') && get_query_var('is_standard')) {
    $jobs_sidebar_order = array( 'native_widgets', 'search_module', 'filters_module', 'alert_module' );
}
?>

<style>
    /** Sidebar Modules */
    .page-sidebar .sidebar-modules #jobs-search-module { order: <?php echo esc_attr(array_search('search_module', $jobs_sidebar_order)); ?> !important; <?php echo in_array('search_module', $jobs_sidebar_order) ? '' : 'display: none !important;'; ?> } 
    .page-sidebar .sidebar-modules #jobs-filters-module { order: <?php echo esc_attr(array_search('filters_module', $jobs_sidebar_order)); ?> !important; <?php echo in_array('filters_module', $jobs_sidebar_order) ? '' : 'display: none !important;'; ?> } 
    .page-sidebar .sidebar-modules #jobs-facets-module { order: <?php echo esc_attr(array_search('facetwp_module', $jobs_sidebar_order)); ?> !important; } 
    .page-sidebar .sidebar-modules #jobs-alert-module { order: <?php echo esc_attr(array_search('alert_module', $jobs_sidebar_order)); ?> !important; <?php echo in_array('alert_module', $jobs_sidebar_order) ? '' : 'display: none !important;'; ?> } 
    .page-sidebar .sidebar-modules #widgets-module { order: <?php echo esc_attr(array_search('native_widgets', $jobs_sidebar_order)); ?> !important; <?php echo in_array('native_widgets', $jobs_sidebar_order) ? '' : 'display: none !important;'; ?> } 

    /** Filters Module */
    .page-sidebar .sidebar-modules #jobs-filters-module .jobs_types_filter { order: <?php echo esc_attr(array_search('job_types', $jobs_filters_order)); ?> !important; <?php echo in_array('job_types', $jobs_filters_order) ? '' : 'display: none !important;'; ?> } 
    .page-sidebar .sidebar-modules #jobs-filters-module .job_tags_filter { order: <?php echo esc_attr(array_search('job_tags', $jobs_filters_order)); ?> !important; <?php echo in_array('job_tags', $jobs_filters_order) ? '' : 'display: none !important;'; ?> } 
    .page-sidebar .sidebar-modules #jobs-filters-module .jobs_salary_filter { order: <?php echo esc_attr(array_search('job_salary_range', $jobs_filters_order)); ?> !important; <?php echo in_array('job_salary_range', $jobs_filters_order) ? '' : 'display: none !important;'; ?> } 
</style>
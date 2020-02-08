<?php 

// Helper Variable(s)
$resumes_sidebar_order = get_theme_mod( 'capstone_resumes_sidebar_order', array( 'native_widgets', 'search_module', 'filters_module' ) );
$resumes_filters_order = get_theme_mod( 'capstone_resumes_filters_order', array( 'resume_tags' ) );
$resumes_filters_breakpoint = get_theme_mod( 'capstone_resumes_filters_breakpoint', 3 );

// Demo Config
if (class_exists('FacetWP') && get_query_var('is_standard')) {
    $resumes_sidebar_order = array( 'native_widgets', 'search_module', 'filters_module' );
}
?>

<style>
    /** Sidebar Modules */
    .page-sidebar .sidebar-modules #resumes-search-module { order: <?php echo esc_attr(array_search('search_module', $resumes_sidebar_order)); ?> !important; <?php echo in_array('search_module', $resumes_sidebar_order) ? '' : 'display: none !important;'; ?> } 
    .page-sidebar .sidebar-modules #resumes-filters-module { order: <?php echo esc_attr(array_search('filters_module', $resumes_sidebar_order)); ?> !important; <?php echo in_array('filters_module', $resumes_sidebar_order) ? '' : 'display: none !important;'; ?> } 
    .page-sidebar .sidebar-modules #resumes-facets-module { order: <?php echo esc_attr(array_search('facetwp_module', $resumes_sidebar_order)); ?> !important; } 
    .page-sidebar .sidebar-modules #widgets-module { order: <?php echo esc_attr(array_search('native_widgets', $resumes_sidebar_order)); ?> !important; <?php echo in_array('native_widgets', $resumes_sidebar_order) ? '' : 'display: none !important;'; ?> } 

    /** Filters Module */
    .page-sidebar .sidebar-modules #resumes-filters-module .resume_tags_filter { order: <?php echo esc_attr(array_search('resume_tags', $resumes_filters_order)); ?> !important; <?php echo in_array('resume_tags', $resumes_filters_order) ? '' : 'display: none !important;'; ?> } 
</style>	

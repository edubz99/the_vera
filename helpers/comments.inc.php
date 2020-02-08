<?php

#-------------------------------------------------------------------------------#
#  Modify the comment date of the current comment
#-------------------------------------------------------------------------------#

	function capstone_comment_time_output($date, $d, $comment){
		return sprintf( esc_html_x( '%s ago', '%s = human-readable time difference', 'capstone' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) );
	}
	// add_filter('get_comment_date', 'capstone_comment_time_output', 10, 3);
	

#-------------------------------------------------------------------------------#
#  Disable URL field from comments form
#-------------------------------------------------------------------------------#

	function capstone_disable_comment_url($fields) { 
	    unset($fields['url']);
	    return $fields;
	}
	add_filter('comment_form_default_fields','capstone_disable_comment_url');
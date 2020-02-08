<?php
/**
 * Dashboard - Filters
 *
 * @since 1.0.0
 * @version 1.0.0
 */
?>

<?php
	// Helper Variable(s)
	$active_filter = pm_get_messages_showing();
	$all_filter_class = ($active_filter == 'all') ? 'active' : '';
	$starred_filter_class = ($active_filter == 'starred') ? 'active' : '';
	$unread_filter_class = ($active_filter == 'unread') ? 'active' : '';

?>

<div class="pm--filters">
	<ul class="pm-list--filters">
		<li class="pm-filter all-messages <?php echo esc_attr($all_filter_class); ?>"><a href="?pm_showing=all"><?php echo esc_html__('All Messages', 'capstone'); ?></a></li>
		<li class="pm-filter starred-messages <?php echo esc_attr($starred_filter_class); ?>"><a href="./?pm_showing=starred"><?php echo esc_html__('Starred Messages', 'capstone'); ?></a></li>
		<li class="pm-filter unread-messages <?php echo esc_attr($unread_filter_class); ?>"><a href="?pm_showing=unread"><?php echo esc_html__('Unread Messages', 'capstone'); ?></a></li>
	</ul>

	<?php echo pm_get_mark_all_as_read_link(); ?>
</div>

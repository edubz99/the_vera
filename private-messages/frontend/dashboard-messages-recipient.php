<?php
/**
 * Messages - User Info
 *
 * @since 1.0.0
 * @version 1.8.0
 */
?>

<div class="pm-userinfo">
	<p class="pm-userinfo__date">
		<span class="pm-userinfo__date-date"><?php echo date_i18n( get_option( 'date_format' ), strtotime( $thread->data->post_date ) ); ?></span>
	</p>

	<p class="pm-user__actions">
		<?php
			echo Private_Messages_Templates::get_template( 'frontend/dashboard-messages-actions-star.php', array(
				'starred' => $thread->is_starred(),
				'thread' => $thread,
			) );
			
			echo Private_Messages_Templates::get_template( 'frontend/dashboard-messages-actions-delete.php', array(
				'thread' => $thread,
			) );
		?>
	</p>
</div>

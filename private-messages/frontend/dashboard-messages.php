<?php echo Private_Messages_Templates::get_template( 'frontend/dashboard-filters.php' ); ?>

<h2 class="pm-section-title">
	<?php echo pm_get_messages_title(); ?>
</h2>

<?php if ( ! empty( $my_messages ) ) : ?>
	<table class="pm-table pm-table--messages-list">
		<tbody>
			<?php foreach ( $my_messages as $row ) : ?>
				<tr>
					<?php foreach ( $row as $key => $column ) : ?>
						<td class="pm-column pm-column--<?php echo esc_attr( $key ); ?>"><?php echo wp_kses_post($column); ?></td>
					<?php endforeach; ?>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php else : ?>
	<p class="pm-no-messages"><?php _e( 'No Messages', 'capstone' ); ?></p>
<?php endif; ?>


<?php if ( pm_can_compose_from_dashboard() ) : ?>
	<p class="pm-form__row pm-new-message-row">
		<a href="<?php echo esc_url( pm_get_new_message_url() ); ?>" class="button pm-button pm-button--new-message"><?php _e( 'New Message', 'capstone' ); ?></a>
	</p>
<?php endif; ?>

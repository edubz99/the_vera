<form class="job-manager-application-edit-form job-manager-form" method="post">

	<fieldset class="fieldset-status">
		<label for="application-status-<?php echo esc_attr( $application->ID ); ?>"><?php esc_html_e( 'Application status', 'capstone' ); ?>:</label>
		<div class="field">
			<select id="application-status-<?php echo esc_attr( $application->ID ); ?>" name="application_status">
				<?php foreach ( get_job_application_statuses() as $name => $label ) : ?>
					<option value="<?php echo esc_attr( $name ); ?>" <?php selected( $application->post_status, $name ); ?>><?php echo esc_html( $label ); ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</fieldset>

	<fieldset class="fieldset-rating">
		<label for="application-rating-<?php echo esc_attr( $application->ID ); ?>"><?php esc_html_e( 'Rating (out of 5)', 'capstone' ); ?>:</label>
		<div class="field">
			<input type="number" id="application-rating-<?php echo esc_attr( $application->ID ); ?>" name="application_rating" step="0.1" max="5" min="0" placeholder="0" value="<?php echo esc_attr( get_job_application_rating( $application->ID ) ); ?>" />
		</div>
	</fieldset>

	<p>
		<a class="delete_job_application" href="<?php echo esc_url(wp_nonce_url( add_query_arg( 'delete_job_application', $application->ID ), 'delete_job_application' ) ); ?>"><?php esc_html_e( 'Delete', 'capstone' ); ?></a>
		<input type="submit" name="wp_job_manager_edit_application" value="<?php echo esc_attr__( 'Save changes', 'capstone' ); ?>" />
		<input type="hidden" name="application_id" value="<?php echo absint( $application->ID ); ?>" />
		<?php wp_nonce_field( 'edit_job_application' ); ?>
	</p>
</form>
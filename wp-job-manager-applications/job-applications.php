<div id="job-manager-job-applications">
	<a href="<?php echo esc_url( add_query_arg( 'download-csv', true ) ); ?>" class="job-applications-download-csv"><?php esc_html_e( 'Download CSV', 'capstone' ); ?></a>
	<p><?php printf( wp_kses_post(__( 'The job applications for "%s" are listed below.', 'capstone' )), '<a href="' . esc_url( get_permalink( $job_id ) ) . '">' . get_the_title( $job_id ) . '</a>' ); ?></p>
	<div class="job-applications">
		<form class="filter-job-applications" method="GET">
			<p>
				<select name="application_status">
					<option value=""><?php esc_html_e( 'Filter by status', 'capstone' ); ?>...</option>
					<?php foreach ( get_job_application_statuses() as $name => $label ) : ?>
						<option value="<?php echo esc_attr( $name ); ?>" <?php selected( $application_status, $name ); ?>><?php echo esc_html( $label ); ?></option>
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<select name="application_orderby">
					<option value=""><?php esc_html_e( 'Newest first', 'capstone' ); ?></option>
					<option value="name" <?php selected( $application_orderby, 'name' ); ?>><?php esc_html_e( 'Sort by name', 'capstone' ); ?></option>
					<option value="rating" <?php selected( $application_orderby, 'rating' ); ?>><?php esc_html_e( 'Sort by rating', 'capstone' ); ?></option>
				</select>
				<input type="hidden" name="action" value="show_applications" />
				<input type="hidden" name="job_id" value="<?php echo absint( $_GET['job_id'] ); ?>" />
				<?php if ( ! empty( $_GET['page_id'] ) ) : ?>
					<input type="hidden" name="page_id" value="<?php echo absint( $_GET['page_id'] ); ?>" />
				<?php endif; ?>
			</p>
		</form>
		<?php global $wp_post_statuses; ?>
		<table class="job-manager-job-applications job-applications">
			<thead>
				<tr>
				    <th class="application_title"><?php esc_html_e('Title', 'capstone'); ?></th>
				    <th class="date"><?php esc_html_e('Date Posted', 'capstone'); ?></th>
				    <th class="status"><?php esc_html_e('Status', 'capstone'); ?></th>
				    <th class="rating"><?php esc_html_e('Rating', 'capstone'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ( $applications as $application ) : ?>
					<tr class="job-application" id="application-<?php echo esc_attr( $application->ID ); ?>">
						<td class="application_title"><?php job_application_header( $application ); ?></td>
						<td class="date"><?php echo wp_kses_post( date_i18n( get_option( 'date_format' ), strtotime( $application->post_date ) ) ); ?></td>
						<td class="status"><?php echo wp_kses_post($wp_post_statuses[ $application->post_status ]->label); ?></td>
						<td class="rating"><?php echo wp_kses_post(get_job_application_rating( $application->ID )); ?></td>
						<td class="content">
							<div id="detail-application-<?php echo esc_attr( $application->ID ); ?>" class="mfp-hide white-popup-block">
								<h2 class="title"><?php esc_html_e('Application Details', 'capstone'); ?></h2>
								<?php job_application_content( $application ); ?>
							</div>
							<div id="edit-application-<?php echo esc_attr( $application->ID ); ?>" class="mfp-hide white-popup-block">
								<h2 class="title"><?php esc_html_e('Edit Application', 'capstone'); ?></h2>
								<?php job_application_edit( $application ); ?>
							</div>
							<div id="notes-application-<?php echo esc_attr( $application->ID ); ?>" class="mfp-hide white-popup-block">
								<h2 class="title"><?php esc_html_e('Application Notes', 'capstone'); ?></h2>
								<?php job_application_notes( $application ); ?>
							</div>							
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<?php get_job_manager_template( 'pagination.php', array( 'max_num_pages' => $max_num_pages ) ); ?>
	</div>
</div>
<?php if ( is_user_logged_in() ) : ?>

	<fieldset>
		<label><?php _e( 'Your account', 'capstone' ); ?></label>
		<div class="field account-sign-in">
			<?php
				$user = wp_get_current_user();
				printf( __( 'You are currently signed in as <strong>%s</strong>.', 'capstone' ), $user->user_login );
			?>

			<a class="button" href="<?php echo apply_filters( 'submit_resume_form_logout_url', wp_logout_url( get_permalink() ) ); ?>"><?php _e( 'Sign out', 'capstone' ); ?></a>
		</div>
	</fieldset>

<?php else :

	$account_required             = resume_manager_user_requires_account();
	$registration_enabled         = resume_manager_enable_registration();
	$registration_fields          = resume_manager_get_registration_fields();
	?>
	<fieldset>
		<label><?php _e( 'Have an account?', 'capstone' ); ?></label>
		<div class="field account-sign-in">
			<a class="button" href="<?php echo apply_filters( 'submit_resume_form_login_url', wp_login_url( add_query_arg( array( 'job_id' => $class->get_job_id() ), get_permalink() ) ) ); ?>"><?php _e( 'Sign in', 'capstone' ); ?></a>

			<?php if ( $registration_enabled ) : ?>

				<?php _e( 'If you don&rsquo;t have an account you can create one below by entering your email address. Your account details will be confirmed via email.', 'capstone' ); ?>

			<?php elseif ( $account_required ) : ?>

				<?php echo apply_filters( 'submit_resume_form_login_required_message',  __( 'You must sign in to submit a resume.', 'capstone' ) ); ?>

			<?php endif; ?>
		</div>
	</fieldset>
	<?php
	if ( ! empty( $registration_fields ) ) { ?>
		<div class="account-info-fields">
			<h3 class="title"><?php esc_html_e('Account Information', 'capstone'); ?></h3>
			<div class="form-fields">
			<?php foreach ( $registration_fields as $key => $field ) { ?>
				<fieldset class="fieldset-<?php echo esc_attr( $key ); ?>">
					<label
						for="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $field[ 'label' ] ) . wp_kses_post( apply_filters( 'submit_resume_form_required_label', $field[ 'required' ] ? '' : ' <small>' . __( '(optional)', 'capstone' ) . '</small>', $field ) ); ?></label>
					<div class="field <?php echo esc_attr($field[ 'required' ]) ? 'required-field' : ''; ?>">
						<?php get_job_manager_template( 'form-fields/' . $field[ 'type' ] . '-field.php', array( 'key'   => $key, 'field' => $field ) ); ?>
					</div>
				</fieldset>
			<?php } ?>
			</div>
		</div>
		<?php
		do_action( 'resume_manager_register_form' );
	}
	?>

<?php endif; ?>

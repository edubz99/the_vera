<?php if ( $packages || $user_packages ) :
	$checked = 1;
	$subscribed_packages = array(); // CUSTOM CODE
	?>
	<ul class="job_packages">
		<?php if ( $user_packages ) : ?>
			<li class="package-section"><?php _e( 'Your Packages:', 'capstone' ); ?></li>
			<?php foreach ( $user_packages as $key => $package ) :
				$package = wc_paid_listings_get_package( $package );

				// CUSTOM CODE: START
				$package_repurchase = get_option('job_manager_disable_package_repurchase');
				if ($package_repurchase) {
					array_push($subscribed_packages, $package->get_product()->ID);
				}
				// CUSTOM CODE: END
				?>
				<li class="user-job-package">
					<input type="radio" <?php checked( $checked, 1 ); ?> name="job_package" value="user-<?php echo esc_attr($key); ?>" id="user-package-<?php echo esc_attr($package->get_id()); ?>" />
					<label for="user-package-<?php echo esc_attr($package->get_id()); ?>"><?php echo wp_kses_post($package->get_title()); ?></label><br/>
					<?php
					if ( $package->get_limit() ) {
						printf( _n( '%1$s job posted out of %2$d', '%1$s jobs posted out of %2$d', $package->get_count(), 'capstone' ), $package->get_count(), $package->get_limit() );
					} else {
						printf( _n( '%s job posted', '%s jobs posted', $package->get_count(), 'capstone' ), $package->get_count() );
					}

					if ( $package->get_duration() ) {
						printf( ', ' . _n( 'listed for %s day', 'listed for %s days', $package->get_duration(), 'capstone' ), $package->get_duration() );
					}

						$checked = 0;
					?>
				</li>
			<?php endforeach; ?>
		<?php endif; ?>
		<?php if ( $packages ) : ?>
			<li class="package-section"><?php _e( 'Purchase Package:', 'capstone' ); ?></li>
			<?php foreach ( $packages as $key => $package ) :
				$product = wc_get_product( $package );
				if ( ! $product->is_type( array( 'job_package', 'job_package_subscription' ) ) || ! $product->is_purchasable() ) {
					continue;
				}
				/* @var $product WC_Product_Job_Package|WC_Product_Job_Package_Subscription */
				if ( $product->is_type( 'variation' ) ) {
					$post = get_post( $product->get_parent_id() );
				} else {
					$post = get_post( $product->get_id() );
				}
				?>
				<?php if (!in_array($product->get_id(), $subscribed_packages)) { ?>
					<li class="job-package">
						<input type="radio" <?php checked( $checked, 1 );
						$checked = 0; ?> name="job_package" value="<?php echo esc_attr($product->get_id()); ?>" id="package-<?php echo esc_attr($product->get_id()); ?>" />
						<label for="package-<?php echo esc_attr($product->get_id()); ?>"><?php echo wp_kses_post($product->get_title()); ?></label><br/>
						<?php if ( ! empty( $post->post_excerpt ) ) :
							echo wp_kses_post($product->get_price_html());
							echo apply_filters( 'woocommerce_short_description', $post->post_excerpt );
						else :
							printf( _n( '%1$s for %2$s job', '%1$s for %2$s jobs', $product->get_limit(), 'capstone' ) . ' ', $product->get_price_html(), $product->get_limit() ? $product->get_limit() : __( 'unlimited', 'capstone' ) );
							echo wp_kses_post($product->get_duration()) ? sprintf( _n( 'listed for %s day', 'listed for %s days', $product->get_duration(), 'capstone' ), $product->get_duration() ) : '';
						endif; ?>
					</li>
				<?php } ?>

			<?php endforeach; ?>
		<?php endif; ?>
	</ul>
<?php else : ?>

	<p><?php _e( 'No packages found', 'capstone' ); ?></p>

<?php endif; ?>

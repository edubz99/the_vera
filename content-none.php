<?php if ( ( is_home() ) && current_user_can( 'publish_posts' ) ) : ?>

	<p class="no-content"><?php printf( wp_kses_post(__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'capstone' ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

<?php elseif ( is_search() ) : ?>

	<p class="no-content"><?php esc_html_e( 'Sorry, but nothing matched your search term. Please try again with some different keywords.', 'capstone' ); ?></p>

<?php else : ?>

	<p class="no-content"><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'capstone' ); ?></p>

<?php endif; ?>
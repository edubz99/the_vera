<?php
$parsed_url = parse_url( $link['url'] );
$host       = isset( $parsed_url['host'] ) ? current( explode( '.', $parsed_url['host'] ) ) : '';
?>
<li class="resume-link resume-link-<?php echo esc_attr( sanitize_title( $host ) ); ?>">
	<a rel="nofollow" href="<?php echo esc_url( $link['url'] ); ?>"><i class="<?php echo esc_attr( $link['name'] ); ?>"></i></a>
</li>
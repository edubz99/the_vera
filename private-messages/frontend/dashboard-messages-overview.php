<?php
/**
 *
 */
?>

<a href="<?php echo esc_url( $thread->get_url() ); ?>#message-<?php echo esc_attr( $last_message->ID ); ?>">
	<span class="title"><strong class="message__subject"><?php echo esc_attr( get_the_title( $thread->ID ) ); ?></strong> <em class="seperator"><?php echo esc_html__('by', 'capstone'); ?></em> <p class="message__author"><?php echo esc_attr( get_the_author_meta('display_name', $thread->author) ); ?></p></span><br />
	<span class="excerpt"><?php echo wp_kses_post($last_message->get_content( 10 )); ?></span>
</a>

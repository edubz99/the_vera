<?php

// Helper Variable(s)
$detail_page_url = get_option('page_for_posts') ? get_permalink(get_option('page_for_posts')) : home_url('/');
?>

<form id="blog-search-module" class="search-form" method="GET" action="<?php echo esc_url( home_url('/') ); ?>">
    <p class="form-field form-control field-keywords">
        <label for="s"><?php esc_html_e('Keywords', 'capstone'); ?></label>
        <input id="s" type="text" placeholder="<?php echo esc_html__('e.g. Hiring Tips', 'capstone'); ?>" name="s" value="<?php echo esc_attr(get_query_var('s')); ?>">
    </p>
    <input class="submit button" value="<?php esc_attr_e('Search', 'capstone'); ?>" type="submit">
    <p class="caption"><?php echo esc_html__('or go to', 'capstone'); ?> <a href="<?php echo esc_url($detail_page_url); ?>"><?php echo esc_html__('advanced search', 'capstone'); ?></a></p>
</form>
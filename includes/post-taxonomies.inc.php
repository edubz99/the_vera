<div class="inner">
    <div class="post-taxonomies">
        <?php if ( has_tag() ) { ?>
            <strong class="title"><?php esc_html_e('Tags:', 'capstone'); ?></strong>
            <?php the_tags( '<ul class="tags"><li>', '</li><li>', '</li></ul>' ); ?>
        <?php } else { ?>
            <strong class="title"><?php esc_html_e('Categories:', 'capstone'); ?></strong>
            <?php the_category(); ?> 
        <?php } ?>
    </div>

    <?php
        $defaults = array(
            'before'           => '<nav class="navigation pagination"><span class="screen-reader-text">' . esc_html__( 'Pages:', 'capstone' ) . '</span><div class="nav-links">',
            'after'            => '</div></nav>',
            'link_before'      => '<span class="page-numbers">',
            'link_after'       => '</span>',
        );
    ?>
    <?php wp_link_pages( $defaults ); ?>
</div>
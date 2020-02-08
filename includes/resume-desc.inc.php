<div class="entry-description">
    <?php do_action( 'single_resume_desc_before' ); ?>
        <div class="inner">
            <?php while( have_posts() ) : the_post(); ?>
                <?php $resume_description = apply_filters( 'the_resume_description', get_the_content() ); ?>
                <?php if ( $resume_description ) { ?>
                    <h3><?php echo esc_html__('Description', 'capstone'); ?></h3>
                    <?php echo apply_filters( 'the_resume_description', get_the_content() ); ?>
                <?php } ?>
            <?php endwhile; ?>
        </div>
    <?php do_action( 'single_resume_desc_after' ); ?>

</div>

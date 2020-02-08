<?php
    // Helper Variable(s)
    ob_start();
        do_action('single_resume_quick_meta_start');
        $single_resume_quick_meta_start = ob_get_contents();
    ob_end_clean();

    ob_start();
        do_action('single_resume_quick_meta_end');
        $single_resume_quick_meta_end = ob_get_contents();
    ob_end_clean();
?>

<?php do_action('capstone_resume_header_start'); ?>
<div class="entry-header">
    <div class="left">
        <div class="photo">
            <?php the_candidate_photo('capstone-listing-thumbnail'); ?>
        </div>
    </div>
    <div class="right">
        <div class="heading">
            <h1 class="title"><?php the_title(); ?></h1>
        </div>
        <?php if (!empty($single_resume_quick_meta_start) || !empty($single_resume_quick_meta_end)) { ?>
            <ul class="meta-info">
                <?php do_action( 'single_resume_quick_meta_start' ); ?>
                <?php do_action( 'single_resume_quick_meta_end' ); ?>
            </ul>
        <?php } ?>
        <?php
        if (has_term('', 'resume_skill')) {
            echo get_the_term_list( get_the_ID(), 'resume_skill', '<div class="taxonomy-terms">', null, '</div>' );
        } ?>
    </div>
</div>
<?php do_action('capstone_resume_header_end'); ?>
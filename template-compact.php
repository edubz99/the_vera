<?php 
/*
Template Name: Compact template
*/
?>

<?php get_header('compact'); ?>

    <main id="compact-body">

        <section class="page-content">
            <?php do_action('capstone_compact_content_start'); ?>

            <?php while( have_posts() ) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; ?>
            
            <?php do_action('capstone_compact_content_end'); ?>
        </section>   

    </main>

<?php get_footer('compact'); ?>
<?php 
/*
Template Name: Dashboard template
*/
?>

<?php get_header('dashboard'); ?>

  <main id="dashboard-body">
    
    <section id="manage-jobs" class="page-content">
        <h4 class="page-title"><?php the_title(); ?></h4>

        <?php do_action('capstone_dashboard_page_content_start'); ?>

        <div class="main-content">
          <?php while( have_posts() ) : the_post(); ?>
              <?php the_content(); ?>
          <?php endwhile; ?>
        </div>

			<?php do_action('capstone_dashboard_page_content_end'); ?>			

    </section>   

  </main>
<?php get_footer('dashboard'); ?>
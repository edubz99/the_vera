<section class="profile-module">
  <div class="candidate-info info">
    <h4 class="title"><?php esc_html_e('Contact Card', 'capstone'); ?></h4>
    <?php the_title( '<h2 class="candidate-name name">', '</h2>' ); ?>
    <?php the_candidate_title( '<p class="candidate-tagline tagline">', '</p>' ); ?>
  </div>
  <div class="candidate-meta meta-info">
    <?php the_resume_links(); ?>
    <a href="#contact-candidate" class="contact-candidate button-default"><?php esc_html_e('Contact Now', 'capstone'); ?></a>
  </div>
</section>
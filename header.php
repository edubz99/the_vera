<!DOCTYPE html>
<html <?php language_attributes(); ?>>

    <head>

        <!-- Basic Page Needs
        ================================================== -->
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        
        <!-- Mobile Specific Metas
        ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <!-- Pingback
        ================================================== -->
        <link rel="pingback" href="<?php esc_url( bloginfo('pingback_url') ); ?>" />

        <!-- WP Head
        ================================================== -->
        <?php wp_head(); ?>


    </head>

    <body <?php body_class(); ?>>

        <?php get_template_part( 'includes/preloader.inc' ); ?>

        <div id="site-container">
            <?php do_action('capstone_site_container_start'); ?>

            <header id="site-header">
                <?php do_action('capstone_site_header_start'); ?>

                <?php get_template_part( 'includes/site-notice.inc' ); ?>

                <div id="site-menu">

                    <div class="container">
                        <?php do_action('capstone_site_header_container_start'); ?>
                        
                        <?php get_template_part( 'includes/site-logo.inc' ); ?>

                        <?php 
                        $args = array(
                            'theme_location'  => 'capstone-primary-navigation',
                            'container'       => 'nav',
                            'container_id'    => 'site-navigation',
                            'menu_class'      => 'sf-menu',
                            'fallback_cb'     => ''
                        );

                        wp_nav_menu($args);
                        ?>

                        <span class="seperator"></span>

                        <?php get_template_part( 'includes/menu-icons.inc' ); ?>
                        <?php get_template_part( 'includes/cta-button.inc' ); ?>

                        <?php do_action('capstone_site_header_container_end'); ?>
                    </div>                    
                </div>

                <?php do_action('capstone_site_header_end'); ?>
            </header>
            <?php if(!is_front_page()) :?>
                <div class="fl-row fl-row-full-width fl-row-bg-none fl-node-5e4449d15d24a" data-node="5e4449d15d24a">
	<div class="fl-row-content-wrap">
						<div class="fl-row-content fl-row-full-width fl-node-content">
		
<div class="fl-col-group fl-node-5e4449d15d3bd" data-node="5e4449d15d3bd">
			<div class="fl-col fl-node-5e4449d15d41b" data-node="5e4449d15d41b">
	<div class="fl-col-content fl-node-content">
	<div class="fl-module fl-module-taxonomies-grid fl-node-5e4449d15d481 full-width-categories" data-node="5e4449d15d481">
	<div class="fl-module-content fl-node-content">
		      <section class="module-wrapper taxonomies-grid ">
      <div class="inner">
                                        <div class="taxonomy-term-119">
              <a href="http://thevenari.co.uk/job-category/business_services/">
                <img class="icon" src="http://thevenari.co.uk/wp-content/uploads/2019/05/suitcase.svg">
                <h4 class="title">Business Services</h4>
                <span class="count">2 jobs</span>
              </a>
            </div>
                                                            <div class="taxonomy-term-120">
              <a href="http://thevenari.co.uk/job-category/energy/">
                <img class="icon" src="http://thevenari.co.uk/wp-content/uploads/2020/02/energy-icon-1.png">
                <h4 class="title">Energy</h4>
                <span class="count">3 jobs</span>
              </a>
            </div>
                                                            <div class="taxonomy-term-117">
              <a href="http://thevenari.co.uk/job-category/engineering/">
                <img class="icon" src="http://thevenari.co.uk/wp-content/uploads/2020/02/engineering-icon-1.png">
                <h4 class="title">Engineering</h4>
                <span class="count">2 jobs</span>
              </a>
            </div>
                                                            <div class="taxonomy-term-118">
              <a href="http://thevenari.co.uk/job-category/technology/">
                <img class="icon" src="http://thevenari.co.uk/wp-content/uploads/2020/02/technology-icon-1.png">
                <h4 class="title">IT &amp; Technology</h4>
                <span class="count">4 jobs</span>
              </a>
            </div>
                                                            <div class="taxonomy-term-121">
              <a href="http://thevenari.co.uk/job-category/life-sciences/">
                <img class="icon" src="http://thevenari.co.uk/wp-content/uploads/2020/02/life-science-icon-1.png">
                <h4 class="title">Life Sciences</h4>
                <span class="count">2 jobs</span>
              </a>
            </div>
                                                            <div class="taxonomy-term-116">
              <a href="http://thevenari.co.uk/job-category/manufacturing/">
                <img class="icon" src="http://thevenari.co.uk/wp-content/uploads/2020/02/manufacturing-icon-1.png">
                <h4 class="title">Manufacturing</h4>
                <span class="count">2 jobs</span>
              </a>
            </div>
                          </div>
          </section>
  	</div>
</div>
	</div>
</div>
	</div>
		</div>
	</div>
</div>
<?php endif ?>

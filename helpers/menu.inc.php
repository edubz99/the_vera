<?php

#-------------------------------------------------------------------------------#
#  Bind Dashboard Menu Links with "+"
#-------------------------------------------------------------------------------#

    function capstone_bind_dashboard_menu_links($primary_page, $secondary_page, $item, $item_output) {
        if ($item->object == 'page') {
            $primary_page_id = get_theme_mod($primary_page);
            $secondary_page_id = get_theme_mod($secondary_page);
            $is_both_pages_set = $primary_page_id && $secondary_page_id;
            $is_current_item_relevant = ($item->object_id == $primary_page_id);

            if ( $secondary_page != 'manual' && ($is_both_pages_set && $is_current_item_relevant) ) {
                $menu_content = $item_output;
                $menu_content .= '<a href="'. esc_url(get_permalink($secondary_page_id)) .'" class="add-new '. esc_attr($secondary_page) .'">+</a>';
                return $menu_content;
            } else if ($secondary_page == 'manual' && $is_current_item_relevant && $primary_page_id) {
                if ($primary_page == 'capstone_dashboard_manage_alerts_page') {
                    $menu_content = $item_output;
                    $menu_content .= '<a href="'. esc_url(get_permalink($primary_page_id)) .'?action=add_alert" class="add-new">+</a>';
                    return $menu_content;
                } else {
                    return $item_output;
                }
            } else {
                return $item_output;
            }
        } else {
            return $item_output;
        }
    }

#-------------------------------------------------------------------------------#
#  Replaces items with '---' as title with li class="menu_separator"
#-------------------------------------------------------------------------------#

    add_filter('walker_nav_menu_start_el', 'capstone_nav_menu_start_el', 10, 4);

    function capstone_nav_menu_start_el($item_output, $item, $depth, $args) {

        // if dashboard nav area
        if ($args->theme_location == 'capstone-dashboard-primary-navigation' || $args->theme_location == 'capstone-dashboard-secondary-navigation') {
            $dashboard_pages_pairs = array(
                'capstone_dashboard_manage_jobs_page' => 'capstone_dashboard_submit_job_page',
                'capstone_dashboard_manage_resumes_page' => 'capstone_dashboard_submit_resume_page',
                'capstone_dashboard_manage_alerts_page' => 'manual',
            );
            foreach($dashboard_pages_pairs as $primary_page => $secondary_page){
                $item_output = capstone_bind_dashboard_menu_links($primary_page, $secondary_page, $item, $item_output);
            }
        }

        if ($item->url === '#divider') {
            return '<hr>'; // Horizontal line
        } elseif ($item->url === '#title') {
            return '<span class="title">'. esc_html($item->post_title) . '</span>'; // Text without link
        } elseif ($item->url === '#explore-menu') {
            ob_start();
            $menu_content  = '<a href="#" class="sf-with-ul">'. esc_html($item->post_title) . '</a>';
            $menu_content .= get_template_part( 'includes/menu-explore.inc' );
            $menu_content .= ob_get_clean();
            return $menu_content; // Text without link
        } else {
            if ($item->xfn) {
                $xfn_data = explode('-', $item->xfn);
                if ($xfn_data[0] == 'query') {
                    return $item_output = '<a href="'. esc_url($item->url) .'?'. $xfn_data[1].'='. $xfn_data[2] .'">'. esc_html($item->post_title) . '</a>';
                } else {
                    return $item_output; // Unmodified output for this link
                }
            } else {
                return $item_output; // Unmodified output for this link
            }
        }
    }
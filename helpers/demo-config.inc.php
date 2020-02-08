<?php
    // Helper Variable(s)
    $urlparts = parse_url(esc_url( home_url('/') ) );
    $domain = $urlparts['host'];
    // $allowed_domains = ['localhost', 'wpscouts.net', 'demo.wpscouts.net'];
    $allowed_domains = ['wpscouts.net', 'demo.wpscouts.net'];
    $demo_credentials = '';

    $is_demo_site = in_array($domain, $allowed_domains);
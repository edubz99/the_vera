// Export Functions
export default jQuery(document).ready( function($) {

    'use strict';

    // Functions Object
    var blog = {

        /** Recent Posts Title */
        recentPostsTitle: function() {
            var hasSticky = $('.posts-grid .type-post.sticky').length;

            var sectionTitle1 = $('#blog-headings .featured-news').clone();
            var sectionTitle2 = $('#blog-headings .recent-news').clone();
            var sectionTitle3 = $('#blog-headings .other-news').clone();
            
            if (hasSticky) {
                $('body.blog .posts-grid .post.sticky').first().before(sectionTitle1);
                $('body.blog .posts-grid .post:not(.sticky)').first().before(sectionTitle2);
            } else {
                $('body.blog .posts-grid .post:first-of-type').before(sectionTitle2);
            }
            $('body.blog .posts-grid[data-layout="magazine"] .post:first-of-type').after(sectionTitle3);
        },
        
        /** Load More */
        loadMore: function() {
            // defining some data (for 'infiniteScroll')
            var isLoadMore   = $('.posts-grid ~ .load-more').length;
            var $container 	 = $('.posts-grid');
            var item 		 = '.type-post';
            var loadMore 	 = '.load-more';
            var load_trigger = false;
            var templateStrings = $.parseJSON(capstone_args.translate_strings);

            if ( isLoadMore ) {

                // initialize the `infiniteScroll`
                $container.infiniteScroll({
                    append: item,
                    path: '.load-more a',
                    loadOnScroll: false,
                    button: loadMore,
                    status: '.page-load-status',
                });

                $container.on( 'request.infiniteScroll', function( event, path ) {
                    $('a', loadMore).html(templateStrings.loading + '...');
                });
                $container.on( 'load.infiniteScroll', function( event, response, path ) {
                    $('a', loadMore).html(templateStrings.load_more);
                });

            }

        },

        /** Blog Spotlight */
        spotlightSlider: function() {
            $('[data-slider="enable"]').flickity({
                wrapAround: true,
                arrowShape: 'M10.273,5.009c0.444-0.444,1.143-0.444,1.587,0c0.429,0.429,0.429,1.143,0,1.571l-8.047,8.047h26.554  c0.619,0,1.127,0.492,1.127,1.111c0,0.619-0.508,1.127-1.127,1.127H3.813l8.047,8.032c0.429,0.444,0.429,1.159,0,1.587  c-0.444,0.444-1.143,0.444-1.587,0l-9.952-9.952c-0.429-0.429-0.429-1.143,0-1.571L10.273,5.009z'
            });
        },

        /** Pingback Class */
        pingbackClass: function() {
            $('ol.comment-list li.pingback:last').addClass('last-pingback');

            $('ol.comment-list li.pingback:lt(99)').wrapAll('<div class="pingback-group" />');
        },

        /** Comments Navigation */
        commentsNav: function() {
            $('.comment-navigation .nav-links .nav-previous a').prepend('&#8592; ');
            $('.comment-navigation .nav-links .nav-next a').append(' &#10230;');
        },

        /** Wrap Comments Body with a Div */
        commentBody: function() {
            $('.comment .comment-body .comment-meta').each(function(){ 
                var $set = $(this).nextUntil('.reply');
                $set.wrapAll('<div class="comment-content" />');
            });
        },

        /** Identify Link Types */
        linkTypes: function() {
            $('#site-body .page-content a:not(:has(img, span, div)):not(.page-breadcrumbs a, #go-to-home, .module-wrapper a, .form-fields a, .entry-header a, .entry-actions a, .bookmark-notice, .comment-meta a, .comment-author a, .comment-body .reply a, .comment-reply-title a, .comment-navigation a, .pingback a, a.load_more_resumes, a.load_more_jobs, .meta-fields a, .logged-in-as a:first-of-type, .load-more a, .entry-header a, .entry-footer a, .fl-module-content a, table a, .checkout-button, .button.wc-backward, .nav-links a, .jmfe-custom-field-wrap a, .see-more, .package-section small a, .wp-block-button__link, .wp-block-cover-text a, .wp-block-file__button, .facetwp-reset, .facetwp-page)').addClass('text-link');
        }
        
    }  

    $(window).on('load', function() {
        blog.loadMore();
        blog.recentPostsTitle();
        blog.spotlightSlider();
        blog.pingbackClass();
        blog.commentsNav();
        blog.commentBody();
        blog.linkTypes();
    });

});
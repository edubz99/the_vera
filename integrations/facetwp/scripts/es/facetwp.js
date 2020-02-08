// Export Functions
export default jQuery(document).ready( function($) {

    'use strict';

    // Functions Object
    var facetWP = {

        /** Open Popup */
        submit: function() {
            $(document).on('click', '.fwp-submit', function() {
                var href = $(this).attr('data-href');
                window.location.href = href + window.location.search;
            });
        },

    }  

    $(window).on('load', function() {
        facetWP.submit();
    });

});
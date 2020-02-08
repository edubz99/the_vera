// Export Functions
export default jQuery(document).ready( function($) {

    'use strict';

    // Functions Object
    var alerts = {
        
        /** Load More */
        formClass: function() {
            $('#dashboard-body .job-manager-form input#alert_name').parents('form').attr('id', 'submit-alert-form');
            $('body').trigger('alertFormReady');
        },
    }  

    $(window).on('load', function() {
        alerts.formClass();
    });

});
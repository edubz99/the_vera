// Export Functions
export default jQuery(document).ready( function($) {

    'use strict';

    // Functions Object
    var dashboard = {

        /** Table Headers */
        tableHeaders: function() {

            // get all table rows in the tbody and loop through them
            $('table > tbody > tr > td').each(function(){
                var $td = $(this),
                    $th = $td.closest('table').find('th').eq($td.index()),
                    headerText = $th.text();
                    $td.attr('data-title', headerText);
            });

        },


        /** Private Message */
        privateMsg: function() {
            var templateStrings = $.parseJSON(capstone_args.translate_strings);

            // Insert "at" string in detail message view
            $('table.pm-table td.pm-column--message .pm-userinfo__date').each(function(){
                $('<em class="seperator">'+ templateStrings.at +'</em>').insertBefore(this);
            });

            // modify "delete thread/reply" text in master and detail view
            $('table.pm-table .pm-delete-reply, table.pm-table .pm-delete-thread span').each(function(){
                $(this).text(templateStrings.delete);
            });

            // identify "author" replies from other messages in detail view
            $('table.pm-table td.pm-column--message .pm-userinfo__author').each(function(){
                let msgAuthor = $(this).text();
                if (msgAuthor == capstone_args.user_display_name) {
                    $(this).parents('td.pm-column--message').addClass('author');
                }
            });

        },

        /** Add New Job Button */
        addNewJobButton: function() {
            let templateStrings = $.parseJSON(capstone_args.translate_strings);
            let newJobLink = $('#dashboard-primary-nav ul.nav-links li a.add-new.capstone_dashboard_submit_job_page').attr('href');
            let addJobButton = '<a href="'+ newJobLink +'" class="button">'+ templateStrings.add_new_job +'</a>';
            $('#dashboard-body .page-content #job-manager-job-dashboard').append(addJobButton);
        },

        /** Add New Resume Button */
        addNewResumeButton: function() {
            let templateStrings = $.parseJSON(capstone_args.translate_strings);
            let newResumeLink = $('#dashboard-primary-nav ul.nav-links li a.add-new.capstone_dashboard_submit_resume_page').attr('href');
            let addResumeButton = '<a href="'+ newResumeLink +'" class="button">'+ templateStrings.submit_resume +'</a>';
            $('#dashboard-body .page-content #resume-manager-candidate-dashboard').append(addResumeButton);
        },
        
    }  

    $(window).on('load', function() {
        dashboard.tableHeaders();
        dashboard.privateMsg();
        dashboard.addNewJobButton();
        dashboard.addNewResumeButton();
    });

});
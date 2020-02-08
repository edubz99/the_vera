// Export Functions
export default jQuery(document).ready( function($) {

    'use strict';

    // Functions Object
    var demo = {

        /** Disable Demo Links */
        disableActions: function() {
            var disableLinks = 'a.delete_note, .job-application-note-add input.button, a.delete_job_application, a.job-manager-bookmark-action-delete, a.job-dashboard-action-delete, a.job-dashboard-action-duplicate, a.job-dashboard-action-mark_filled, a.job-alerts-action-delete, a.job-alerts-action-toggle_status, a.job-alerts-action-email, a.candidate-dashboard-action-delete, a.candidate-dashboard-action-hide, a.pm-set-star, a.pm-delete-thread, a.pm-mark-all-as-read, a.pm-delete-reply';
            $(disableLinks, 'body.demo-logged-in').off('click'); // remove previous handlers
            $('body.demo-logged-in').on('click', disableLinks, function(e) {
                e.preventDefault();
                $('#not-allowed-notice').addClass('animate-in');
            });

            // hide href links URIs
            var blankLinks = 'a.delete_job_application, a.pm-set-star, a.pm-delete-thread, a.pm-mark-all-as-read, a.pm-delete-reply';
            $(blankLinks, 'body.demo-logged-in').attr('href', '#');

            // hide some attr value(s)
            $('body.demo-logged-in input[name="_wp_http_referer"]').attr('value', '');
        },

        /** Disable Demo Forms */
        disableSubmissions: function() {
            // Back-end Forms
            var disableDashboardForms = 'form.job-manager-application-edit-form, form#wppb-edit-user, form.pm-form--compose-message';
            $('body.demo-logged-in').on('submit', disableDashboardForms, function(e) {
                e.preventDefault();
                $('#not-allowed-notice').addClass('animate-in');
            });

            // Fron-end Forms
            var disableFronEndForms = 'form.job-manager-application-form, form.wp-job-manager-bookmarks-form';
            $('body.demo-site').on('submit', disableFronEndForms, function(e) {
                e.preventDefault();
                $('#not-allowed-notice').addClass('animate-in');
            });
        },

        /** Display Registration Notice */
        registrationNotice: function() {
            var formSelector = 'form#wppb-register-user';
            $('body.demo-site').on('submit', formSelector, function(e) {
                e.preventDefault();
                $.magnificPopup.open({
                    items: {
                        src: '#registration-notice',
                        type: 'inline'
                    },
                    closeMarkup: '<span title="%title%" class="mfp-close"><i class="fi fi-cancel" aria-hidden="true"></i></span>'
                });
            });
        },

        /** Display Login Notice */
        loginNotice: function() {

            // show login notice when dashboard links are clicked
            $('body.demo-site:not(.logged-in) li.is-dashboard a').off('click'); // remove previous handlers
            $('body.demo-site:not(.logged-in) li.is-dashboard a').magnificPopup({
                items: {
                    src: '#login-notice',
                    type: 'inline'
                },
                closeMarkup: '<span title="%title%" class="mfp-close"><i class="fi fi-cancel" aria-hidden="true"></i></span>'
            });

            // show login notice when submitting login form
            var formSelector = '#compact-body form#loginform';
            $('body.demo-site').on('submit', formSelector, function(e) {
                e.preventDefault();
                $.magnificPopup.open({
                    items: {
                        src: '#login-notice',
                        type: 'inline'
                    },
                    closeMarkup: '<span title="%title%" class="mfp-close"><i class="fi fi-cancel" aria-hidden="true"></i></span>'
                });
            });

        },

        /** Process Demo Login */
        demoLogin: function() {
            $('#login-notice, #registration-notice').on('click', '.buttons a.button', function (e) {
                e.preventDefault();

                let username = $(this).data('username');
                let password = $(this).data('password');

                $('#login-notice #loginform input#user_login').val(username);
                $('#login-notice #loginform input#user_pass').val(password);
                $('#login-notice #loginform').submit();
            });
        },

        /** Close Demo Notice */
        closeNotice: function() {
            $('.demo-notice').on('click', 'a.close', function(e) {
                e.preventDefault();
                $('body').removeClass('noscroll');
                $('.demo-notice').removeClass('animate-in');
            });
        },

        /** Count and Log Demo Login */
        countLogins: function() {
            $('#login-notice, #registration-notice', 'body.demo-site').on('click', '.buttons a.button', function (e) {
                e.preventDefault();
                let isEmployer = $(this).hasClass('employer');
                let isCandidate = $(this).hasClass('candidate');

                // Log Google Event (https://developers.google.com/analytics/devguides/collection/gtagjs/events)
                if (isEmployer && typeof ga === 'function') {
                    gtag('event', 'employer_login', {
                        'event_category' : 'login'
                    });
                } else if (isCandidate && typeof ga === 'function') {
                    gtag('event', 'candidate_login', {
                        'event_category' : 'login'
                    });
                }

            });
        },


    }  

    $(window).on('load', function() {
        demo.disableActions();
        demo.disableSubmissions();
        demo.registrationNotice();
        demo.loginNotice();
        demo.demoLogin();
        demo.closeNotice();
        demo.countLogins();
    });

});
// Export Functions
export default jQuery(document).ready( function($) {

    'use strict';

    // Functions Object
    var applications = {

        /** Change Heading */
        changeHeading: function() {
            let isApplicationsPage = $('#dashboard-body #manage-jobs #job-manager-job-applications').length;
            let templateStrings = $.parseJSON(capstone_args.translate_strings);

            if (isApplicationsPage) {
                $('#manage-jobs .page-title').html(templateStrings.manage_applications);
            }
        },
        

        /** Delete Application */
        deleteApplication: function() {
            $('body:not(.demo-logged-in)').on( 'click', 'a.delete_job_application', function() {
                var answer = confirm( job_manager_application.i18n_confirm_delete );
                if ( answer ) {
                    return true;
                }
                return false;
            });
        },

        /** Submit Notes */
        submitNotes: function() {
            $('body:not(.demo-logged-in)').on( 'click', '.job-application-note-add input.button', function() {
                var button                     = $(this);
                var application_id             = button.data('application_id');
                var job_application            = $(this).closest('#notes-application-' + application_id);
                var job_application_note       = job_application.find('textarea');
                var disabled_attr              = $(this).attr('disabled');
                var job_application_notes_list = job_application.find('ul.job-application-notes-list');
        
                if ( typeof disabled_attr !== 'undefined' && disabled_attr !== false ) {
                    return false;
                }
                if ( ! job_application_note.val() ) {
                    return false;
                }
        
                button.attr( 'disabled', 'disabled' );
        
                // prepare data object to submit
                var data = {
                    action: 		'add_job_application_note',
                    note: 			job_application_note.val(),
                    application_id: application_id,
                    security: 		job_manager_application.job_application_notes_nonce,
                };

                // submit data to ajax url
                $.post( job_manager_application.ajax_url, data, function( response ) {
                    job_application_notes_list.append( response );
                    button.removeAttr( 'disabled' );
                    job_application_note.val( '' );
                });
        
                return false;
            });
        },

        /** Delete Note */
        deleteNote: function() {
            $('body:not(.demo-logged-in)').on( 'click', 'a.delete_note', function() {
                var answer = confirm( job_manager_application.i18n_confirm_delete );
                if ( answer ) {
                    var button  = $(this);
                    var note    = $(this).closest('li');
                    var note_id = note.attr('rel');

                    // prepare data object to submit
                    var data = {
                        action: 		'delete_job_application_note',
                        note_id:		note_id,
                        security: 		job_manager_application.job_application_notes_nonce,
                    };
        
                    // submit data to ajax url
                    $.post( job_manager_application.ajax_url, data, function( response ) {
                        note.fadeOut( 500, function() {
                            note.remove();
                        }); 
                    });
                }
                return false;
            });
        },

        /** Job Posting File Upload */
        fileUpload: function() {
            $('.fieldset-application_attachment, .fieldset-upload-cv, .upload_field').each( function() {
                var $input   = $('.field input[type="file"]', this),
                    $label   = $('label', this),
                    labelVal = $label.html();

                $input.on('change', function(e) {
                    var fileName = '';

                    if( this.files && this.files.length > 1 ) {
                        fileName = this.files.length +' files selected';
                    } else if( e.target.value ) {
                        fileName = e.target.value.split( '\\' ).pop();
                    }

                    if (fileName) {
                        var $wrapper = $label.find('small');
                        if ($wrapper.length) {
                            $wrapper.html('('+ fileName +')');
                        } else {
                            $label.append('<small>('+ fileName +')</small>');
                        }
                    } else {
                        $label.html( labelVal );
                    }

                });

            });
        },

    }  

    $(window).on('load', function() {
        applications.changeHeading();
        applications.deleteApplication();
        applications.submitNotes();
        applications.deleteNote();
        applications.fileUpload();
    });

});
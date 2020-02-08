// Polyfill for IE 11
if (!Object.entries)
  Object.entries = function( obj ){
    var ownProps = Object.keys( obj ),
        i = ownProps.length,
        resArray = new Array(i); // preallocate the Array
    while (i--)
      resArray[i] = [ownProps[i], obj[ownProps[i]]];

    return resArray;
};

// Export Functions
export default jQuery(document).ready( function($) {

    'use strict';

    // Functions Object
    var jobListing = {

        /** Open Popup */
        popup: function() {
            $('.apply-job.is-modal, .job-application-toggle-edit, .job-application-toggle-content, .job-application-toggle-notes').magnificPopup({
                type: 'inline',
                closeOnBgClick: false,
                closeMarkup: '<span title="%title%" class="mfp-close"><i class="fi fi-cancel" aria-hidden="true"></i></span>'
            });
        },

        /** Scroll to Results */
        _scrollToResults: function() {
            $.smoothScroll({
                scrollElement: null,
                scrollTarget: 'ul.job_listings, .facetwp-template',
                offset: -100
            });
        },

        /** Job Listing Search */
        search: function() {
            // bind current context
            var self = this; 

            // Field refrences for original forms
            var $keywords = $('.job_filters #search_keywords');
            var $location = $('.job_filters #search_location');
            var $region   = $('.job_filters #search_region');
            var $category = $('.job_filters #search_categories');

            // Field refrences for dummy forms
            var $keywords_dummy = $('.page-sidebar .job_search_dummy #search_keywords_dummy');
            var $location_dummy = $('.page-sidebar .job_search_dummy #search_location_dummy');
            var $region_dummy   = $('.page-sidebar .job_search_dummy #search_region');
            var $type_dummy     = $('.page-sidebar .job_search_dummy #search_type');
            var $category_dummy = $('.page-sidebar .job_search_dummy #search_category');
            var $category_link_dummy = $('.page-sidebar .job_search_dummy #search_category_dummy');

            // Conditional Logic
            var hasJobListing = $('.page-content ul.job_listings').length;
            var hasJobSearch = $('.page-sidebar #jobs-search-module').length;

            if (hasJobListing && hasJobSearch) {

                // Trigger search in dummy form submit
                $('.page-sidebar .job_search_dummy').on('submit', function(e) {
                    e.preventDefault();

                    // trigger keyword change
                    $keywords.val( $keywords_dummy.val() );
                    $keywords.change();

                    // trigger location change
                    $location.val( $location_dummy.val() );
                    $location.change();

                    // trigger region change
                    $region.val( $region_dummy.val() );
                    if ( jQuery.isFunction( jQuery.fn.select2 ) ) {
                        $region.select2().trigger('change');
                    }
                    
                    // trigger category change
                    $category.val(''); // clear previous selection in multi-select
                    if ($category_dummy.length) {
                        if ($category_dummy.val() == 0) {
                            $category.find('option').attr('selected', false);
                        } else {
                            $category.find('option[value="'+ $category_dummy.val() +'"]').attr('selected', true);
                        }
                    } else if ($category_link_dummy.length) {
                        $category.find('option[value="'+ $('a.link', $category_link_dummy).attr('data-term-id') +'"]').attr('selected', true);
                    }
                    $category.change(); // required to display 'search completed' text on first search
                
                    // trigger type change
                    if ($type_dummy.length != 0) {
                        if ($type_dummy.val() == 0) {
                            $('.job_filters .job_types input[type="checkbox"]').prop('checked', true);
                            $('.job_filters .job_types input[type="checkbox"]').change();
                        } else {
                            $('.job_filters .job_types input[type="checkbox"]').prop('checked', false);
                            $('.job_filters .job_types #job_type_'+ $type_dummy.val()).prop('checked', true);
                            $('.job_filters .job_types #job_type_'+ $type_dummy.val()).change();
                        }
                    }

                    // scroll to results
                    self._scrollToResults();
                });
            }

        },


        /** Job Listing Filter */
        filters: function() {

            // Job Types
            $('.job_filters_dummy .job_types input[name="filter_job_type[]"]').change(function() {
                let originalTypeID = $(this).attr('id').replace('_dummy','');
                $('.job_filters #'+ originalTypeID).prop('checked', this.checked);
                $('.job_filters #'+ originalTypeID).change();
            });

            // Job Tags
            $('.job_filters_dummy .job_tags a').on('click', function (e) {
                e.preventDefault();
                var classID = $(this).attr('class').split(' ')[1];
                $(this).toggleClass('active');
                $('.job_filters .filter_by_tag a.'+ classID).trigger('click');
            });

        },

        /** Job Listing Reset */
        reset: function() {

            // Field refrences for dummy forms
            var $keywords = $('.job_search_dummy #search_keywords_dummy');
            var $location = $('.job_search_dummy #search_location_dummy');
            var $region   = $('.job_search_dummy #search_region');
            var $type     = $('.job_search_dummy #search_type');
            var $category = $('.job_search_dummy #search_category');
            var $category_link = $('.job_search_dummy #search_category_dummy');
            
            var $types    = $('.job_filters_dummy .job_types input[type="checkbox"]');
            var $tags     = $('.job_filters_dummy .job_tags a');

            // Dummy form interface triggers
            $('.job_filters .showing_jobs').on('click', '.reset', function() {
                $keywords.val('');
                $location.val('');
                $region.val('0');
                $type.val('0');
                $category.val('0');
                $('a.link', $category_link).attr('data-term-id', '');
                $('span.name', $category_link).html('');
                $types.prop('checked', true);
                $tags.removeClass('active');
            });

        },

        /** Job Listing */
        date: function() {

            // function to filter and modify date text
            function filterDate() {
                $('ul.job_listings li.job_listing ul.meta li.date time').each(function(){
                    var textOriginal = $(this).text().split(' ');
                    var textFiltered = textOriginal.filter(element => (element !== 'Posted') && (element !== 'on') )
                    var textNew = textFiltered.join(' ');
                    $(this).text(textNew);
                });
            }

            // filter date on ajax loading of the listing
            $('.job_listings').on('update_results updated_results load', function(e) {
                filterDate();
            });
            
            // filter date on non-ajax loading of the listing
            filterDate();
        },

        /** Load More */
        loadMore: function() {
            let templateStrings = $.parseJSON(capstone_args.translate_strings);
            $('.load_more_jobs').html(templateStrings.load_more);
        },

        /** Job Posting File Upload */
        fileUpload: function() {
            $('.fieldset-company_logo').each( function() {
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
                        $label.find('small').html('('+ fileName +')');
                    } else {
                        $label.html( labelVal );
                    }

                });

            });
        },

        /** Choose Category */
        chooseCategory: function() {
            let $jobCategoryPopup = $('#taxonomy-job_listing_category');
            
            // mark popup as "choose-only"
            $('.job_search_dummy #search_category_dummy a').on('click', function(e) {
                $jobCategoryPopup.addClass('choose-only');
            });

            // what do do when any term is clicked in popup
            $('ul li:not(.more-link) a', $jobCategoryPopup).on('click', function (e) {

                // proceed only of popup is opened to "select" category not to "open" it
                if ( !$(this).parents($jobCategoryPopup).hasClass('choose-only') ) {
                    return; // and treat it as normal link
                }

                // otherwise disable normal behaviour
                e.preventDefault();

                // grab selcted category meta info
                var termID = $(this).parent().data('term-id');
                var term = $(this).parent().data('term');
                
                // append selected category meta info to `+ Choose Category` link
                $('.job_search_dummy #search_category_dummy a.link').attr('data-term-id', termID);
                $('.job_search_dummy #search_category_dummy span.name').html('('+ term +')');
                
                // restore popup to normal state
                $jobCategoryPopup.removeClass('choose-only');

                // close the popup when category is selected
                $('.mfp-close', $jobCategoryPopup).trigger('click');
            });
        },

        /** Form DOM */
        formDOM: function() {
            let templateStrings = $.parseJSON(capstone_args.translate_strings);

            // wrap order summary section wih an extra dic
            $('#submit-job-form > fieldset:first-of-type').wrap('<div class="account-notification"></div>');
            
            // wrap SUBMIT JOB form submit button
            $('#submit-job-form .company-info-fields ~ p').wrap('<div class="submit-form-fields"></div>');
        
            // change listing details button text
            $('.job_listing_packages_title input[type="submit"]').val(templateStrings.select_package);
        },
       
        /** Open Popup */
        videoPopup: function() {
            $('a.company-video-link').magnificPopup({
                type: 'iframe',
                disableOn: 700,
                removalDelay: 160,
                preloader: false,
                fixedContentPos: true
            });
        },

        /** Submission Flow */
        submissionFlow: function() {
            let isSubmissionFlow = $('.submission-flow').length;

            if (isSubmissionFlow) {
                let isPackagesStep = $('#job_package_selection').length;
                let isListingDetailsStep = $('#submit-job-form').length || $('#submit-resume-form').length;
                let isListingPreviewStep = $('#job_preview').length || $('#resume_preview').length;
                
                if (isPackagesStep) {
                    $('.submission-flow ul li.choose-package').addClass('active');
                }
                if (isListingDetailsStep) {
                    $('.submission-flow ul li.listing-details').addClass('active');
                }
                if (isListingPreviewStep) {
                    $('.submission-flow ul li.preview-listing').addClass('active');
                }
            }
        },

        /** Handle Filters Visibility */
        filtersVisibility: function() {
            // enable 'filter toggle' if filters exceed breakpoint
            let isPassiveFilterExist = $('#jobs-filters-module > .job_filter[data-is-passive="true"]').length;
            if (isPassiveFilterExist) {
                $('#jobs-filters-module .filters_toggle').addClass('visible');
            }

            // handle 'filter toggle' click event
            $('#jobs-filters-module .filters_toggle').toggle(function() {
                $(this).removeClass('more-filters').addClass('less-filters');
                $('#jobs-filters-module > .job_filter[data-is-passive="true"]').addClass('is-visible');
            }, function() {
                $(this).removeClass('less-filters').addClass('more-filters');
                $('#jobs-filters-module > .job_filter[data-is-passive="true"]').removeClass('is-visible');
            });
        },

        /** Meta List - Single */
        metaList: function() {
            let isSingleJob = $('body').hasClass('single-job_listing');
            let isSingleResume = $('body').hasClass('single-resume');
            let isSingleCompany = $('body').hasClass('single-company');

            let maxFields;
            if (isSingleJob) {
                maxFields = capstone_args.single_job_meta_limit;
            } else if (isSingleResume) {
                maxFields = capstone_args.single_resume_meta_limit;
            } else if (isSingleCompany) {
                maxFields = capstone_args.single_company_meta_limit;
            } else {
                maxFields = 4;
            }
            let totalFields = $('.entry-meta ul.meta-fields li').length;

            $('.entry-meta .meta-link .count').html(totalFields);
            $('.entry-meta ul.meta-fields li:nth-child('+ maxFields +')').nextAll().addClass('is-hidden');
            
            if (totalFields > maxFields) {
                $('.entry-meta .meta-link').addClass('is-visible');

                $('.entry-meta .meta-link').toggle(function() {
                    $('.entry-meta ul.meta-fields li:nth-child('+ maxFields +')').nextAll().removeClass('is-hidden').addClass('is-visible');
                    $('.entry-meta .meta-link').addClass('expanded');
                }, function () {
                    $('.entry-meta ul.meta-fields li:nth-child('+ maxFields +')').nextAll().removeClass('is-visible').addClass('is-hidden');
                    $('.entry-meta .meta-link').removeClass('expanded');
                });
            }
        },

        /** Meta Icon */
        metaIcon: function() {
            $('.entry-header ul.meta-info li, .entry-meta ul.meta-fields li').each(function (item) {
                let iconSrc = $('.jmfe-custom-field-label', this).data('icon');
                if (iconSrc) {
                    $(this).prepend('<img src="'+ iconSrc +'" class="icon">');
                }
            });
            $('body').trigger('metaIconsReady');
        },

        /** More Actions */
        moreActions: function() {
            var $trigger = $('.entry-actions .trigger'),
                $dropdown = $('.entry-actions .dropdown');

            $trigger.on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                $dropdown.addClass('open');
            });
            $(document).on('click', function () {
                $dropdown.removeClass('open');
            });
            $('a', $dropdown).on('click', function () {
                $dropdown.removeClass('open');
            });
        },

        /** iCheck Fields */
        icheckFields: function() {

            $('fieldset').each(function() {
                // Checkbox Fields
                if ($(this).find('.icheckbox_square-blue').length > 0) {
                  $(this).add(this).addClass('icheck_field')
                }

                // Checkbox Fields - Multi
                if ($(this).find('.input-checklist').length > 0) {
                    $(this).add(this).addClass('multi')
                }

                // Radio Button Fields
                if ($(this).find('.iradio_square-blue').length > 0) {
                    $(this).add(this).addClass('iradio_field')
                }

                // WP Editor Field
                if ($(this).find('.wp-editor-wrap').length > 0) {
                    $(this).add(this).addClass('wp_editor_field')
                }

                // Range Slider Field
                if ($(this).find('input[type="range"]').length > 0) {
                    $(this).add(this).addClass('range_field')
                }

                // Upload File Field
                if ($(this).find('input[type="file"]').length > 0) {
                    $(this).add(this).addClass('upload_field')
                }

                // Terms Checklist Field
                if ($(this).find('.job-manager-term-checklist').length > 0) {
                    $(this).add(this).addClass('term_checklist_field')
                }

                // Date/Time Picker Fields
                if ($(this).find('.jmfe-fpdate-field, .jmfe-fptime-field').length > 0) {
                    $(this).add(this).addClass('date_time_field')
                }
  
            });

        },

        /** Company Selection */
        companySubmitTabs: function() {
            $('#company_term option:selected').val('0'); // FIX: To avoid "Select Company" value flicker

            // handle tab "activation" status
            $('#company-selection a').on('click', function(e) {
                e.preventDefault();
                $(this).siblings('a').removeClass('active');
                $(this).addClass('active');
            });
            
            // handle tabs when "no terms"
            $('#company-selection.no-terms a.new-company').on('click', function() {
                $('.company-info-fields').removeClass('existing').addClass('new');
                $('.company-info-fields .form-fields fieldset').removeClass('hidden');
                $('.company-info-fields .form-fields .fieldset-company_term').addClass('hidden');
                $('.company-info-fields .form-fields .no-terms-message').addClass('hidden');
            });
            $('#company-selection.no-terms a.existing-company').on('click', function() {
                $('.company-info-fields').removeClass('new').addClass('existing');
                $('.company-info-fields .form-fields fieldset').addClass('hidden');
                $('.company-info-fields .form-fields .no-terms-message').removeClass('hidden');
            });

            // handle tabs when "has terms"
            $('#company-selection.has-terms a.new-company').on('click', function() {
                $('#company_term').val(''); // remove "existing company" value
                if ( jQuery.isFunction( jQuery.fn.select2 ) ) {
                    $('#company_term').select2().trigger('change');
                }
                $('.company-info-fields').removeClass('existing').addClass('new');
                $('.company-info-fields .form-fields .fieldset-company_name').removeClass('hidden');
                $('.company-info-fields .form-fields .fieldset-company_term').addClass('hidden');
            });
            $('#company-selection.has-terms a.existing-company').on('click', function() {
                $('.company-info-fields').removeClass('new').addClass('existing');
                $('.company-info-fields .form-fields .fieldset-company_term').removeClass('hidden');
                $('.company-info-fields .form-fields .fieldset-company_name').addClass('hidden');
            });

        },

        /** Company Selection */
        companySelection: function() {
            // activate "existing company" tab if selected
            // var isBlank = $('#company_term').val() === '';
            // if (!isBlank) {
            //     $('#company-selection a.existing-company').trigger('click');
            // }

            // init 'select2' on company dropdown
            if ( jQuery.isFunction( jQuery.fn.select2 ) ) {
                $('#company_term').select2();
            }

            // on existing company selection
            $('#company_term').on('change', function(evt, params) {
                // remove previous values
                $('input, textarea', '.company-info-fields').val('');
                $('select:not(#company_term) option', '.company-info-fields').prop('selected', false).trigger('chosen:updated');
                $('input[type="checkbox"], input[type="radio"]', '.company-info-fields').prop('checked', false).iCheck('update');
                $('.mce-container-body iframe', '.company-info-fields').contents().find('[id="tinymce"]').html('');

                // get selected company ID
                var id = $(this).val();
                var text = $('option:selected', this).text();

                console.log(text);

                // make an ajax call to retrieve company data
                $.ajax({
                    url: capstone_args.ajaxurl,
                    type: "POST",
                    data: {
                        action: 'capstone_get_company_data',
                        id: id
                    },
                    success: function(result) {

                        if (result.data) {

                            // collect data from ajax request
                            let data = Object.entries(result.data);

                            // loop through each company meta field
                            for (let [key, value] of data) {
                                var selector = key.replace('_', '');
                                var $field = $('.company-info-fields [name="'+ selector +'"], .company-info-fields [name="'+ selector +'[]"]');

                                // console.log(`${selector}: ${value}`);

                                // append new values
                                if ( $field.is('textarea:hidden') ) { // wp editor field
                                    $('#'+ selector +'_ifr', '.company-info-fields').contents().find('[id="tinymce"]').html(value);
                                } else if ( $field.is('[type="radio"]') ) { // radio field
                                    $('#'+ selector +'-' + value).prop("checked", true);
                                    $field.iCheck('update');
                                } else if ( $field.is('[type="checkbox"]') ) { // checkbox field
                                    if ( $field.hasClass('input-checkbox') ) {
                                        // single checkbox
                                        $('#'+ selector).prop("checked", true);
                                    } else {
                                        // checkbox list
                                        value.forEach(function (item) {
                                            $('#'+ selector +'-' + item).prop("checked", true);
                                        });
                                    }
                                    $field.iCheck('update');
                                } else if ( $field.is('[multiple="multiple"]') ) { // multi-select field
                                    $field.val(value);
                                    $field.trigger('chosen:updated');
                                } else if ( $field.is('[type="range"]') ) { // range field
                                    $('#'+ selector).val(value);
                                    $('#'+ selector +'-output').val(value);
                                } else if ( $field.is('[type="file"]') ) { // file upload field
                                    // cannot set it dynamically due to browse security
                                } else { // all other fields
                                    $field.val(value); // only if settable with .val()
                                    $field.trigger('change');
                                }
                            }

                            // display "loaded" status
                            let templateStrings = $.parseJSON(capstone_args.translate_strings);
                
                            $('.fieldset-company_term .field .description').append('<span class="status success">'+ templateStrings.data_loaded +'</span>');
                            $('.fieldset-company_term .field .description .status').delay(3000).fadeOut(400, function(){
                                $(this).remove();
                            });

                        } else  {
                            console.log('Company is not assigned to any job.');
                            // append company name to the native field even -
                            // if compnay not assigned
                            $('#company_name').val(text);
                            $('#company_name').trigger('change');
                        }
                    },
                    fail: function(xhr, textStatus, errorThrown){
                        console.log('Ajax request for company data failed!');
                    }
                });

            });
        },

        /** FacetWP */
        facetWP: function() {

            // add labels to special fields
            $('body.job-listing-page .facetwp-facet, .hero-facets .facetwp-facet').each(function() {
                var $facet = $(this);
                var facet_name = $facet.attr('data-name');
                var facet_label = FWP.settings.labels[facet_name];
                var facet_type = $facet.attr('data-type');
    
                if ($facet.closest('.facet-wrap').length < 1 && $facet.closest('.facetwp-flyout').length < 1) {
                    $facet.wrap('<div class="facet-wrap big-field-wrap facet-'+ facet_type +'"></div>');
                    $facet.before('<h3 class="facet-label">' + facet_label + '</h3>');
                }
            });
        
        },

        /** Job Description */
        jobDescription: function() {
            var content = $('#job_description_ifr', '.job-info-fields').contents().find('[id="tinymce"]').html();
            var isBlank = $.trim(content) == '<p><br data-mce-bogus="1"></p>';
            if (isBlank) {
                var descTemplate = capstone_args.job_desc_template;
                $('#job_description_ifr', '.job-info-fields').contents().find('[id="tinymce"]').html(descTemplate);
            }
        },

    }  

    $(window).on('load', function() {
        jobListing.popup();
        jobListing.search();
        jobListing.filters();
        jobListing.reset();
        jobListing.date();
        jobListing.loadMore();
        jobListing.fileUpload();
        jobListing.chooseCategory();
        jobListing.formDOM();
        jobListing.videoPopup();
        jobListing.submissionFlow();
        jobListing.filtersVisibility();
        jobListing.metaList();
        jobListing.metaIcon();
        jobListing.moreActions();
        jobListing.icheckFields();
        jobListing.companySubmitTabs();
        jobListing.companySelection();
        jobListing.facetWP();
        jobListing.jobDescription();
    });

    $(document).on('facetwp-loaded', function() {
        var isHome = $('body').hasClass('home');
        var isJobListing = $('body').hasClass('job-listing-page');

        if (!isHome && isJobListing) {
            jobListing._scrollToResults();
            jobListing.date();
            jobListing.facetWP();
        }
    });

});
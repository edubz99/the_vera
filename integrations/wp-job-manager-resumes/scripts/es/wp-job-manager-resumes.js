// Export Functions
export default jQuery(document).ready( function($) {

    'use strict';

    // Functions Object
    var resumes = {

        /** Scroll to Results */
        _scrollToResults: function() {
            $.smoothScroll({
                scrollElement: null,
                scrollTarget: 'ul.resumes, .facetwp-template',
                offset: -100
            });
        },

        /** Open Popup */
        popup: function() {
            $('.contact-candidate').magnificPopup({
                type: 'inline',
                closeOnBgClick: false,
                closeMarkup: '<span title="%title%" class="mfp-close"><i class="fi fi-cancel" aria-hidden="true"></i></span>'
            });
        },

        /** Resume Listing Search */
        search: function() {
            // bind current context
            var self = this; 

            // Field refrences for original forms
            var $keywords = $('.resume_filters #search_keywords');
            var $location = $('.resume_filters #search_location');
            var $category = $('.resume_filters #search_categories');

            // Field refrences for dummy forms
            var $keywords_dummy = $('.page-sidebar .resume_search_dummy #search_keywords_dummy');
            var $location_dummy = $('.page-sidebar .resume_search_dummy #search_location_dummy');
            var $category_dummy = $('.page-sidebar .resume_search_dummy #search_category');
            var $category_link_dummy = $('.page-sidebar .resume_search_dummy #search_category_dummy');


            // Conditional Logic
            var hasResumeListing = $('.page-content ul.resumes').length;
            var hasResumeSearch = $('.page-sidebar #resumes-search-module').length;

            if (hasResumeListing && hasResumeSearch) {

                // Trigger search in dummy form submit
                $('.page-sidebar .resume_search_dummy').on('submit', function(e) {
                    e.preventDefault();

                    // trigger keyword change
                    $keywords.val( $keywords_dummy.val() );
                    $keywords.change();

                    // trigger location change
                    $location.val( $location_dummy.val() );
                    $location.change();

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

                    // scroll to results
                    self._scrollToResults();
                });
            }

        },

        /** Job Listing Reset */
        reset: function() {

            // Field refrences for dummy forms
            var $keywords = $('.resume_search_dummy #search_keywords_dummy');
            var $location = $('.resume_search_dummy #search_location_dummy');
            var $category = $('.resume_search_dummy #search_category');
            var $category_link = $('.resume_search_dummy #search_category_dummy');

            var $types    = $('.resume_filters_dummy .resume_types input[type="checkbox"]');
            var $tags     = $('.resume_filters_dummy .resume_tags a');

            // Dummy form interface triggers
            $('.resume_filters .showing_resumes').on('click', '.reset', function() {
                $keywords.val('');
                $location.val('');
                $category.val('0');
                $('a.link', $category_link).attr('data-term-id', '');
                $('span.name', $category_link).html('');
                $types.prop('checked', true);
                $tags.removeClass('active');
            });

        },

        /** Choose Category */
        chooseCategory: function() {
            let $resumeCategoryPopup = $('#taxonomy-resume_category');
            
            // mark popup as "choose-only"
            $('.resume_search_dummy #search_category_dummy a').on('click', function(e) {
                $resumeCategoryPopup.addClass('choose-only');
            });

            // what do do when any term is clicked in popup
            $('ul li:not(.more-link) a', $resumeCategoryPopup).on('click', function (e) {

                // proceed only of popup is opened to "select" category not to "open" it
                if ( !$(this).parents($resumeCategoryPopup).hasClass('choose-only') ) {
                    return; // and treat it as normal link
                }

                // otherwise disable normal behaviour
                e.preventDefault();

                // grab selcted category meta info
                var termID = $(this).parent().data('term-id');
                var term = $(this).parent().data('term');
                
                // append selected category meta info to `+ Choose Category` link
                $('.resume_search_dummy #search_category_dummy a.link').attr('data-term-id', termID);
                $('.resume_search_dummy #search_category_dummy span.name').html('('+ term +')');
                
                // restore popup to normal state
                $resumeCategoryPopup.removeClass('choose-only');

                // close the popup when category is selected
                $('.mfp-close', $resumeCategoryPopup).trigger('click');
            });

        },

        /** Job Posting File Upload */
        fileUpload: function() {
            $('.fieldset-candidate_photo, .fieldset-resume_file').each( function() {
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
        
        /** Load More */
        formDOM: function() {
            // wrap order summary section wih an extra dic
            $('#submit-resume-form fieldset:not([class^="fieldset-"])').wrap('<div class="account-notification"></div>');
        },

        /** Load More */
        loadMore: function() {
            let templateStrings = $.parseJSON(capstone_args.translate_strings);
            $('.load_more_resumes').html(templateStrings.load_more);
        },

        /** Handle Filters Visibility */
        filtersVisibility: function() {
            // enable 'filter toggle' if filters exceed breakpoint
            let isPassiveFilterExist = $('#resumes-filters-module > .resume_filter[data-is-passive="true"]').length;
            if (isPassiveFilterExist) {
                $('#resumes-filters-module .filters_toggle').addClass('visible');
            }

            // handle 'filter toggle' click event
            $('#resumes-filters-module .filters_toggle').toggle(function() {
                $(this).removeClass('more-filters').addClass('less-filters');
                $('#resumes-filters-module > .resume_filter[data-is-passive="true"]').addClass('is-visible');
            }, function() {
                $(this).removeClass('less-filters').addClass('more-filters');
                $('#resumes-filters-module > .resume_filter[data-is-passive="true"]').removeClass('is-visible');
            });
        },

        /** FacetWP */
        facetWP: function() {

            // add labels to special fields
            $('body.resume-listing-page .facetwp-facet').each(function() {
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

        /** Resume Description */
        resumeDescription: function() {
            var content = $('#resume_content_ifr', '.resume-info-fields').contents().find('[id="tinymce"]').html();
            var isBlank = $.trim(content) == '<p><br data-mce-bogus="1"></p>';
            if (isBlank) {
                var descTemplate = capstone_args.resume_desc_template;
                $('#resume_content_ifr', '.resume-info-fields').contents().find('[id="tinymce"]').html(descTemplate);
            }
        },

    }  

    $(window).on('load', function() {
        resumes.popup();
        resumes.search();
        resumes.reset();
        resumes.chooseCategory();
        resumes.fileUpload();
        resumes.formDOM();
        resumes.loadMore();
        resumes.filtersVisibility();
        resumes.facetWP();
        resumes.resumeDescription();
    });

    $(document).on('facetwp-loaded', function() {
        var isHome = $('body').hasClass('home');
        var isResumeListing = $('body').hasClass('resume-listing-page');

        if (!isHome && isResumeListing) {
            resumes._scrollToResults();
            resumes.facetWP();
        }
    });

});
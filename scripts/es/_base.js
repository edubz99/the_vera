// Export Functions
export default jQuery(document).ready( function($) {

    'use strict';

    // Functions Object
    var base = {

        /** Site Prloader */
        sitePreloader: function() {

            let hasPreloader = $('body').hasClass('preload');

            if (hasPreloader) {
                $('body').on('formsLoaded', function() {
                    $('.preloader').fadeOut(function() {
                        $('body').removeClass('preload');
                    });
                });
            }

        },

        /** Detect Screen Size */
        detectDevice: function() {

            var $window = $(window), $html = $('html');
    
            function initScreenClass() {
                setTimeout(function (){
                    if ($window.width() < 1201) {
                        $html.removeClass('screen-view');
                        $html.addClass('touch-view');
                        $('body').trigger('initTouchView');
                    } else {
                        $html.removeClass('touch-view');
                        $html.addClass('screen-view');
                        $('body').trigger('initScreenView');
                    }
                }, 600);
            }

            initScreenClass();
            $window.on('resize', function() {
                initScreenClass();
            });
        
        },

        /** Sticky Header */
        stickyHeader: function() {

            let headerStickness = capstone_args.header_stick_config;

            if (headerStickness != 'headroom--disabled') {
                $("#site-header").headroom({
                    tolerance : {
                        up : 5,
                        down : 5
                    },
                    onPin : function() {
                        $("#site-header").removeClass('bring-back');
                    },
                    onUnpin : function() {
                        setTimeout(function (){
                            $("#site-header").addClass('bring-back');
                        }, 600);
                    },
                    classes : {
                        // when scrolling down
                        unpinned : headerStickness,
                    },
                });
            }
        },

        /** Site Menu */
        desktopSiteMenu: function() {

            // Disable page jump on hash link click
            $("#site-header #site-menu ul.sf-menu > li > a[href*=#]").click(function(e) {
                e.preventDefault();
            });  

            // Main Menu (on desktop)
            $('html.screen-view ul.sf-menu:not(.icons-nav)').superfish({
                animation: { opacity: 'show', top: "190%", display: 'flex' },
                animationOut: { opacity:'hide', top: "260%" },
                speed: 'fast',
                delay: 600,
                onBeforeShow: function() {
                    $(this).addClass('flex-item');
                },
                onHide: function() {
                    $(this).removeClass('flex-item');
                },
                onShow: function () {
                    // set list container height
                    let listHeights = [];
                    $('> li > ul.tab-content', this).each(function (index, item) {
                        let height = $(item).outerHeight();
                        listHeights.push(height);
                    });
                    let maxListHeight = Math.max.apply(Math, listHeights);
                    $(this).css('height', maxListHeight);
                    $('> li > ul.tab-content', this).css('height', maxListHeight);

                    // activate first tab
                    $('> li:nth-child(2)', this).not($('ul.tab-content > li')).addClass('sfHover');

                    // mark explore menus as 'have children'
                    if ( $(this).hasClass('tabbed-menu') ) {
                        $(this).parent().addClass('menu-item-has-children');
                    }
                }
            });

            // Disable "Explore Menu" Tab Link Click
            $('html.screen-view #site-header #site-menu ul.tabbed-menu > li > a, .disable-link > a, a.disable-link').on('click', function(e) {
                e.preventDefault();
            });

        },

        /** Identify Menus */
        indentifyMenus: function() {

            // Uniquely identfy icons menu child
            $('ul.icons-nav li.hamburger ul.sub-menu').each(function (index, item) {
                $(this).addClass('mobile-menu-child');
            });
            
            // Uniquely identfy icons menu child
            $('ul.mobile-menu li a.sf-with-ul').each(function (index, item) {
                let hasChildClass = $(this).parent('li').hasClass('menu-item-has-children');
                if (!hasChildClass) {
                    $(this).parent('li').addClass('menu-item-has-children')
                }
            });

            // Init "Tendina" on "Hamburger Menu"
            $('body').on('onMenuOpen', function () {
                $('ul.mobile-menu').tendina({
                    speed: 400,
                });
            });

        },

        /** Icons Menu */
        desktopIconsMenu: function() {

            // Remove class added in "touchView"
            $('#search-module').removeClass('mfp-hide');
            $('body').removeClass('noscroll');

            // Icons Menu (on desktop)
            $('html.screen-view ul.icons-nav, #dashboard-container ul.icons-nav').superfish({
                animation: { opacity: 'show', top: "160%" },
                animationOut: { opacity:'hide', top: "230%" },
                speed: 'fast',
                delay: 600,
            });

            // Disable click on 'search' and 'account' menu items
            $('li.search > a, li.account > a', 'html.screen-view ul.icons-nav ').off('click');
            $('li.search > a, li.account > a', 'html.screen-view ul.icons-nav ').on('click', function (e) {
                e.preventDefault();
            }); 

        },

        /** Mobile Menus */
        mobileMenus: function() {
    
            // destroy superfish on "Main Menu" + "Icons Menu"
            $('html ul.icons-nav').superfish('destroy');
            $('html ul.sf-menu:not(.icons-nav)').superfish('destroy');

            // Init "Hamburger Menu"
            $('html.touch-view ul.icons-nav li.hamburger > a').toggle(function(e) {
                e.preventDefault();
                $('body').addClass('noscroll');
                $(this).addClass('open');
                $('#mobile-menu-module').removeClass('animate-out').addClass('animate-in');
                $('body').trigger('onMenuOpen');
            }, function() {
                $('body').removeClass('noscroll');
                $(this).removeClass('open');
                $('#mobile-menu-module').removeClass('animate-in').addClass('animate-out');
            });

            // Init "Search Popup"
            $('html.touch-view ul.icons-nav > li.search > a').magnificPopup({
                type: 'inline',
                closeOnBgClick: true,
                closeMarkup: '<span title="%title%" class="mfp-close"><i class="fi fi-cancel" aria-hidden="true"></i></span>',
                disableOn: function() {
                    if( $(window).width() < 1201 ) {
                      return true;
                    }
                    return false;
                }
            });

        },

        /** Taxonomy Popup */
        taxonomyPopup: function() {
            $('#explore-menu .more-link > a, .choose-category > a, .taxonomies-grid .more-link > a').magnificPopup({
                type: 'inline',
                closeOnBgClick: false,
                closeMarkup: '<span title="%title%" class="mfp-close"><i class="fi fi-cancel" aria-hidden="true"></i></span>'
            });
        },

        /** Video Lightbox */
        videoLightBox: function() {
            $('.popup-video.fl-module .fl-photo-content > a').magnificPopup({
                disableOn: 700,
                type: 'iframe',
                mainClass: 'mfp-fade',
                removalDelay: 160,
                preloader: false,
                fixedContentPos: false
            });
        },
        
        /** Dynamic Menu Strings */
        dynamicMenuStrings: function() {

            // Append username if {{username}} tag found
            $('ul.icons-nav li span.title').each(function (index, item) {
                let usernameTag = '{{username}}';
                let titleString = $(this).text().toLowerCase();
                let isUsernameTag = titleString.indexOf(usernameTag) >= 0;

                if (isUsernameTag) {
                    let newString = titleString.replace(usernameTag, capstone_args.user_display_name);
                    $(this).text(newString);
                }
            });
            
            // Append username if {{username}} tag found
            $('ul.icons-nav li a[href="#logout-link"]').each(function (index, item) {
                $(this).attr('href', capstone_args.logout_url);
            });

        },

        /** Site Notification */
        siteNotification: function() {

			// initial postion on page load
			$('#page-controls .page-control.notification, a[href^="#trigger-notification"]').on( 'click' , function(e) {
				e.preventDefault();
				$('#site-notice').addClass('animate-in');
			});

			// initial postion on page load
			$('.site-notice .close').on( 'click' , function(e) {
				e.preventDefault();
				$('.site-notice').removeClass('animate-in');
			});

        },

        /** animate on scroll */
        scrollToTop: function(){

            // initial postion on page load
            $(document).ready(function(){
                $(this).scrollTop(0);
            });

            // visibility of arrow
            $(window).on( 'scroll' , function() {
                if ($(window).scrollTop() >= 300) {
                    $('#social-share, #page-controls').addClass('animate-in');
                } else {
                    $('#social-share, #page-controls').removeClass('animate-in');
                }
            });

            // go to top click handler
            $('a.go-to-top').on('click', function() {
                $.smoothScroll({
                    scrollElement: null,
                    scrollTarget: '#site-container'
                });
            });
        },

        /** Get User Location */
        getUserLocation: function() {
            let geolocationMethod = $('.field-location').attr('data-geolocation-method');
            let locationMask = capstone_args.location_field_mask;
            var templateStrings = $.parseJSON(capstone_args.translate_strings);

            if (geolocationMethod == 'ip') {
                $('.form-field .get-location').on('click', function(e) {
                    e.preventDefault();
                    var $self = $(this);
    
                    let corsFix = 'http://cors.io/?'
                    let apiKey = $('#search_location_dummy').data('geolocation-api')
                    let ipAddress = $('#search_location_dummy').data('ip-address')
    
                    // resource: https://ahmadawais.com/best-api-geolocating-an-ip-address/
    
                    $.get(`https://api.ipdata.co/${ipAddress}?api-key=${apiKey}`, function (data) {
                        var country = data.country_name;
                        var region = data.region;
                        var city = data.city;
                        $self.siblings('#search_location_dummy').val(eval('`'+ locationMask +'`'));   
                    }, 'jsonp');
    
                });
            } else {
                $('.form-field .get-location').on('click', function(e) {
                    e.preventDefault();
                    var $self = $(this);
                    
                    if (navigator.geolocation) {
                        // Success Function
                        function showPosition(position) {
                            let latitude = position.coords.latitude;
                            let longitude = position.coords.longitude;
                            var geocoder = new google.maps.Geocoder;

                            geocodeLatLng(geocoder);

                            function geocodeLatLng(geocoder) {
                                var latlng = {lat: parseFloat(latitude), lng: parseFloat(longitude)};
                                geocoder.geocode({'location': latlng}, function(results, status) {
                                    // console.log(results);

                                    if (status === 'OK') {
                                        if (results[7]) {
                                            var country = results[7].address_components[2].long_name;
                                            var region = results[7].address_components[1].long_name;
                                            var city = results[7].address_components[0].long_name;
                                            $self.siblings('#search_location_dummy').val(eval('`'+ locationMask +'`'));   
                                        } else {
                                            window.alert('No results found');
                                        }
                                    } else {
                                        window.alert('Geocoder failed due to: ' + status);
                                    }
                                });
                            }
                        }

                        // Define callback function for failed attempt
                        function errorCallback(error) {
                            if (error.code == 1){
                                alert(templateStrings.geocode_error_permission);
                            } else if (error.code == 2) {
                                alert(templateStrings.geocode_error_network);
                            } else if (error.code == 3) {
                                alert(templateStrings.geocode_error_timeout);
                            } else {
                                alert(templateStrings.geocode_error_generic);
                            }
                        }
                        
                        // Get the user's current position
                        navigator.geolocation.getCurrentPosition(showPosition, errorCallback);
                    } else {
                        alert(templateStrings.geocode_error_support);
                    }
                });

            }

        },        

        /** Testimonials Slider */
        testimonials: function() {
            $('.main-carousel').flickity({
                // options
                wrapAround: true,
                prevNextButtons: false,
              });
        },

        /** Copy Permalink */
        copyPermalink: function() {

            var copyToClipboard = function(elementId) {

                var input = document.getElementById('page-permalink');
                var isiOSDevice = navigator.userAgent.match(/ipad|iphone/i);
            
                if (isiOSDevice) {
                  
                    var editable = input.contentEditable;
                    var readOnly = input.readOnly;
            
                    input.contentEditable = true;
                    input.readOnly = false;
            
                    var range = document.createRange();
                    range.selectNodeContents(input);
            
                    var selection = window.getSelection();
                    selection.removeAllRanges();
                    selection.addRange(range);
            
                    input.setSelectionRange(0, 999999);
                    input.contentEditable = editable;
                    input.readOnly = readOnly;
            
                } else {
                     input.select();
                }
            
                document.execCommand('copy');
            }
            

            $('.field-group a.copy-permalink').on('click', function() {
                let permalinkField = $(this).siblings('input[type="text"]');
                let copiedText = $(this).data('copied-text');
                copyToClipboard();
                $(this).text(copiedText);
            });
        },

        
        /** Dynamic Top Offset for Misc Elements */
        dynamicTopOffset: function() {
            var adminBarHeight = $('#wpadminbar').height();
            var siteHeaderHeight = $('#site-header').height();
            var totalHeaderHeight = (adminBarHeight && siteHeaderHeight) ? adminBarHeight + siteHeaderHeight : (siteHeaderHeight) ? siteHeaderHeight : adminBarHeight;

            $('#site-notice').css('top', (20 + adminBarHeight) +'px');
            $('#mobile-menu-module').css('top', siteHeaderHeight +'px');
            $('body.noscroll:before').css('top', totalHeaderHeight +'px');
        },

        /** Modern Form */
        modernForms: function() {
            var formSelectors = '#submit-job-form, #submit-resume-form, #submit-alert-form, .apply_with_resume, #wppb-edit-user, #wppb-register-user, #wppb-login-wrap [name="loginform"], .job-manager-application-form, .wp-job-manager-bookmarks-form, .job-manager-application-edit-form, .woocommerce-checkout, .rcp_form, .pm-form, #wppb-recover-password, .woocommerce-form-login, .woocommerce-EditAccountForm, .woocommerce-MyAccount-content > form';
            
            // add class on init
            $(formSelectors).addClass('modern-form');
            $('body').trigger('formsLoaded');

            // add class on alertFormReady
            $('body').on('alertFormReady', function () {
                $(formSelectors).addClass('modern-form');
                $('body').trigger('formsLoaded');
            });
        },

        /** Fix Form Fieldset */
        fixFormFieldset: function() {
            var formSelectors = '.rcp_form fieldset.rcp_user_fieldset > p, .rcp_form fieldset.rcp_card_fieldset > p, #rcp_profile_editor_form fieldset > p';

            $(formSelectors).wrapAll('<div role="group"></div>');
            $(formSelectors).wrapAll('<div role="group"></div>');
            $('body').on('rcp_gateway_change', function () {
                $(formSelectors).wrapAll('<div role="group"></div>');
            });
        },

        /** Replace all SVG images with inline SVG */
        replaceSVGs: function() {
            $('body').on('load metaIconsReady', function () {
                $('img.svg-icon').each(function(){
                    var $img = $(this);
                    var imgID = $img.attr('id');
                    var imgClass = $img.attr('class');
                    var imgURL = $img.attr('src');
        
                    $.get(imgURL, function(data) {
                        // Get the SVG tag, ignore the rest
                        var $svg = $(data).find('svg');
        
                        // Add replaced image's ID to the new SVG
                        if(typeof imgID !== 'undefined') {
                            $svg = $svg.attr('id', imgID);
                        }
                        // Add replaced image's classes to the new SVG
                        if(typeof imgClass !== 'undefined') {
                            $svg = $svg.attr('class', imgClass+' replaced-svg');
                        }
        
                        // Remove any invalid XML tags as per http://validator.w3.org
                        $svg = $svg.removeAttr('xmlns:a');
        
                        // Replace image with new SVG
                        $img.replaceWith($svg);
        
                    }, 'xml');
        
                });
            });
        },

        /** Checkbox + Radio Buttons Styling */
        icheck: function() {
            // apply lib on init
            $('.job-manager-form input, .job_listing_packages input, .wppb-user-forms input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        },

        /** Page Hero */
        pageHero: function() {
            $('.page-hero .hero-facets .big-field-wrap').first().addClass('first');
            $('.page-hero .hero-facets .big-field-wrap').last().addClass('last');
        },

        /** Sharing Links */
        sharingLinks: function() {

            function socialWindow(url) {
                var left = (screen.width - 570) / 2;
                var top = (screen.height - 570) / 2;
                var params = "menubar=no,toolbar=no,status=no,width=570,height=570,top=" + top + ",left=" + left;
                window.open(url,"NewWindow",params);
            }

            var pageUrl = encodeURIComponent(document.URL);
            
            $(".social-share.facebook a").on("click", function() {
                var url = "https://www.facebook.com/sharer.php?u=" + pageUrl;
                socialWindow(url);
            });
        
            $(".social-share.twitter a").on("click", function() {
                var title = $(this).attr('data-title');
                var url = "https://twitter.com/intent/tweet?url=" + pageUrl + "&text=" + title;
                socialWindow(url);
            });
        
            $(".social-share.linkedin a").on("click", function() {
                var url = "https://www.linkedin.com/shareArticle?mini=true&url=" + pageUrl;
                socialWindow(url);
            })

        },

        /** Google Places */
        googlePlaces: function() {
            let isAutoLocation = capstone_args.location_autocomplete;
            console.log(isAutoLocation);
            
            if (isAutoLocation == 1 && typeof google === 'object') {
                $('input[name="search_location"], input[name="job_location"], input[name="candidate_location"], input[name="alert_location"]').each(function(){
                    var autocomplete= new google.maps.places.Autocomplete((this),
                        { types: ['(cities)'] }
                    );
                });
            }
        },

    }

    // Initialize Functions
    $(window).on('load', function() {
        base.sitePreloader();
        base.detectDevice();
        base.stickyHeader();
        base.indentifyMenus();
        base.dynamicMenuStrings();
        base.siteNotification();
        base.scrollToTop();
        base.taxonomyPopup();
        base.videoLightBox();
        base.getUserLocation();
        base.testimonials();
        base.copyPermalink();
        base.dynamicTopOffset();
        setTimeout(function() {
            base.dynamicTopOffset();
        }, 5000);
        base.modernForms();
        base.fixFormFieldset();
        base.replaceSVGs();
        base.icheck();
        base.pageHero();
        base.sharingLinks();
        base.googlePlaces();
    });

    $('body').on('initScreenView', function() {
        base.desktopSiteMenu();
        base.desktopIconsMenu();
    });
    $('body').on('initTouchView', function() {
        base.mobileMenus();
    });

    var window_resize = false;
    $(window).resize(function() {
        if (window_resize) {
            clearTimeout(window_resize);
        }
        window_resize = setTimeout(function() {
            base.dynamicTopOffset()
        }, 600);
    });
    
});
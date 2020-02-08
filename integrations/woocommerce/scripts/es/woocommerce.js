// Get paramter by name
function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

jQuery(document).ready(function ($) {

    'use strict';

    /** Viewport dimensions */
    var ww = $(window).width();
    var wh = $(window).height();

    // Functions Object
    var woocommerce = {

        activeClass: function () {

            // check radio box on click upon package
            $('ul.job_packages > li, ul.resume_packages > li').on('click', function () {
                $('input[type="radio"]', this).prop('checked', true);
                $('input[type="radio"]', this).change();
            });
            $('ul.job_packages > li input[type="radio"]').on('ifChecked', function(event){
                $(this).prop('checked', true);
                $(this).change();
            });

            // add `active` class on click upon package
            $('input[type="radio"]', 'ul.job_packages li, ul.resume_packages li').change(function () {
                if ($(this).is(':checked')) {
                    $('ul.job_packages > li, ul.resume_packages > li').removeClass('active');
                    $('ul.job_packages > li .iradio_square-blue, ul.resume_packages > li .iradio_square-blue').removeClass('checked');

                    $(this).parents('li').addClass('active');
                    $(this).parents('.iradio_square-blue').addClass('checked');
                }
            });

            // add `active` class on load
            $('ul.job_packages > li, ul.resume_packages > li').each(function () {
                let isChecked = $('input[type="radio"]', this).is(':checked');
                if (isChecked) {
                    $(this).addClass('active');
                    $('.iradio_square-blue', this).addClass('checked');
                }
            });

        },

        changeHeading: function () {
            let templateStrings = $.parseJSON(capstone_args.translate_strings);
            $('#job_package_selection .job_listing_packages_title h2').html(templateStrings.select_package_caption);
        },

        checkoutDOM: function () {
            // shift cart form position
            // $('.woocommerce-cart-form').detach().insertAfter('.personal-info-fields');

            // shift submit button position
            $('.woocommerce-checkout-payment .place-order').detach().insertAfter('.payment-info-fields');

            // insert a span for each payment option
            $('body').on('updated_checkout', function () {
                $('ul.wc_payment_methods li.wc_payment_method').each(function () {
                    // $('input[type="radio"]', this).append('<span></span>');
                    $('label', this).prepend('<span></span>');
                });
            });
        },

        autoSelectPackage: function () {
            let hasPackage = getParameterByName('package');
            let pricingWCPage = $('#job_package_selection').length;

            if (pricingWCPage && hasPackage) {
                let packageID = 'package-' + hasPackage;

                // fake preloader to hide background process
                $('body').addClass('preload');
                $('#site-header').hide();
                $('.preloader').fadeIn();

                // select the correct package in background
                $('input#' + packageID).trigger('click');
                $('input#' + packageID).prop('checked', true);
                $('input#' + packageID).change();
                $('#job_package_selection .job_listing_packages_title input[type="submit"]').trigger('click');
            }
        },

        removeCouponButton: function () {
            // Remove redundant apply coupon button
            $('.woocommerce-info').each(function() {
                if ($(this).find('.showcoupon').length > 0) {
                    $(this).hide();
                }
            });
        },

        mylesPackages: function () {
            $('table.jmpack-my-packages-main-table').siblings('h2').hide();
            $('table.jmpack-my-packages-main-table, table.jmpack-detail-table').removeClass('ui');
        },

        cart: function(){

            $('.woocommerce-cart-form table tbody > tr.cart_item').each(function(index, row) {
                var $row = $(row);
                var $price = $('td.product-price > span', $row);
                $row.find('td.product-name').append($price);
            });
            
        },

        cart_remove: function(){

            $('.woocommerce-cart-form table tbody > tr.cart_item').each(function(index, row) {
                var $row = $(row);
                var $remove = $('td.product-remove > a', $row).html('Remove');
                $row.find('td.product-name').append($remove);
            });
            
        },

    }

    $(window).on('load', function () {
        woocommerce.activeClass();
        woocommerce.changeHeading();
        woocommerce.checkoutDOM();
        woocommerce.autoSelectPackage();
        woocommerce.removeCouponButton();
        woocommerce.mylesPackages();
        woocommerce.cart_remove();
    });

    if (ww < 960) {
        woocommerce.cart();
    }

});
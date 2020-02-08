// Export Functions
export default jQuery(document).ready( function($) {

    'use strict';

    // Functions Object
    var bookmarks = {
        
        /** Load More */
        popup: function() {

            $('.add-bookmark').magnificPopup({
                type: 'inline',
                closeOnBgClick: false,
                closeMarkup: '<span title="%title%" class="mfp-close"><i class="fi fi-cancel" aria-hidden="true"></i></span>'
            });
            $(document).on('click', '.popup-modal-dismiss', function (e) {
                e.preventDefault();
                $.magnificPopup.close();
            });

        },

        disableToggle: function() {
            $('.bookmark-notice').off('click');
        },

        hideNotification: function() {
            $('.bookmark-notice').each(function(){
                var isBookmarked = $(this).hasClass('bookmarked');

                if (!isBookmarked) {
                    $(this).parent('div:not(.bookmark-details)').hide();
                }
            });
        },
    }  

    $(window).on('load', function() {
        bookmarks.popup();
        bookmarks.disableToggle();
        bookmarks.hideNotification();

    });

});
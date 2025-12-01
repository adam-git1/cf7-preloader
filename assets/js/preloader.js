(function($) {
    'use strict';
    
    var preloaderHTML = '<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>';
    
    // Show preloader only after successful validation (before sending to server)
    $(document).on('wpcf7beforesubmit', '.wpcf7-form', function() {
        var $form = $(this);
        var $responseOutput = $form.find('.wpcf7-response-output');
        var $wrapper = $form.find('.cf7-preloader-wrapper');
        
        if ($wrapper.length === 0) {
            $wrapper = $('<div class="cf7-preloader-wrapper"></div>');
            $form.append($wrapper);
        }
        
        $wrapper.html(preloaderHTML).addClass('active');
    });
    
    // Hide preloader on any completion (success, error, spam, invalid form)
    $(document).on('wpcf7mailsent wpcf7mailfailed wpcf7spam wpcf7invalid', '.wpcf7-form', function() {
        var $form = $(this);
        var $wrapper = $form.find('.cf7-preloader-wrapper');
        
        $wrapper.removeClass('active').empty();
    });
    
})(jQuery);


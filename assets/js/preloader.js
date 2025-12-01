(function($) {
    'use strict';
    
    var preloaderHTML = '<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>';
    
    $(document).on('wpcf7submit', '.wpcf7-form', function() {
        var $form = $(this);
        var $responseOutput = $form.find('.wpcf7-response-output');
        var $wrapper = $form.find('.cf7-preloader-wrapper');
        
        if ($wrapper.length === 0) {
            $wrapper = $('<div class="cf7-preloader-wrapper"></div>');
            if ($responseOutput.length) {
                $responseOutput.after($wrapper);
            } else {
                $form.append($wrapper);
            }
        }
        
        $wrapper.html(preloaderHTML).addClass('active');
    });
    
    $(document).on('wpcf7mailsent wpcf7mailfailed wpcf7spam wpcf7invalid', '.wpcf7-form', function() {
        var $form = $(this);
        var $wrapper = $form.find('.cf7-preloader-wrapper');
        
        $wrapper.removeClass('active').empty();
    });
    
})(jQuery);


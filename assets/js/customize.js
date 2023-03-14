jQuery(document).ready(function($){

   	//Scroll to front page section
    $('body').on('click', '#sub-accordion-panel-frontpage_settings .control-subsection .accordion-section-title', function(event) {
        var section_id = $(this).parent('.control-subsection').attr('id');
        todoScrollToSection( section_id );
    });

    $('body').on('click', '#accordion-section-footer_settings .accordion-section-title', function(event) {
        var section_id = $(this).parent().attr('id');
        todoScrollToFooterSection( section_id );
    });
});

function todoScrollToSection( section_id ){
    var preview_section_id = "banner_section";

    var $contents = jQuery('#customize-preview iframe').contents();

    switch ( section_id ) {
        
        case 'accordion-section-about_home_section':
        preview_section_id = "about_section";
        break;
        
        case 'accordion-section-featured_section':
        preview_section_id = "featured_section";
        break;
        
        case 'accordion-section-header_image':
        preview_section_id = "banner_section";
        break;
    }

    if( $contents.find('#'+preview_section_id).length > 0 && $contents.find('.home').length > 0 ){
        $contents.find("html, body").animate({
        scrollTop: $contents.find( "#" + preview_section_id ).offset().top
        }, 1000);
    }
}

function todoScrollToFooterSection( section_id ){
    var preview_section_id = "colophon";

    var $contents = jQuery('#customize-preview iframe').contents();

    switch ( section_id ) {
        
        case 'accordion-section-footer_settings':
        preview_section_id = "colophon";
        break;
    }

    if( $contents.find('#'+preview_section_id).length > 0 ){
        $contents.find("html, body").animate({
        scrollTop: $contents.find( "#" + preview_section_id ).offset().top
        }, 1000);
    }
}
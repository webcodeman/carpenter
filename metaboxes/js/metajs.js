jQuery(document).ready(function($) {
	jQuery('#hmk_sideoption').parent().click(function() {
  		jQuery('.postlayout').fadeToggle(400);
  		jQuery('.postlayout').css('display', 'block');
	});
	
	if (jQuery('#hmk_sideoption:checked').val() !== undefined) {
		jQuery('.postlayout').show();
	}
    $('label #hmk_side_layout').css('visibility', 'hidden');
	$('label #hmk_side_layout:checked+img').addClass('ri_select');
    $('label .radio_img').click( function() {
	$(this).parent().parent().find('label .radio_img').removeClass('ri_select');
	$(this).addClass('ri_select');
	});
	
	
	jQuery('#hmk_slideshow').parent().click(function() {
  		jQuery('.slidelayout').fadeToggle(400);
  		jQuery('.slidelayout').css('display', 'block');
	});
	
	if (jQuery('#hmk_slideshow:checked').val() !== undefined) {
		jQuery('.slidelayout').show();
	}
	
	$('label #hmk_post_type').css('visibility', 'hidden');
	$('label #hmk_post_type:checked+img').addClass('ri_select');
    $('label .radio_img').click( function() {
	$(this).parent().parent().find('label .radio_img').removeClass('ri_select');
	$(this).addClass('ri_select');
	});
	
 
  
  /*----------------------------------------------------------------------------------*/
/*	Quote Options
/*----------------------------------------------------------------------------------*/

	var quoteOptions = jQuery('#quote_setting');
	var quoteTrigger = jQuery('#post-format-quote');
	
	quoteOptions.css('display', 'none');

/*----------------------------------------------------------------------------------*/
/*	Image Options
/*----------------------------------------------------------------------------------*/

	var imageOptions = jQuery('#image_setting');
	var imageTrigger = jQuery('#post-format-image');
	
	imageOptions.css('display', 'none');

/*----------------------------------------------------------------------------------*/
/*	Gallery Options
/*----------------------------------------------------------------------------------*/

	var galleryOptions = jQuery('#gallery_setting');
	var galleryTrigger = jQuery('#post-format-gallery');
	
	galleryOptions.css('display', 'none');
	
/*----------------------------------------------------------------------------------*/
/*	Link Options
/*----------------------------------------------------------------------------------*/

	var linkOptions = jQuery('#link_setting');
	var linkTrigger = jQuery('#post-format-link');
	
	linkOptions.css('display', 'none');
	
/*----------------------------------------------------------------------------------*/
/*	Audio Options
/*----------------------------------------------------------------------------------*/

	var audioOptions = jQuery('#audio_setting');
	var audioTrigger = jQuery('#post-format-audio');
	
	audioOptions.css('display', 'none');
	
/*----------------------------------------------------------------------------------*/
/*	Video Options
/*----------------------------------------------------------------------------------*/

	var videoOptions = jQuery('#video_setting');
	var videoTrigger = jQuery('#post-format-video');
	
	videoOptions.css('display', 'none');
	
	


/*----------------------------------------------------------------------------------*/
/*	The Brain
/*----------------------------------------------------------------------------------*/

	var group = jQuery('#post-formats-select input');

	
	group.change( function() {
		
		if(jQuery(this).val() == 'quote') {
			quoteOptions.css('display', 'block');
			lioHideAll(quoteOptions);
			
		} else if(jQuery(this).val() == 'link') {
			linkOptions.css('display', 'block');
			lioHideAll(linkOptions);
			
		} else if(jQuery(this).val() == 'audio') {
			audioOptions.css('display', 'block');
			lioHideAll(audioOptions);
			
		} else if(jQuery(this).val() == 'video') {
			videoOptions.css('display', 'block');
			lioHideAll(videoOptions);
			
		} else if(jQuery(this).val() == 'image') {
			imageOptions.css('display', 'block');
			lioHideAll(imageOptions);
			
		} else if(jQuery(this).val() == 'gallery') {
			galleryOptions.css('display', 'block');
			lioHideAll(galleryOptions);
			
		} else {
			quoteOptions.css('display', 'none');
			videoOptions.css('display', 'none');
			linkOptions.css('display', 'none');
			audioOptions.css('display', 'none');
			imageOptions.css('display', 'none');
			galleryOptions.css('display', 'none');
		}
		
	});
	
	if(quoteTrigger.is(':checked'))
		quoteOptions.css('display', 'block');
		
	if(linkTrigger.is(':checked'))
		linkOptions.css('display', 'block');
		
	if(audioTrigger.is(':checked'))
		audioOptions.css('display', 'block');
		
	if(videoTrigger.is(':checked'))
		videoOptions.css('display', 'block');
		
	if(imageTrigger.is(':checked'))
		imageOptions.css('display', 'block');
		
    if(galleryTrigger.is(':checked'))
		galleryOptions.css('display', 'block');
		
	function lioHideAll(notThisOne) {
		videoOptions.css('display', 'none');
		quoteOptions.css('display', 'none');
		linkOptions.css('display', 'none');
		audioOptions.css('display', 'none');
		imageOptions.css('display', 'none');
		galleryOptions.css('display', 'none');
		notThisOne.css('display', 'block');
	}
	
	 
	
});
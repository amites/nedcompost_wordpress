jQuery(function($){  

  $('.testimonial-slider').bxSlider({
   auto:true,
   controls:'true',
   pager: false   
  });

  $(window).resize(function(){
    $('.slider-caption').each(function(){
    var cap_height = $(this).actual( 'outerHeight' );
    $(this).css('margin-top',-(cap_height/2));
    });
    }).resize();
    
  $('.caption-description').each(function(){
    $(this).find('a').appendTo($(this).parent('.ak-container'));
  });
  

  $('.commentmetadata').after('<div class="clear"></div>');

  $('.menu-toggle').click(function(){
    $('#site-navigation .menu').slideToggle('slow');
  });
    
    $('.gallery .gallery-item a').each(function(){
        $(this).addClass('fancybox-gallery').attr('data-lightbox-gallery','gallery');
    });
    
    $(".fancybox-gallery").nivoLightbox();


  $('.search-icon .fa-search').click(function(){
    $('.ak-search').fadeToggle();
  });

  $(window).bind('load',function(){
  $('.slider-wrap .slides').each(function(){
    $(this).prepend('<div class="overlay"></div>');
  });
  });
  
 });
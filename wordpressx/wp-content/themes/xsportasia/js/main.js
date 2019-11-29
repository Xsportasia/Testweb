/*global $:false */

jQuery(document).ready(function(){'use strict';
	
	/* -------------------------------------- */
	// 		RTL Support Visual Composer
	/* -------------------------------------- */	
	var delay = 1;
	function themeum_rtl() {
		if( jQuery("html").attr("dir") == 'rtl' ){
			if( jQuery( ".entry-content > div" ).attr( "data-vc-full-width" ) =='true' )	{
				jQuery('.entry-content > div').css({'left':'auto','right':jQuery('.entry-content > div').css('left')});	
			}
		}
	}
	setTimeout( themeum_rtl , delay);

	jQuery( window ).resize(function() {
		setTimeout( themeum_rtl , delay);
	});

	// prettyPhoto
	jQuery("a[data-rel]").prettyPhoto();

	// Sticky Nav
	jQuery(window).on('scroll', function(){'use strict';
		if ( jQuery(window).scrollTop() > 130 ) {
			jQuery('#masthead').addClass('sticky');
		} else {
			jQuery('#masthead').removeClass('sticky');
		}
	});

	jQuery('.featured-wrap .share-btn').on('click',function(){
		jQuery('.share-btn-pop').slideToggle(500);
	});


	//title first word
	jQuery('.themeum-title h2').each(function() {
      var txt = jQuery(this).html();
      var index = txt.indexOf(' ');
      if (index == -1) {
         index = txt.length;
      }
      jQuery(this).html('<span>' + txt.substring(0, index) + '</span>' + txt.substring(index, txt.length));
   });


	jQuery(window).on('load',function(){'use strict';

		jQuery('#flexCarousel').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: true,
            itemWidth: 70,
            asNavFor: '#postSlider'
        });

        jQuery('#postSlider').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: true,
            sync: "#flexCarousel"
        });
    });


	jQuery('#gallerycarousel').flexslider({
		animation: "slide",
		controlNav: false,
		animationLoop: false,
		slideshow: false,
		itemWidth: 75,
		itemMargin: 27,
		asNavFor: '#galleryslider'
	});

	jQuery('#galleryslider').flexslider({
		animation: "slide",
		controlNav: false,
		animationLoop: false,
		slideshow: false,
		sync: "#gallerycarousel"
	});

	if( !jQuery('#secondary-menu').length ){
		jQuery('.sub-title').css( "padding", "100px 0");
	}

	
	//Woocommerce
	jQuery( ".woocart" ).hover(function() {
		jQuery(this).find('.widget_shopping_cart').stop( true, true ).fadeIn();
	}, function() {
		jQuery(this).find('.widget_shopping_cart').stop( true, true ).fadeOut();
	});	



	jQuery('.woocart a').html( jQuery('.woo-cart').html() );

	jQuery('.add_to_cart_button').on('click',function(){'use strict';

			jQuery('.woocart a').html( jQuery('.woo-cart').html() );		    

			var total = 0;
			if( jQuery('.woo-cart-items span.cart-has-products').html() != 0 ){
				if( jQuery('#navigation ul.cart_list').length  > 0 ){
					for ( var i = 1; i <= jQuery('#navigation ul.cart_list').length; i++ ) {
						var total_string = jQuery('#navigation ul.cart_list li:nth-child('+i+') .quantity').text();
						total_string = total_string.substring(-3, total_string.length);
						total_string = total_string.replace('×', '');
						total_string = parseInt( total_string.trim() );
						//alert( total_string );
						if( !isNaN(total_string) ){ total = total_string + total; }
					}
				}
			}
			jQuery('.woo-cart-items span.cart-has-products').html( total+1 );

    });

	//VC RTL Full Width
 	jQuery(window).load(function( $ ){
		if( jQuery(‘html’).attr(‘dir’) == ‘rtl’ ){
			jQuery(‘[data-vc-full-width=”true”]’).each( function(i,v){
				jQuery(this).css(‘right’ , jQuery(this).css(‘left’) ).css( ‘left’ , ‘auto’);
			});
		}
	});

});
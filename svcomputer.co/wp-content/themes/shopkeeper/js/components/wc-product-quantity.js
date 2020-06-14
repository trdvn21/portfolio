//==============================================================================
// Product Quantity Custom Buttons
//==============================================================================

 jQuery(document).ready(function($) {

    $(document).on('click', '.plus-btn', function(e) {

    	if( $('body').hasClass('rtl') ) {
    		$input = $(this).next('input.custom-qty');
    	} else {
    		$input = $(this).prev('input.custom-qty');
    	}
        var val = parseInt($input.val());
        $input.val( val+1 ).change();

        return false;
    });

    $(document).on('click', '.minus-btn', function(e) {

    	if( $('body').hasClass('rtl') ) {
    		$input = $(this).prev('input.custom-qty');
    	} else {
    		$input = $(this).next('input.custom-qty');
    	}
        var val = parseInt($input.val());
        if (val > 1) {
            $input.val( val-1 ).change();
        } 

        return false;
    });

	var windowWidth = $(window).width();

    // Input Quantity Long Press

    if (  windowWidth > 1024 ) {

		var timer;

		$(document).on('mousedown', '.plus-btn', function(e) {

		    $input = $(this).prev('input.custom-qty');
		    var val = parseInt($input.val());

		    timer = setInterval(function() {

		        val++;
		        $input.val(val);

		    }, 250); 

		});

		$(document).on('mousedown', '.minus-btn', function(e) {

		    $input = $(this).next('input.custom-qty');
		    var val = parseInt($input.val());

		    timer = setInterval(function() {

		      	if (val > 1) {
					val--;
					$input.val(val);
		        }

		     }, 250); 
		});


		document.addEventListener("mouseup", function(){
	   		if (timer) clearInterval(timer)
		});

	}
	

});
( function( $ ) {
	$(document).ready(function() {
		// alert('Kostas');
		$( "#kk_b4meEVENT_event_date_from_option" ).datepicker({
	      defaultDate: "+1w",
	      changeMonth: true,
	      changeYear: true,
	      numberOfMonths: 1,
	      onClose: function( selectedDate ) {
	        $( "#kk_b4meEVENT_event_date_to_option" ).datepicker( "option", "minDate", selectedDate );
	      }
	    });
	    $( "#kk_b4meEVENT_event_date_to_option" ).datepicker({
	      defaultDate: "+1w",
	      changeMonth: true,
	      changeYear: true,
	      numberOfMonths: 1,
	      onClose: function( selectedDate ) {
	        $( "#kk_b4meEVENT_event_date_from_option" ).datepicker( "option", "maxDate", selectedDate );
	      }
	    });
	});
} )( jQuery );
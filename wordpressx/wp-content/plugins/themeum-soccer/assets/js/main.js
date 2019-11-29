jQuery(document).ready(function(){'use strict';

	// Hover Youtube Video Play
	jQuery('#player').on('hover',function() {
		var str = jQuery("iframe#player").attr('src');
		if (str.indexOf("autoplay") >= 0){

		}else{
			jQuery("iframe#player").attr('src', str + '?autoplay=1'); 
		}
	});

	function countdown(endDate) {
	  let days, hours, minutes, seconds;
	  
	  endDate = new Date(endDate).getTime();
	  
	  if (isNaN(endDate)) {
		return;
	  }
	  setInterval(calculate, 1000);
	  function calculate() {
	    let startDate = new Date();
	    startDate = startDate.getTime();
	    
	    let timeRemaining = parseInt((endDate - startDate) / 1000);
	    
	    if (timeRemaining >= 0) {
	      days = parseInt(timeRemaining / 86400);
	      timeRemaining = (timeRemaining % 86400);
	      
	      hours = parseInt(timeRemaining / 3600);
	      timeRemaining = (timeRemaining % 3600);
	      
	      minutes = parseInt(timeRemaining / 60);
	      timeRemaining = (timeRemaining % 60);
	      
	      seconds = parseInt(timeRemaining);
	      
	      document.getElementById("m-days").innerHTML = parseInt(days, 10);
	      document.getElementById("m-hours").innerHTML = ("0" + hours).slice(-2);
	      document.getElementById("m-minutes").innerHTML = ("0" + minutes).slice(-2);
	      document.getElementById("m-seconds").innerHTML = ("0" + seconds).slice(-2);
	    } else {
	      return;
	    }
	  }
	}
    	
	//Call The Cuntdown Function
	var match_date = $(".catch-date").data("matchdate");
	countdown(match_date);


});
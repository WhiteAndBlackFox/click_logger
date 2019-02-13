$(document).ready(function() {

    $("#menu li a").click(function() {
           var to_page = $(this).attr('id');
           $.ajax({
	           	url: "moduls/functions.php",
	           	method: "GET",
           		data: { type: "set_page", to_page: to_page },
           		dataType: "text",
           		success: function(data){
           			$.get("contents/"+to_page+".php", function(data){
                  $("#contents").html(data);
                });
           		}
           });
    });

    $("#stats").click(function(){
    	var to_page = "stats";
    	$.ajax({
	           	url: "moduls/functions.php",
	           	method: "GET",
           		data: { type: "set_page", to_page: to_page },
           		dataType: "text",
           		success: function(data){
           			$.get("contents/"+to_page+".php", function(data){
      						$("#contents").html(data);
      					});
           		}
           });
    });

    $("#contents").click(function() {		
  		$.ajax({
  			url: "moduls/functions.php",
             	method: "GET",
         		data: { type: "add_click" },
         		dataType: "text"
  		});
    });

    setInterval(function(){
    	$.ajax({
    		url: "moduls/functions.php",
    		method: "GET",
    		data: { type: "set_click" },
    		dataType: "text",
    		success: function(data){
    			console.log(data);
    		}
    	});
    }, 10000);

});
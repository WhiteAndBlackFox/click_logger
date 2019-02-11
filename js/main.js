$(document).ready(function() {

    $("#menu li a").click(function() {
           var to_page = $(this).attr('id');
           $.ajax({
	           	url: "moduls/functions.php",
	           	method: "GET",
           		data: { type: "set_page", to_page: to_page },
           		dataType: "text",
           		success: function(data){
           			location.reload();
           		}
           });
    });


});
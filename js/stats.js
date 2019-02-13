$(document).ready(function() {
	$( "#tabs" ).tabs();

	$("#select_page").change(function() {
		var selectedpage = $(this).children("option:selected").val();
		$.ajax({
  			url: "moduls/functions.php",
  			method: "GET",
  			data: { type: "data_page_ip", selectedpage: selectedpage },
  			dataType: "json",
  			success: function(data){
  				$("#data_page_ip").html(data.table_page_ip);
       		}
  		});
	});

	$("#select_ip").change(function() {
		var selectedip = $(this).children("option:selected").val();
		$.ajax({
  			url: "moduls/functions.php",
  			method: "GET",
  			data: { type: "data_ip_page", selectedip: selectedip },
  			dataType: "json",
  			success: function(data){
  				$("#data_ip_page").html(data.table_page_ip);
       		}
  		});
	});

	function load_data_moduls(){
		$.ajax({
  			url: "moduls/functions.php",
  			method: "GET",
  			data: { type: "load_data_moduls" },
  			dataType: "json",
  			success: function(data){
  				$("#data_moduls").html(data.table_pages);
  				// console.log(data.page_options);
  				$("#select_page").empty().append('<option value="">---Выберете модуль---</option>' + data.page_options);
       		}
  		});
	}

	function load_data_ip(){
		$.ajax({
  			url: "moduls/functions.php",
  			method: "GET",
  			data: { type: "load_data_ip" },
  			dataType: "json",
  			success: function(data){
  				$("#data_ip").html(data.table_ip);
  				$("#select_ip").empty().append('<option value="">---Выберете ИП---</option>' + data.ip_options);
       		}
  		});
	}	

	load_data_moduls();
	load_data_ip();
});
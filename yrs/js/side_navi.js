$(function(){ 
     $(".toggle_open").show();
     $("h3.switch").click(function(){
	    $(this).toggleClass("close").next().slideToggle("normal");
	    return false;
	});
}); 
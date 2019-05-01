$(window).load(function(){
	
	$("#search-header").hide();

	$(".search-form__h a").toggle(function(){
		$("#search-header").fadeIn();
		$(".search-form__h a").css("color", "#76634b");
		document.getElementById("search-form_it").focus();
	},function(){
		$("#search-header").fadeOut();
		$(".search-form__h a").css("color", "#ff7800");
	});

});
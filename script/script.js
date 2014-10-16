var larg = $(window).width();
var haut = $(window).height();
	

$(document).ready(function ()
{
	$("#loginBlock").css("margin-left", (larg/2)-175);
	$("#loginBlock").css("margin-top", document.getElementById('verticalBlock').offsetTop);
	
	$(document).ready(function(){
      $("#loginForm").validate();
    });
	
	jQuery("#formStep").validate({
      rules: {
         "login":{
            "required": true,
            "minlength": 2,
            "maxlength": 10
         },
         "fil": {
            "required": true
         }
  }
  });

	
	
});

$(window).resize(function()
{
    larg = $(window).width();
    haut = $(window).height();
	
	$("#loginBlock").css("margin-left", (larg/2)-175);
	$("#loginBlock").css("margin-top", document.getElementById('verticalBlock').offsetTop);
});
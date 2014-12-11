var larg = $(window).width();
var haut = $(window).height();
	

$(document).ready(function ()
{
	$("#loginBlock").css("margin-left", (larg/2)-175);
	$("#loginBlock").css("margin-top", document.getElementById('verticalBlock').offsetTop);
	$("#logInput").focus();
});

$(window).resize(function()
{
    larg = $(window).width();
    haut = $(window).height();
	
	$("#loginBlock").css("margin-left", (larg/2)-175);
	$("#loginBlock").css("margin-top", document.getElementById('verticalBlock').offsetTop);
});
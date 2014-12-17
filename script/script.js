//---Catch the size of the current windows---//
var larg = $(window).width();
var haut = $(window).height();
	
//---When the HTML document is totaly loaded---//
$(document).ready(function ()
{
	//---adjust the postion of loginBlock div in function of the screen size---//
	$("#loginBlock").css("margin-left", (larg/2)-175);
	$("#loginBlock").css("margin-top", document.getElementById('verticalBlock').offsetTop);
	
	//---focus the text cursor on the first input---//
	$("#logInput").focus();
});

//---If the user resize his browser window---//
$(window).resize(function()
{
	//---Re catch the size---//
    larg = $(window).width();
    haut = $(window).height();
	
	//---and re adjust the div---//
	$("#loginBlock").css("margin-left", (larg/2)-175);
	$("#loginBlock").css("margin-top", document.getElementById('verticalBlock').offsetTop);
});
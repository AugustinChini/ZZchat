var larg = $(window).width();
var haut = $(window).height();

$(document).ready(function ()
{
	//---Hide the private chat buble and draggable attribut--//
	$("#conv1").hide();
	$("#conv1").draggable();
	//---dynamic autosize of text--//
	$("#onlineBloc p").fitText(0.7);
	$("#onlineTitle").fitText(1);
	$("#title").fitText(1.5);
	$("#textPriv p").fitText(1.5);
	$("#textChat p").fitText(4);
	//---start animation--//
	$("#verticalBlock").animate({height: 50},700); 
	$("#verticalBlock").animate({top: haut-50},1000, 'easeOutBounce');

});

$(window).resize(function()
{
    larg = $(window).width();
    haut = $(window).height(); 
	$("#verticalBlock").css("top", haut-50); 
});

function showConv(name)
{
	var content = document.getElementById("namePriv");
	content.innerHTML = '<p><p><b>'+name+'</b></p></p>';
	$("#conv1").show("fast");
	$("#textPriv p").fitText(1.5);
}
function kill()
{
	$("#conv1").fadeOut("slow");
}

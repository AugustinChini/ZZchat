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

function parse(type)
{
	var msg = $("#textA").val();
	
	switch (type) {
		case 'smily':
			$("#textA").val($("#textA").val()+':)');
			break;
		case 'wink':
			$("#textA").val($("#textA").val()+';)');
			break;
		case 'tongue':
			$("#textA").val($("#textA").val()+':p');
			break;
		case 'sad':
			$("#textA").val($("#textA").val()+':(');
			break;
		case 'heart':
			$("#textA").val($("#textA").val()+'<3');
			break;
		case 'bold':
			$("#textA").val('[g]'+($("#textA").val())+'[/g]');
			break;
		case 'italic':
			$("#textA").val('[i]'+($("#textA").val())+'[/i]');
			break;
		case 'under':
			$("#textA").val('[s]'+($("#textA").val())+'[/s]');
			break;
		case 'black':
			$("#textA").val('[black]'+($("#textA").val())+'[/black]');
			break;
		case 'red':
			$("#textA").val('[red]'+($("#textA").val())+'[/red]');
			break;
		case 'green':
			$("#textA").val('[green]'+($("#textA").val())+'[/green]');
			break;
		case 'blue':
			$("#textA").val('[blue]'+($("#textA").val())+'[/blue]');;
			break;
		case 'pink':
			$("#textA").val('[pink]'+($("#textA").val())+'[/pink]');
			break;
		case '1':
			$("#textA").val('[size=1]'+($("#textA").val())+'[/size=1]');
			break;
		case '2':
			$("#textA").val('[size=2]'+($("#textA").val())+'[/size=2]');
			break;
		case '3':
			$("#textA").val('[size=3]'+($("#textA").val())+'[/size=3]');
			break;
		case '4':
			$("#textA").val('[size=4]'+($("#textA").val())+'[/size=4]');
			break;
		case '5':
			$("#textA").val('[size=5]'+($("#textA").val())+'[/size=5]');
			break;
		case '6':
			$("#textA").val('[size=6]'+($("#textA").val())+'[/size=6]');;
			break;
} 
}

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
	$("#textA").focus();
	setInterval(function () {clearOldMsg(); }, 50000);
});

$(window).resize(function()
{
    larg = $(window).width();
    haut = $(window).height(); 
	$("#verticalBlock").css("top", haut-50); 
});

/*---not done yet---*/ 
/*function showConv(name)
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
*/
function clearOldMsg()
{
	var formData = {type: "msgQuery"};
	$.ajax({
    type: "POST",
    url: "XML_response.php",
    dataType: "xml",
	data : formData,
	error: function ()
	{
		alert("erreur server !!!");
	},
    success: xmlSizeTest
   });
}


function xmlSizeTest(xml) {
	var size = $(xml).find("size").text();
	if(size > 50)
	{
		$.get( "deleteMsg.php");	
	}
	
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
	}
	$("#textA").focus();
}

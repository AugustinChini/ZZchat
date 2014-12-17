var larg = $(window).width();
var haut = $(window).height();

$(document).ready(function ()
{
	//---Hide the private chat buble and draggable attribut--//
	/*$("#conv1").hide();
	$("#conv1").draggable();*/
	
	//---dynamic autosize of text--//
	$("#onlineBloc p").fitText(0.7);
	$("#onlineTitle").fitText(1);
	$("#title").fitText(1.5);
	//$("#textPriv p").fitText(1.5);
	$("#textChat p").fitText(4);
	
	//---start animation--//
	$("#verticalBlock").animate({height: 50},700); 
	$("#verticalBlock").animate({top: haut-50},1000, 'easeOutBounce');
	
	//---focus the text cursor on the textArea---//
	$("#textA").focus();
	
	//---start a setInterval on clearOldMsg function to delete old messages if there are too many---// 
	setInterval(function () {clearOldMsg(); }, 300000);
	
	//---start a setInterval on testInactivity function to check if some user leave chat or stay inactive (>10min) ---//
	setInterval(function () {testInactivity(); }, 300000);
});

//---If the user resize his browser window---//
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
	//---send a AJAX query to have all messages---//
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
	//---On success call xmlSizeTest---//
    success: xmlSizeTest
   });
}


function xmlSizeTest(xml) {
	//---Find the size---//
	//---(I discovred that jQuery have lot of functions to handle XML docs and lot of usefull functions to send AJAX query but it was too late to change all my code---//
	var size = $(xml).find("size").text();
	
	//---If there are more than 50 messages...---//
	if(size > 50)
	{
		//---Call thanks to get Ajax method deleteMsg.php-->it will delete 30 olds messages---//
		$.get( "deleteMsg.php");	
	}
	
}


function testInactivity()
{
	//---Call thanks to get Ajax method autoLogOut.php --> it will test the inactivity of all the users ---//
	$.ajax({
    type: "GET",
    url: "autoLogOut.php",
	error: function ()
	{
		alert("erreur server !!!");
	},
   });
}

//---Big switch case to add the correct markup or smiley in the textArea---//
function parse(type)
{

	//---Catch the current textArea value---//
	var msg = $("#textA").val();
	
	//---Add markup or smiley---//
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
	
	//---and focus the text cursor on the textArea---//
	$("#textA").focus();
}

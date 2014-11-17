var xmlhttp;
var currentSize = 0;
var size = 0;
var currentSizeL = 0;
var sizeLogOn = 0;

if (window.XMLHttpRequest)
{
	xmlhttp=new XMLHttpRequest();
}
else
{
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}

$(document).ready(function ()
{
	init();
	setInterval(function () {loadXMLDoc("SettingFiles/chatRoom.xml", "msg"); }, 1000);
	setInterval(function () {loadXMLDoc("SettingFiles/userSettings.xml", "logon");}, 3000);
	
});

function loadXMLDoc(url, type)
{
	  xmlhttp.open("GET",url ,true);
	  xmlhttp.send();
	  xmlhttp.onreadystatechange=function()
	  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				var doc = xmlhttp.responseXML;
				
				element = doc.getElementsByTagName('size')[0].childNodes[0];
				size = element.data;
				if(type == 'msg')
				{
					if(currentSize != size)
					{
						refreshMsg(size);
					}
				}
				else 
				{
					if(currentSizeL != size)
					{
						logOnRefresh(size);
					}
				}
			}
	  };
}

function refreshMsg(size)
{
	var doc = xmlhttp.responseXML;
	var i = 0;
	for (var i =currentSize; i<size; ++i)
	{
		element = doc.getElementsByTagName('info')[i].childNodes[0];
		$( "#textChat" ).append( '<p class="info">'+element.data+'</p>' );
		element = doc.getElementsByTagName('msg')[i].childNodes[0];
		$( "#textChat" ).append( '<p>'+element.data+'</p>' );
		currentSize = size;
		
	}
	$( "#textChat" ).animate({ scrollTop : $( "#textChat" ).prop('scrollHeight') }, 500);
	$("#textChat p").fitText(4);
}

function logOnRefresh(size)
{
		jQuery('#onlineTxt').html('');
		var doc = xmlhttp.responseXML;
		var i = 0;
		for (var i = 0 ; i<size; ++i)
		{
			user = doc.getElementsByTagName('user')[i].childNodes[0];
			fil = doc.getElementsByTagName('fil')[i].childNodes[0];
			$( "#onlineTxt" ).append( "<img src='pictures/" + fil.data + ".jpg'/><p onclick=\"showConv('" + user.data + "')\">" + user.data + "</p><br/>" );	
			currentSizeL = size;
		}
		$("#onlineTxt").fitText(1);
}



function init()
{
  loadXMLDoc("SettingFiles/chatRoom.xml", "msg");
}

function send(user)
{
	var d = new Date();
	var msgTextArea = $("#textA").val();
	$("#textA").val('');
	$("#textA").val('');
	var formData = {user: user, date: getStringDate(d), msg: msgTextArea};
	$.ajax(
	{
		url : "AjaxAddMsg.php",
		type: "POST",
		data : formData,
		error: function ()
		{
			alert("erreur server !!!");
		}
	});
	loadXMLDoc("SettingFiles/chatRoom.xml", "msg");
}

function getStringDate(aDate){
	var dd = aDate;
	var yy = dd.getYear();
	var mm = dd.getMonth() + 1;
	dd = dd.getDate();
	if (yy < 2000) { yy += 1900; }
	if (mm < 10) { mm = "0" + mm; }
	if (dd < 10) { dd = "0" + dd; }
	var HH = aDate.getHours(); 
	var MM = aDate.getMinutes(); 
	var rs = dd + "-" + mm + "-" + yy +" " + HH +":"+ MM ;
	return rs;
} 

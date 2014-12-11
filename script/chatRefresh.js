var xmlhttp;
var currentSize = 0;
var size = 0;
var currentSizeL = 0;
var sizeLogOn = 0;
var userName;

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
	setInterval(function () {loadXMLDoc("msgQuery"); }, 500);
	setInterval(function () {loadXMLDoc("logon");}, 3000);
	
});

function loadXMLDoc(type)
{
		
	  xmlhttp.open("POST", "XML_response.php" ,true);
	  xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	  xmlhttp.send("type="+type);
	  xmlhttp.onreadystatechange=function()
	  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				var doc = xmlhttp.responseXML;
				
				var element = doc.getElementsByTagName('size')[0].childNodes[0];
				size = element.data;
				if(type == 'msgQuery')
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
	for (i = currentSize; i<size; ++i)
	{
		var element = doc.getElementsByTagName('info')[i].childNodes[0];
		if(((element.data).indexOf(userName)) == -1)
		{
					$( "#textChat" ).append( '<p class="info">'+element.data+'</p>' );
					element = doc.getElementsByTagName('msg')[i].childNodes[0];

					$( "#textChat" ).append( '<p>'+element.data+'</p>' );
					
					
		}
		else
		{
					
					$( "#textChat" ).append( '<p style="margin-left:50%;" class="info">'+element.data+'</p>' );
					element = doc.getElementsByTagName('msg')[i].childNodes[0];
					$( "#textChat" ).append( '<p style="margin-left:50%;">'+element.data+'</p>' );
		}
		;
	}
	$( "#textChat" ).animate({ scrollTop : $( "#textChat" ).prop('scrollHeight') }, 500);
	currentSize = size
	
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
  loadXMLDoc("msgQuery");
}

function send(user)
{
	var d = new Date();
	var msgTextArea = $("#textA").val();
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
	loadXMLDoc("msgQuery");
}

function setUserName(user)
{
	userName = user;
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

$(document).ready(function ()
{
	init();
});


var xmlhttp;
var currentSize
function loadXMLDoc(url,cfunc)
{
	if (window.XMLHttpRequest)
	  {
		xmlhttp=new XMLHttpRequest();
	  }
	else
	  {
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=cfunc;
	xmlhttp.open("GET",url ,true);
	xmlhttp.send();
}

function init()
{
loadXMLDoc("SettingFiles/chatRoom.xml",function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		var doc = xmlhttp.responseXML;
		var size;
		var i = 0;
		element = doc.getElementsByTagName('size')[0].childNodes[0];
		size = element.data;
		for (var i =0; i<size; ++i)
		{
			element = doc.getElementsByTagName('info')[i].childNodes[0];
			$( "#textChat" ).append( '<p class="info">'+element.data+'</p>' );
			element = doc.getElementsByTagName('msg')[i].childNodes[0];
			$( "#textChat" ).append( '<p>'+element.data+'</p>' );
			
		}
		$( "#textChat" ).animate({ scrollTop : $( "#textChat" ).prop('scrollHeight') }, 500);
		$("#textChat p").fitText(4);
    }
  });
}


function createInstance()
{
  var req = null;
  if(window.XMLHttpRequest)
  {
    req = new XMLHttpRequest();
  }
  else if (window.ActiveXObject)
  {
    try
	{
      req = new ActiveXObject("Msxml2.XMLHTTP");
    }
	catch (e) 
	{
       try 
	   {
         req = new ActiveXObject("Microsoft.XMLHTTP");
       }
	   catch (e) 
	   {
            alert("XHR not created");
       }
    }
  }
    return req;
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
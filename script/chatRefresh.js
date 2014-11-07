var xmlhttp;
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

function refresh()
{
loadXMLDoc("SettingFiles/chatRoom.xml",function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		var doc = xmlhttp.responseXML;
		var i;
		element = doc.getElementsByTagName('msg').item(1);
		document.getElementById("textChat").innerHTML= '<p class="info">'+element.firstChild.data+'</p>';
		$("#textChat p").fitText(4);
    }
  });
}
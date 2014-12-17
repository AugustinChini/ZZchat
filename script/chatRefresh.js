var xmlhttp;
var currentSize = 0;
var size = 0;
var currentSizeL = 0;
var sizeLogOn = 0;
var userName;

//---Creation of the XMLHttpRequest object to send AJAX query---//
if (window.XMLHttpRequest)
{
	xmlhttp=new XMLHttpRequest();
}
else
{
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}

//---When the HTML document is totaly loaded---//
$(document).ready(function ()
{
	//---Call the init function---//
	init();
	
	//---create a setInterval to call the refresh of message display---//
	setInterval(function () {loadXMLDoc("msgQuery"); }, 1000);
	
	//---create a setInterval to call the refresh of user connection---//
	setInterval(function () {loadXMLDoc("logon");}, 3000);
	
});

//---Function which send the apropriate query in function of the type parameter---//
function loadXMLDoc(type)
{
	  //---create and send the POST query---//
	  xmlhttp.open("POST", "XML_response.php" ,true);
	  xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	  xmlhttp.send("type="+type);
	  xmlhttp.onreadystatechange=function()
	  {
		  //---Call back function test the status of the query response---//
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				var doc = xmlhttp.responseXML;
				
				//---catch the size node value---//
				var element = doc.getElementsByTagName('size')[0].childNodes[0];
				size = element.data;
				
				//---it's a msg query ?---//
				if(type == 'msgQuery')
				{
					//---if the size of the number of message in xml file is different to the number of message displayed...a refresh query is useful---//
					if(currentSize != size)
					{
						refreshMsg(size);
					}
				}
				//---......it's a user query ---//
				else 
				{
					//---if the size of the number of user in xml file is different to the number of user displayed...a refresh query is useful---//
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
	//---Catch the XML respense---//
	var doc = xmlhttp.responseXML;
	var i = 0;
	
	//---Loop add only the mising message---//
	for (i = currentSize; i<size; ++i)
	{
		var element = doc.getElementsByTagName('info')[i].childNodes[0];
		
		//---If current user name isn't on the element data it mean that this message come from an other user---//
		if(((element.data).indexOf(userName)) == -1)
		{
					//---append message on the back---//
					$( "#textChat" ).append( '<p class="info">'+element.data+'</p>' );
					element = doc.getElementsByTagName('msg')[i].childNodes[0];
					$( "#textChat" ).append( '<p>'+element.data+'</p>' );
					
					
		}
		
		//---If current user name is on the element data it mean that we have to move to the right this message---//
		else
		{
					//---append message on the back---//
					$( "#textChat" ).append( '<p style="margin-left:50%;" class="info">'+element.data+'</p>' );
					element = doc.getElementsByTagName('msg')[i].childNodes[0];
					$( "#textChat" ).append( '<p style="margin-left:50%;">'+element.data+'</p>' );
		}
		;
	}
	//---Scroll to the bottom---//
	$( "#textChat" ).animate({ scrollTop : $( "#textChat" ).prop('scrollHeight') }, 500);
	currentSize = size
	
}

function logOnRefresh(size)
{
		//---Clear the Block---//
		jQuery('#onlineTxt').html('');
		
		//---Catch the XML respense---//
		var doc = xmlhttp.responseXML;
		var i = 0;
		
		//---Loop to display the users who are connected---//
		for (var i = 0 ; i<size; ++i)
		{
			user = doc.getElementsByTagName('user')[i].childNodes[0];
			fil = doc.getElementsByTagName('fil')[i].childNodes[0];
			
			//---append user name on the back---//
			$( "#onlineTxt" ).append( "<img src='pictures/" + fil.data + ".jpg'/><p onclick=\"showConv('" + user.data + "')\">" + user.data + "</p><br/>" );	
			currentSizeL = size;
		}
		$("#onlineTxt").fitText(1);
}



function init()
{
  //---The init function only send a message query to display all the old messages when some one just logon---//
  loadXMLDoc("msgQuery");
}

//---Function call by the enter keyboar button---//
function send(user)
{
	//---call the current date---//
	var d = new Date();
	
	//---catch the content of the textArea---//
	var msgTextArea = $("#textA").val();
	
	//---Clear the textArea---//
	$("#textA").val('');
	
	//---set the data array which will be send by the POST method---//
	var formData = {user: user, date: getStringDate(d), msg: msgTextArea};
	
	//---Send AJAX query---//
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
	
	//---Refresh message---//
	loadXMLDoc("msgQuery");
}

function setUserName(user)
{
	//---Put the name of the current user in a global var---//
	userName = user;
}

//---fromat Date---//
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

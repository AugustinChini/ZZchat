function langChange(pg, lang)
{	
	if(pg == "index")
	{
		var divList = new Array("logTxt","cookieTxt","filTxt","otherTxt");
	}
	else if(pg == "home")
	{
		
	}
	else
	{
		alert("Language Error !");
		return 1;
	}
	var req = null; 
 
		if (window.XMLHttpRequest)
		{
 			req = new XMLHttpRequest();
			if (req.overrideMimeType) 
			{
				req.overrideMimeType('text/xml');
			}
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
				} catch (e) {}
			}
	    }


		req.onreadystatechange = function()
		{ 
			var i;
			for(i=0; i<divList.length; i++)
			{
				var storing = document.getElementById(divList[i]);
				storing.innerHTML = "Wait...";
			}
			if(req.readyState == 4)
			{
				if(req.status == 200)
				{
					var element;
					var doc = req.responseXML;
					for(i=0; i<divList.length; i++)
					{
						element = doc.getElementsByTagName('txt').item(i);
						storing = document.getElementById(divList[i]);
						storing.innerHTML = element.firstChild.data;
					}
					element = doc.getElementsByTagName('txt').item(i);
					storing = document.getElementById(divList[i]);
					document.getElementById('submitFrom').value= element.firstChild.data;
					element = doc.getElementsByTagName('txt').item(i+1);
					storing = document.getElementById(divList[i+1]);
					document.getElementById('resetFrom').value= element.firstChild.data; 
				}	
				else	
				{
					alert("error language");
				}	
			} 
		}; 
		if(lang == "FR")
		{
			req.open("GET", "SettingFiles/FR.xml", true);
		}
		else
		{
			req.open("GET", "SettingFiles/EN.xml", true);
		}
		 
		req.send(null);
		
}		
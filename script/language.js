function langChange(pg, lang)
{	
	var XML_Path = "SettingFiles/FR.xml";
	
	//---Check the page (home page or index page)---//
	if(pg == "index")
	{
		//---Create a array of all div which contains text---//
		var divList = new Array("logTxt","cookieTxt","filTxt","otherTxt");
		if(lang == "EN")
		{
			//---Select the apropriate XML file---//
			XML_Path = "SettingFiles/EN.xml";
			//---if the user choose english it will be the same language when he will logOn
			//---so in the forme action we will add the GET attribut which notifie EN preference
			//---if it's not done the chat is in french by default---//
			document.form.action = "processing.php?lang=EN";
		}
	}
	else if(pg == "home")
	{
		var divList = new Array("onlineTitle","title");
		if(lang == "FR")
		{
			//---Select the apropriate XML file---//
			XML_Path = "SettingFiles/FR_home.xml";
		}
		else
		{
			//---Select the apropriate XML file---//
			XML_Path = "SettingFiles/EN_home.xml";
		}
	}
	else
	{
		alert("Language Error !");
		return 1;
	}
	var req = null; 
		
		//---Create a new XMLHttpRequest objet to send AJAX query---//
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

		//---when the objet change this state---//
		req.onreadystatechange = function()
		{ 
			var i;
			for(i=0; i<divList.length; i++)
			{
				//---while the query isn't finished display Wait... on text div---//
				var storing = document.getElementById(divList[i]);
				storing.innerHTML = "Wait...";
			}
			if(req.readyState == 4)
			{
				if(req.status == 200)
				{
					var element;
					var doc = req.responseXML;
					
					//---Main loop, update all the div content---//
					for(i=0; i<divList.length; i++)
					{
						element = doc.getElementsByTagName('txt').item(i);
						storing = document.getElementById(divList[i]);
						storing.innerHTML = element.firstChild.data;
					}
					if(pg == "index")
					{
						//---In input markup we don't use innerHTML function so the index.php form need an special case---//
						element = doc.getElementsByTagName('txt').item(i);
						storing = document.getElementById(divList[i]);
						document.getElementById('submitFrom').value= element.firstChild.data;
						element = doc.getElementsByTagName('txt').item(i+1);
						storing = document.getElementById(divList[i+1]);
						document.getElementById('resetFrom').value= element.firstChild.data;
					}
				}	
				else	
				{
					alert("error language");
				}	
			} 
		};
		
		//---The query sending---//
		req.open("GET", XML_Path, true);
		req.send(null);
		
}		
<?php 
		include("cookie.php");
		include("checkLog.php");
		include("XMLHandling.php");
		$log = $_POST["login"];
		$fil = $_POST["fil"];
		$lang = $_GET["lang"];
		$bool =0;
		$i = 0;
		
		//---Check if the login is allowed---//
		$result = checkLog($log, $fil);
		
		//---if login ok...---//
		if ($result != 'err')
		{
			$log = $result;
			
			//---If cookie not set yet---//
			if(isset($_POST["cookie"]) && $_POST["cookie"] == "true" )
			{
				//---Set cookie---//
				cookie($log, $fil);
			}
			
			$XMLfile = 'SettingFiles/userSettings.xml';
			
			//---if XML file exists---//
			if (file_exists($XMLfile))
			{
				//---Create and load XML file---//
				$xml = new DOMDocument("1.0");
				$xml -> load($XMLfile);
				$root = $xml->getElementsByTagName("root")->item(0);
				
				//---Get number of user---//
				$currentSize = getSize($xml);
				
				
				do
				{
					$user = $xml->getElementsByTagName("user")->item($i);
					$userValue = $user->firstChild->nodeValue;
					
					//---Seek if the name choose by the user isn't use---//
					if($userValue == $log)
					{
						//---Error msg : this login is already used sorry---//
						echo("<p>".$log." this login is already used sorry ...</p>");
						$bool = 1;
						header('Refresh:3; url=index.php');
					}
					++$i;
					
				}while($i<$currentSize && $bool == 0);
				
				//---if login isn't use add it to the XML file---//
				if($bool == 0)
				{
					
					//---create child and add user on it---//
					$user = cElement($xml, "user", $root);
					AddValue($xml, $log, $user);
					
					//---create child and add filière on it---//
					$XMLfil = cElement($xml, "fil", $root);
					AddValue($xml, "$fil", $XMLfil);
					
					//---increment the number of user---//
					$size = $xml->getElementsByTagName("size")->item(0);
					$currentSize++;
					$size->firstChild->nodeValue = $currentSize;
					
					//---Save the XML file---//
					$xml->formatOutput=true;
					$xml->save($XMLfile);
					
					//---Start session---//
					if (session_start ())
					{
						$_SESSION['login'] = $log;
						$_SESSION['fil'] = $fil;
						header ('location: home.php?lang='.$lang);
					}
					else
					{
						header ('location: index.php');
					}
					
				}
				
			}
			else
			echo "<h3>File error !</h3>";
		}
		else 
		{
			//---Msg error : forbidden login---//
			echo("<h1>Form error :<br/>- check if your input isn't empty<br/>- Your login must have a size between 3 and 15 character<br/>- The ISIMA option is mandatory</h1>");
			fclose($fp);
			header('Refresh:3; url=index.php');
		}
		

?> 

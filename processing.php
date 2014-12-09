<?php 
		include("cookie.php");
		include("checkLog.php");
		include("XMLHandling.php");
		$log = $_POST["login"];
		$fil = $_POST["fil"];
		$lang = $_GET["lang"];
		$bool =0;
		$i = 0;
		
		$result = checkLog($log, $fil);
		

		if ($result != 'err')
		{
			$log = $result;
			if(isset($_POST["cookie"]) && $_POST["cookie"] == "true" )
			{
				cookie($log, $fil);
			}
			$XMLfile = 'SettingFiles/userSettings.xml';
			if (file_exists($XMLfile))
			{
				$xml = new DOMDocument("1.0");
				$xml -> load($XMLfile);
				$root = $xml->getElementsByTagName("root")->item(0);
				
				$currentSize = getSize($xml);
				
				
				do
				{
					$user = $xml->getElementsByTagName("user")->item($i);
					$userValue = $user->firstChild->nodeValue;
					if($userValue == $log)
					{
						echo("<p>".$log." this login is already used sorry ...</p>");
						$bool = 1;
						header('Refresh:3; url=index.php');
					}
					++$i;
					
				}while($i<$currentSize && $bool == 0);
				
				if($bool == 0)
				{
					$user = cElement($xml, "user", $root);
					AddValue($xml, $log, $user);
					
					$XMLfil = cElement($xml, "fil", $root);
					AddValue($xml, "$fil", $XMLfil);
					
					$size = $xml->getElementsByTagName("size")->item(0);
					$currentSize++;
					$size->firstChild->nodeValue = $currentSize;
					
					$xml->formatOutput=true;
					$xml->save($XMLfile);
					
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
			echo("<h1>Form error :<br/>- check if your input isn't empty<br/>- Your login must have a size between 3 and 15 character<br/>- The ISIMA option is mandatory</h1>");
			fclose($fp);
			header('Refresh:3; url=index.php');
		}
		

?> 

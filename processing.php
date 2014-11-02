<?php 
		include("cookie.php");
		include("checkLog.php");
		$log = $_POST["login"];
		$fil = $_POST["fil"];
		$lang = $_GET["lang"];
		$result = checkLog($log, $fil);
		if ($result != 'err')
		{
			$log = $result;
			if(isset($_POST["cookie"]) && $_POST["cookie"] == "true" )
			{
				cookie($log, $fil);
			}
			$fichier = 'SettingFiles/userSettings.txt';
			$bool =0;
			if (file_exists($fichier))
			{
				$fp = fopen($fichier, 'r+');
				do{
					$ligne = fgets($fp,500);
					$liste = explode(';',$ligne);
					if($liste[0] == $log)
					{
						echo("<p>".$log." this login is already used sorry ...</p>");
						$bool = 1;
						fclose($fp);
						header('Refresh:3; url=index.php');
					}
				}while (!feof($fp) && $bool == 0);
				if($bool == 0)
				{
					fseek($fp, 0, SEEK_END);
					fputs($fp, PHP_EOL);
					fputs($fp, $log.";");
					fputs($fp, $fil);
					fclose($fp);
					session_start ();
					$_SESSION['login'] = $log;
					$_SESSION['fil'] = $fil;
					header ('location: home.php?lang='.$lang);
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

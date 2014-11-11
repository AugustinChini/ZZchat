<?php
	session_start ();
	if (isset($_SESSION['login']) && isset($_SESSION['fil']))
	{
		$log = $_SESSION['login'];
		$fil = $_SESSION['fil'];
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html lang="fr" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <title>Bienvenu <?php echo $log ; ?></title>
        <link rel="stylesheet" href="css/styleHome.css" type="text/css" />
        <link rel="shortcut icon" type="image/jpg" href="pictures/favicon.jpg" />
        <script type="text/javascript" src="script/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="script/jquery-ui-1.10.0.custom.js"></script>
		<script type="text/javascript" src="script/scriptHome.js"></script>
		<script type="text/javascript" src="script/jquery.fittext.js"></script>
		<script type="text/javascript" src="script/language.js"></script>
        <script type="text/javascript" src="script/chatRefresh.js"></script>
		<script type="text/javascript">
			window.onbeforeunload = confirmExit;
			function confirmExit()
			{
				document.location.href="<?php echo "logOut.php?log=".$log ?>" 
				return '';
			}
		</script>
    </head>
    <body>
    	<div id="lang"><img alt="English language" onclick="langChange('home', 'EN')" src="pictures/en.jpg" /> <img alt="Langage Francais" onclick="langChange('home', 'FR')" src="pictures/fr.jpg" /> <a href="<?php echo "logOut.php?log=".$log ?>"><img alt="LogOut" src="pictures/logOut.png" /></a></div>
		<div id="onlineBloc">
		<center><div id="onlineTxt" >ZZ en ligne :</div></center>
			<?php
				$fichier = 'SettingFiles/userSettings.txt';
				$fp = fopen($fichier, 'r+');			
				do
				{
					$ligne = fgets($fp,100);
					if($ligne != PHP_EOL)
					{
						$liste = explode(';',$ligne);
						if (isset($liste[1]) && isset($liste[0]))
							echo("<img src='pictures/".trim($liste[1]).".jpg'/><p onclick=\"showConv('".$liste[0]."')\">".$liste[0]."</p><br/>");
					}
				} while (!feof($fp));
			?>
		</div>
        <center>
			<div id="chatRoom"><div id="title" style="margin:0px;">Salon de discution :</div>
		</center>
        <div id="textChat">
			<!--Chat room text-->
        </div>
		<center>
		  	<div id="textAera">
		    	<textarea id="textA" onkeypress="if (event.keyCode == 13) send(<?php echo("'".$log."'") ?>);"></textarea>
		  	</div>
        </center>
        <div id="privateConv">
           <div id="conv1">
           		<img src="pictures/cross.png" width="8%" onclick="kill()" />
            	<div id="namePriv"><p><b>Name</b></p></div>
                <div id="textPriv">
					<!--Private Msg-->
           		</div>
            	<center>
                <div id="textAeraPriv">
                  <input type="text" />
                </div>
              </center>
           </div>
        </div>
		<div id="verticalBlock"></div>
    </body>
   	<script type="text/javascript">
		var url = document.location.href;
		var fr = 'FR';
		if(url.indexOf(fr) == -1)
		{
			langChange('home', 'EN');
		}
    </script>
</html>

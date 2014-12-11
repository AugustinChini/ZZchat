<?php
	session_start ();
	if (isset($_SESSION['login']) && isset($_SESSION['fil']))
	{
		$log = $_SESSION['login'];
		$fil = $_SESSION['fil'];
	}
	else
	{
		header ('location: index.php');
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
    </head>
    <body>
    	<div id="lang"><img alt="English language" onclick="langChange('home', 'EN')" src="pictures/en.jpg" /> <img alt="Langage Francais" onclick="langChange('home', 'FR')" src="pictures/fr.jpg" /> <a href="<?php echo "logOut.php?log=".$log ?>"><img alt="LogOut" src="pictures/logOut.png" /></a></div>
        <div id="onlineTitle">ZZ en ligne :</div>
		<div id="onlineBloc">
			<center><div id="onlineTxt" ></div></center>
        </div>
        <center>
			<div id="chatRoom"><div id="title" style="margin:0px;">Salon de discussion :</div>
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
		<center><div id="verticalBlock">
			<img  width="3.5%" src="pictures/smily.png" onclick="parse('smily')" />
			<img  width="3.5%" src="pictures/wink.png" onclick="parse('wink')" />
			<img  width="3.5%" src="pictures/tongue.png" onclick="parse('tongue')" />
			<img  width="3.5%" src="pictures/sad.png" onclick="parse('sad')" />
			<img  width="3.5%" src="pictures/heart.png" onclick="parse('heart')" />
			<img  width="3.5%" src="pictures/bold.png" onclick="parse('bold')" />
			<img  width="3.5%" src="pictures/italic.png" onclick="parse('italic')" />
			<img  width="3.5%" src="pictures/under.png" onclick="parse('under')" />
			<img  width="3.5%" src="pictures/black.png" onclick="parse('black')" />
			<img  width="3.5%" src="pictures/red.png" onclick="parse('red')" />
			<img  width="3.5%" src="pictures/green.png" onclick="parse('green')" />
			<img  width="3.5%" src="pictures/blue.png" onclick="parse('blue')" />
			<img  width="3.5%" src="pictures/pink.png" onclick="parse('pink')" />

		</div></center>
    </body>
   	<script type="text/javascript">
		var url = document.location.href;
		var fr = 'FR';
		if(url.indexOf(fr) == -1)
		{
			langChange('home', 'EN');
		}
		setUserName(<?php echo("'".$log."'") ?>);
    </script>
</html>

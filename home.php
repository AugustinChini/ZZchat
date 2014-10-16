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
    </head>
    <body>
    	<div id="lang"><img alt="English language" src="pictures/en.jpg" /> <img alt="Langage Francais" src="pictures/fr.jpg" /> <a href="<?php echo "logOut.php?log=".$log ?>"><img alt="LogOut" src="pictures/logOut.png" /></a></div>
		<div id="onlineBloc">
		<center><h2 style="margin:0; margin-bottom: 10px;">Online ZZs :</h2></center>
			<?php
				$fichier = 'SettingFiles/userSettings.txt';
				$fp = fopen($fichier, 'r+');			
				do
				{
					$ligne = fgets($fp,100);
					if($ligne != PHP_EOL)
					{
						$liste = explode(';',$ligne);
						echo("<img src='pictures/".trim($liste[1]).".jpg'/><p onclick=\"showConv('".$liste[0]."')\">".$liste[0]."</p><br/>");
					}
				} while (!feof($fp));
			?>
		</div>
        <div id="chatRoom"><center><h1 style="margin:0px;">Chat Room :</h1></center></div>
        <div id="textChat">
        	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla gravida dapibus velit posuere mattis. Nullam efficitur ultricies nunc ut porta. Aliquam malesuada consequat diam et facilisis. Cras aliquam auctor hendrerit. Fusce tincidunt, mauris at vestibulum sagittis.</p>
            <br />
            <p>Nunc aliquam aliquet arcu pharetra pretium. </p>
            <br />
            <p>Pellentesque et faucibus nunc. Donec pellentesque interdum velit, ac rhoncus odio aliquet posuere. Praesent in purus a nisi condimentum faucibus. Curabitur euismod purus tortor, a elementum velit mollis vitae. Duis non est commodo, rhoncus tortor eu,</p>
            <br />
            <p>Aenean ut auctor neque. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Phasellus</p>
            <br />
            <p>ellentesque et faucibus nunc. Donec pellentesque interdum velit, ac rhoncus odio aliquet posuere. Praesent in purus a nisi condimentum faucibus. Curabitur euismod purus tortor, a elementum velit mollis vitae. Duis non est commodo, rhoncus tortor eu, gravida magna. Maecenas id ante ac nibh finibus tempor ut in risus. Sed et lacinia tellus. Nam et metus luctus, malesuada velit id, commodo dolor. Nullam in elementum nisl. Nam eu mauris porta orci gravida luctus. Fusce ac massa eget risus iaculis venenatis. Maecenas eu diam nulla. Duis gravida blandit est nec vehicula. </p>
            <br />
        </div>
		<center>
		  	<div id="textAera">
		    	<textarea></textarea>
		  	</div>
          </center>
        <div id="privateConv">
           <div id="conv1">
           		<img src="pictures/cross.png" width="8%" onclick="kill()" />
            	<div id="namePriv"><p><b>Name</b></p></div>
                <div id="textPriv">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla gravida dapibus velit posuere mattis. Nullam efficitur ultricies nunc ut porta. Aliquam malesuada consequat diam et facilisis. Cras aliquam auctor hendrerit. Fusce tincidunt, mauris at vestibulum sagittis.</p>
                    <br />
                    <p>Nunc aliquam aliquet arcu pharetra pretium. </p>
                    <br />
                    <p>Pellentesque et faucibus nunc. Donec pellentesque interdum velit, ac rhoncus odio aliquet posuere. Praesent in purus a nisi condimentum faucibus. Curabitur euismod purus tortor, a elementum velit mollis vitae. Duis non est commodo, rhoncus tortor eu,</p>
                    <br />
                    <p>Aenean ut auctor neque. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Phasellus</p>
                    <br />
                    <p>ellentesque et faucibus nunc. Donec pellentesque interdum velit,</p>
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
</html>
